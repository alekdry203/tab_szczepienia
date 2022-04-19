<?php

class Controller_Admin_Login extends Controller_Template {
	
	public $template="admin/template/login";
	
	public function before(){
		parent::before();
		session_start();
		//phpinfo();die();
	}
	
	public function action_index(){
		if(@$_SESSION['user_id']) HTTP::redirect("admin/users");
		//die('ok');
		if(@$_POST) $this->login();
		$this->template->content=View::factory("admin/login/index");
	}
	
	private function login(){
		//echo $this->pass_hash($_POST['password']);die();
		//print_r($_POST);die();
		$user=ORM::factory('User')->where('login', 'like', @$_POST['login'])->where('password', 'like', $this->pass_hash($_POST['password']))->find();
		//print_r($user);die();
		if(!$user->id) return;
		$_SESSION['user_id']=$user->id;
		$_SESSION['login']=$user->login;
		if($user->admin) $_SESSION['admin']=1;
		HTTP::redirect("admin/users");
	}

	public function action_logout(){
		foreach($_SESSION as $key=>$val) unset($_SESSION[$key]);
		session_destroy();
		HTTP::redirect("admin/login");
	}
	
	private function pass_hash($password){
		$salf=$salt_pattern='1ad, 3,asd 5, 9, 14, 15, asdas20, ';
		return md5($salf.md5($password).$salf);
	}

}