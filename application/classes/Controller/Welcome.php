<?php

class Controller_Welcome extends Controller_Main {

	public function action_index(){
		//$id=$this->request->param("id");
		//$x=ORM::factory('Vaccinationwarehouse');
		//$x=ORM::factory('Patient');
		//$x=ORM::factory('User');
		//$x=ORM::factory('Timetable');
		//print_r($x->vaccine);die();
		$this->template->content=View::factory("welcome/index");
	}
	
	public function action_mail_test(){
		$to=@$_POST['email'];
		$subject=@$_POST['subject'];
		$body=@$_POST['body'];
		$headers = "From: olekdrynda@gmail.com";
		if(!mail($to, $subject, $body, $headers)) die('error mailingu');
		HTTP::redirect("welcome/");
	}
	
	public function action_tcpdf_test(){
		die('w trakcie');
	}

} // End Welcome
