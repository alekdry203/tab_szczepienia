<?php

class Controller_Admin_Main extends Controller_Template {
	
	public $template='admin/template/main';
	
	public function before(){
		parent::before();
		session_start();
		if(!@$_SESSION['user_id']) HTTP::redirect("admin/login/logout");
	}

}