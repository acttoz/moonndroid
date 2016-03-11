<?
session_start();
$smtop_use = 'smtp.naver.com';

if($smtp_use == 'smtp.naver.com'){
	$from_email = $smtp_mail_id;
}else {
	$from_email = $from_email;
}

require_once("class.phpmailer.php");

$mail = new PHPMailer(true);
$mail ->IsSMTP();
try{
	$mail->Host = $smtp_use;
	$mail->SMTPAuth=true;
	$mail->Port=465;
	$mail->SMTPSecure = "ssl";
	$mail->Username = "acttoz@naver.com";
	$mail->Password = "비밀번호";
	$mail->CharSet = "utf-8";
	$mail->SetFrom("acttoz@naver.com","보내는이");
	$mail->AddAddress("acttoze@gmail.com","받는이");
	$mail->Subject = "제목";
	$mail->MsgHTML("내용용");
	$mail->Send();

echo "메일전송 성공";
}catch(phpmailerException $e){
	echo $e->errorMessage();
	
}catch(Exception $e){
	echo $e->getMessage();
}


?>
