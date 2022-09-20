<?php 
global $_REQUEST;
$response = array('error'=>'');
$contact_email = 'expansao@franquiabeato.com.br';
$cc_email = 'comercial@fernandotebar.com';

// type
$type = $_REQUEST['type'];	
// parse
parse_str($_POST['data'], $post_data);	
		

		$user_name = stripslashes(strip_tags(trim($post_data['username'])));
		$user_telephone = stripslashes(strip_tags(trim($post_data['telephone'])));
		$user_email = stripslashes(strip_tags(trim($post_data['email'])));
		$user_city = stripslashes(strip_tags(trim($post_data['city'])));
		$user_state =stripslashes(strip_tags(trim( $post_data['state'])));
			
		if (trim($contact_email)!='') {
			$subj = 'Novo Lead - Beato';
			$msg = $subj." \r\nNome: $user_name \r\nTelefone: $user_telephone \r\nE-mail: $user_email \r\nCidade: $user_city \r\nEstado: $user_state";
		
			$head = "Content-Type: text/plain; charset=\"utf-8\"\n"
				. "X-Mailer: PHP/" . phpversion() . "\n"
				. "Reply-To: $user_email\n"
				. "Cc: $cc_email\n"
				. "From: $user_email\n";
		
			if (!@mail($contact_email, $subj, $msg, $head)) {
				$response['error'] = 'Error send message!';
			}
		} else 
				$response['error'] = 'Error send message!';	
		
		

	//echo json_encode($post_data['username'].''.$post_data['email'].''$post_data['subject'].''.$post_data['message']);	
	echo json_encode($response);
	die();
?>