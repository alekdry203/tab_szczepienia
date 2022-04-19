<?php

class Controller_Login extends Controller_Main {
	
	public function action_index(){
		//if(@$_SESSION['user_id']) HTTP::redirect("admin/users");
		if(@$_POST['registration']) $this->registration();
		elseif(@$_POST['pesel']) $this->verify_pesel();
		elseif(@$_POST['pesel_confirm'] && @$_POST['action_code']) $this->verify_code();
		$this->template->content=View::factory("login/index");
	}
	
	private function login(){
		if(@$_POST['pesel']) $this->verify_pesel();
		elseif(@$_POST['pesel_confirm'] && @$_POST['action_code']) $this->verify_code();
		else $this->registration();
	}
	
	private function verify_pesel(){
		$patient=ORM::factory('Patient')->where('pesel', 'like', @$_POST['pesel'])->find();
		if($patient->pesel){
			die('wysyłanie maila z kodem');
		}else{
			@$_POST['failed']['pesel']=1;
		}
	}
	
	private function verify_code(){
		$patient=ORM::factory('Patient')->where('pesel', 'like', @$_POST['pesel_confirm'])->find();
		if(!$patient->pesel || $patient->action_code!=$_POST['action_code']){
			die('wysłać drugi kod');
			@$_POST['failed']['code']=1;
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
		
	}
	
	public function action_logout(){
		foreach($_SESSION as $key=>$val) unset($_SESSION[$key]);
		session_destroy();
		HTTP::redirect("");
	}

}