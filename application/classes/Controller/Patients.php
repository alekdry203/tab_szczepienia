<?php

class Controller_Patients extends Controller_Main {

	public function action_index(){
		if(@$_POST) $this->save_patient();
		$data['patient']=ORM::factory('Patient', $_SESSION['pesel']);
		$this->template->content=View::factory("patients/index", $data);
	}
	
	private function save_patient(){
		print_r($_POST);die();
	}
	
	public function action_vaccinations(){
		$patient=ORM::factory('Patient', $_SESSION['pesel']);
		$vaccinations=$patient->timetables;
		if(@$_GET) $this->filter_vaccinations($vaccinations);
		$data['vaccinations']=$vaccinations->find_all();
		$this->template->content=View::factory("patients/vaccinations", $data);
	}
	
	private function filter_vaccinations($vaccinations){
		print_r(@$_GET);die();
	}
	
	public function action_deny_vaccination(){
		die('anulowanie szczepienia - zostawić zawartość kolumn vaccination_date i users_id dla tego szczepioenia, reszta null');
	}
	
	public function action_vaccination_pdf(){
		die('generowanie i pobieranie pdf szczepienia');
	}
	
}