# INSTAGRAM-SCRAPPER
# INSTALAÇÃO

  - De um git clone no projeto com a url atual
  - Execute o comando composer install
  - Copie o arquivo .env.example para .env
  - Configure com as informações do seu banco de dados MySQL
  - Configure o Login e Senha do Instagram no seguinte arquivo: 
  - app/Http/Controllers/InstagramController.php na function index, as variáveis $username e $password
  - Execute o comando:
```sh
php artisan migrate
```

# URL's PARA UTILIZAÇÃO DO SISTEMA
Utilize sua URL padrão seguida do código da postagem:
  - http://insta.test/CK7TBeFl80i
  - O sisema ira pegar os 5 mil primeiros comentários e fazer a inserção no banco de dados
  - Assim que efetuar a inserção, ele ira redirecionar para uma página com um contador que tem um cronometro com 10 minutos
  - http://insta.test/wait/CK7TBeFl80i?time=600
  - Após os 10 minutos ele será redirecionado novamente para o primeiro link da lista
 
# VISUALIZAÇÃO DOS DADOS
  - Acesse a URL http://insta.test/comments/all e tem paginação até o último comentário retornado.

# Autor: Pablo Santos