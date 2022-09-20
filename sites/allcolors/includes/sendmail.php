<?php 
$response 			= array('error'=>'');
$from_email 		= 'allcolorscompany@gmail.com';
$to_email 			= 'marcos.amoraes@outlook.com';
$cc_email 			= 'comercial@fernandotebar.com';

// parse
$nome 		= $_POST['name'] ? stripslashes(strip_tags(trim($_POST['name']))) : '';
$email 		= $_POST['email'] ? stripslashes(strip_tags(trim($_POST['email']))) : '';
$phone 		= $_POST['phone'] ? stripslashes(strip_tags(trim($_POST['phone']))) : '';
$location 	= $_POST['location'] ? stripslashes(strip_tags(trim($_POST['location']))) : '';
$comments 	= $_POST['comments'] ? stripslashes(strip_tags(trim($_POST['comments']))) : '';
	
$subj 		= 'New Contact - All Colors Company';

$msg 		= $subj." \r\n";
$msg 		.= "Name: $nome \r\n";
$msg 		.= "E-mail: $email \r\n";
$msg 		.= "Phone: $phone \r\n";
$msg 		.= "Location: $location \r\n";
$msg 		.= "Comments: $comments";

$head 		= "Content-Type: text/plain; charset=\"utf-8\"\n"
			. "X-Mailer: PHP/" . phpversion() . "\n"
			. "Cc: $cc_email\n"
			. "From: $from_email\n";

if (!@mail($to_email, $subj, $msg, $head))
	$response['error'] = 'Error send message!';

header("Location: http://tbr360.com.br/clientes/allcolors/?contact_sended");
die();
?>