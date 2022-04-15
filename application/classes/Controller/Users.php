<?php

class Controller_Users extends Controller_Main {

	public function action_index(){
		//$id=$this->request->param("id");
		$x=ORM::factory('User');
		//print_r($x->vaccine);die();
		$this->template->content=View::factory("users/index");
	}

} // End Welcome
