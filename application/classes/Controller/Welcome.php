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

} // End Welcome
