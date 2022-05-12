<?php

class Controller_Patients extends Controller_Main {
	
	public function before(){
		parent::before();
		if(!@$_SESSION['pesel']) HTTP::redirect("login/");
	}
	
	public function action_index(){
		if(@$_POST) $this->save_patient();
		$data['patient']=ORM::factory('Patient', $_SESSION['pesel']);
		$this->template->content=View::factory("patients/index", $data);
	}
	
	private function save_patient(){
		//print_r($_POST);die();
		$patient=ORM::factory('Patient', $_SESSION['pesel']);
		foreach(@$_POST as $key=>$val)
			if($val)
				$patient->$key=$val;
		$patient->save();
	}
	
	public function action_vaccinations(){
		$patient=ORM::factory('Patient', $_SESSION['pesel']);
		$vaccinations=$patient->timetables;
		if(@$_GET) $this->filter_vaccinations($vaccinations);
		$data['vaccinations']=$vaccinations->find_all();
		
		$data['vaccines']=ORM::factory('Vaccinationwarehouse')->group_by('producer')->group_by('name')->order_by('producer')->order_by('name')->find_all();
		$this->template->content=View::factory("patients/vaccinations", $data);
	}
	
	private function filter_vaccinations($vaccinations){
		//print_r(@$_GET);die();
		if(@$_GET['date'][0]) $vaccinations->where('vaccination_date', '>=', @$_GET['date'][0]);
		if(@$_GET['date'][1]) $vaccinations->where('vaccination_date', '>=', @$_GET['date'][1]);
		
		if(@$_GET['vaccine']){
			$tmp=explode(';', $_GET['vaccine']);
			if(!$tmp[0] && !$tmp[1]) $vaccinations->join(array('vaccinations_warehouse', 'vw'), 'left')
													->on('vw.serial_no', '=', 'vaccinations_warehouse_serial_no')
													->where('name', 'like', $tmp[0])
													->where('producer', 'like', $tmp[1]);
		}
		
		/*if(@$_GET['name'] || @$_GET['producer']) $vaccinations->join(array('vaccinations_warehouse', 'vw'), 'left')->on('vw.serial_no', '=', 'vaccinations_warehouse_serial_no');//->group_by('id');
		if(@$_GET['name']) $vaccinations->where('vw.name', 'like', '%'.@$_GET['name'].'%');
		if(@$_GET['producer']) $vaccinations->where('vw.producer', 'like', '%'.@$_GET['producer'].'%');//*/
		
		if(@$_GET['status']==2) $vaccinations->where('payment', 'is', null);
		elseif(@$_GET['status']==3) $vaccinations->where('payment', 'is not', null);//*
	}
	
	public function action_deny_vaccination(){
		//die('anulowanie szczepienia - zostawić zawartość kolumn vaccination_date i users_id dla tego szczepioenia, reszta null');
		$vaccination=ORM::factory('Timetable', $this->request->param("id"));
		$vaccination->patients_pesel=null;
		$vaccination->vaccinations_warehouse_serial_no=null;
		$vaccination->payment=null;
		$vaccination->activation_code=null;
		$vaccination->save();
		HTTP::redirect("patients/vaccinations");
	}
	
	public function action_vaccination_pdf(){
		die('generowanie i pobieranie pdf szczepienia');
	}
	
}