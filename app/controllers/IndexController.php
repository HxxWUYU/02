<?php 
namespace App\Controllers;

use App\Classes\Mail;

class IndexController extends BaseController{

	public function show(){
		echo "Inside Homepage from controller class";
		$mail = new Mail();
		$data = [
			'to' => 'derrickhuang2333@gmail.com',
			'subject'=> 'Welcome to Hxx Store',
			'view' => 'welcome',
			'name' => 'Hxx',
			'body' => "Testing email template"
			];
		echo $data;
		// if($mail->send($data)){
		// 	echo "Email sent!";
		// }else{
		// 	echo "Email sending failed!";
		// }

	}
}
?>