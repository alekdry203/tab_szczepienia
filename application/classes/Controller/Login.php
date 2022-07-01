<?php

class Controller_Login extends Controller_Main {
	
	public function before(){
		parent::before();
		if(@$_SESSION['pesel'] && $_SERVER['REQUEST_URI']==str_replace('logout', '', $_SERVER['REQUEST_URI'])) HTTP::redirect("patients/");
	}
	
	public function action_index(){
		if(@$_POST['registration']) $this->registration();
		elseif(@$_POST['pesel']) $this->verify_pesel();
		elseif(@$_POST['pesel_confirm'] && @$_POST['action_code']) $this->verify_code();
		$this->template->content=View::factory("login/index");
	}
	
	private function verify_pesel(){
		$patient=ORM::factory('Patient')->where('pesel', 'like', @$_POST['pesel'])->find();
		if($patient->pesel){
			$this->send_verification_code($patient);
		}else{
			@$_POST['failed']['pesel']=1;
		}
	}
	
	private function verify_code(){
		$patient=ORM::factory('Patient')->where('pesel', 'like', @$_POST['pesel_confirm'])->find();
		if(!$patient->pesel || $patient->action_code!=$_POST['action_code']){
			@$_POST['failed']['code']=1;
			@$_POST['pesel']=@$_POST['pesel_confirm'];
			unset($_POST['pesel_confirm']);
			$this->send_verification_code($patient);
			return;
		}
		@$_SESSION['pesel']=$patient->pesel;
		@$_SESSION['user_name']=$patient->name;
		@$_SESSION['user_surname']=$patient->surname;
		$redirect='';
		if(@$_SESSION['redirect']){
			$redirect=$_SESSION['redirect'];
			unset($_SESSION['redirect']);
		}
		HTTP::redirect($redirect);
	}
	
	private function registration(){
		$patient=ORM::factory('Patient');
		unset($_POST['registration']);
		foreach(@$_POST as $key=>$val) $patient->$key=$val;
		if(@$patient->save()){
			foreach(@$_POST as $row) unset($row);
			$_POST['pesel']=$patient->pesel;
			$_POST['registration']=1;
			$this->send_verification_code($patient);
		}else{
			@$_POST['failed']['registration']=1;
		}
	}
	
	private function send_verification_code($patient){
		$patient->action_code=substr(uniqid(),0,12);
		$patient->save();
		$body=View::factory("login/action_code_mail", compact('patient'));
		$headers="From: olekdrynda@gmail.com\n";
		$headers.="MIME-Version: 1.0\r\n";
		$headers.="Content-Type: text/html; charset=UTF-8\n";
		if(!mail($patient->email, 'Szczepienia - kod weryfikacyjny', $body, $headers)) die('error mailingu');
	}
	
	public function action_logout(){
		foreach($_SESSION as $key=>$val) unset($_SESSION[$key]);
		session_destroy();
		HTTP::redirect("");
	}

}