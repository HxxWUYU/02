<?php 
namespace App\Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

class Mail{

	protected $mail;

	public function __construct(){

		$this->mail = new PHPMailer;
		$this->setUp();
	}

	public function setUp(){

		$this->mail->isSMTP();
		$this->mail->Mailer='smtp';
		$this->mail->SMTPAuth = true;
		$this->mail->SMTPSecure = 'tls';

		//For XXOAUTH2 
		$this->mail->AuthType = "XOAUTH2";
		$email = 'derrickhuang2333@gmail.com';
		$clientId = '1092716039802-h7jccm8b261gptekdvnuthqt0c69k0br.apps.googleusercontent.com';
		$clientSecret = 'TnxtmbwzsPcEOmaALsXPshhl';
		$refreshToken = '1/QizyBNUvlvju8q_7L1SxlbFpj4vXQHIRwdt1I-aIigs';
		$provider = new Google(
 		   [
        'clientId' => $clientId,
        'clientSecret' => $clientSecret,
    		]
		);

		$this->mail->setOAuth(
    	new OAuth(
        [
            'provider' => $provider,
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
            'refreshToken' => $refreshToken,
            'userName' => $email,
        ]
    	)
		);

		$this->mail->Host = getenv('SMTP_HOST');
		$this->mail->Port = getenv('SMTP_PORT');

		$environment = getenv('APP_ENV'); //local or production

		if($environment === 'local'){
			$this->mail->SMTPOptions=[
				'SSL'=array(
					'verify_peer'=>false,
					'verify_peer_name'=>false,
					'allow_self_signed'=>true
				);
			];
			$this->mail->SMTPDebug = '';
		}

		//auth info
		$this->mail->Username = getenv("EMAIL_USERNAME");
		$this->mail->Password = getenv("EMAIL_PASSWORD");

		$this->mail->isHTML(true);
		$this->mail->SingleTo = true;

		//sender info
		//$this->mail->From = getenv("ADMIN_EMAIL");
		$this->mail->setFrom(getenv("ADMIN_EMAIL"),'Hxx E-commerce Store');
		//$this->mail->FromName("Hxx E-commerce Store");
	}

	public function send($data){

		
		$this->mail->addAddress($data['to'],$data['name']);
		$this->mail->Subject = $data['subject'];
		$this->mail->Body = make($data['view'],array('data'=>$data['body']));

		return $this->mail->send();
	}
}