<?php

class Controller_Vaccines extends Controller_Main {

	public function action_index(){
		$data['vaccines']=ORM::factory('Vaccinationwarehouse')->group_by('producer')->group_by('name')->order_by('producer')->order_by('name')->find_all();
		$this->template->content=View::factory("vaccines/index", $data);
	}
	
	public function action_sign_up(){
		$this->check_if_logged();
	}
	
	private function check_if_logged(){
		if(@$_SESSION['user_name'] && @$_SESSION['user_surname'] && @$_SESSION['pesel']) return;
		$_SESSION['redirect']=str_replace(URL::base().'index.php/', '', $_SERVER['REQUEST_URI']);
		HTTP::redirect("login");
	}
	
}