<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class AccountController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $accounts = account::orderBy('updated_at','desc')->paginate();
        return view('account.index',['accounts' => $accounts]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.create');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $account = Account::withTrashed()->where('email', $request->email)->exists();

        if($account)
        {
            $account = Account::withTrashed()->where('email', $request->email)->restore();
            $request->session()->flash('status', 'Conta recuperada com sucesso!');
            return redirect()->to(route('accounts.index'));
        }

        $data['email'] = $request->email;
        $data['password'] = $request->password;

        $hash = $this->createHash(
            $data['email'],
            $data['password'],
            Carbon::now()->format('Y-m-d H:i:s')
        );

        Account::create([
            'email' => $data['email'],
            'password' => $hash
        ]);

        $request->session()->flash('status', 'Conta cadastrada com sucesso!');
        return redirect()->to(route('accounts.index'));
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = Account::withTrashed()->findOrFail($id);
        $data = "<table class='table table-bordered table-striped table-hover' width='100%'>";
        $data .= "<tr><td><b>E-mail</b></td><td>".$account->email."</td></tr>";
        $data .= "<tr><td><b>Criado</b></td><td>".$account->created_at->format('d/m/Y H:i:s')."</td></tr>";
        $data .= "</table>";

        return $data;
        ;
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = Account::findOrFail($id);
        $account->password = $this->decryptHash($account->password);
        return view('account.edit',['account' => $account]);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);
        
        $data['email'] = $request->email;
        $data['password'] = $request->password;

        $hash = $this->createHash(
            $data['email'],
            $data['password'],
            Carbon::now()->format('Y-m-d H:i:s')
        );

        $account->update([
            'email' => $data['email'],
            'password' => $hash,
        ]);

        $request->session()->flash('status', 'Conta atualizada com sucesso!');
        return redirect()->to(route('accounts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $account = Account::findOrFail($id);
        $account->delete();
        $request->session()->flash('status', 'Conta deletada com sucesso!');
        return redirect()->to(route('accounts.index'));
    }

    /**
     * Para manter a senha segura, função para criptografia e descriptografia
     */
    public function createHash(...$params): string
    {
        $phrase = '';
        foreach ($params as $key => $param) {
            $separator = ($key === count($params) - 1) ? '' : '..';
            $phrase .= $param . $separator;
        };

        return Crypt::encryptString($phrase);
    }

    private function decryptHash($hash)
    {
        if (empty($hash)) return [];

        $decrypted = Crypt::decryptString($hash); // array

        $result = explode('..', $decrypted);
        $data = [
            'email'     => $result[0] ?? '',
            'password'  => $result[1] ?? '',
            'date'      => $result[2] ?? ''
        ];

        return $data['password'];
    }
}
