<?php

class Controller_Admin_Patients extends Controller_Admin_Main {

	public function action_index(){
		$patients=ORM::factory('Patient');
		if(@$_GET) $this->filter($patients);
		$data['patients']=$patients->order_by('name')->order_by('surname')->find_all();
		//print_r($data['patients']);die();
		$this->template->content=View::factory("admin/patients/index", $data);
	}
	
	private function filter($patients){
		if(@$_GET['pesel']) $patients->where('pesel', 'like', '%'.$_GET['pesel'].'%');
		if(@$_GET['name']) $patients->where('name', 'like', '%'.$_GET['name'].'%');
		if(@$_GET['surname']) $patients->where('surname', 'like', '%'.$_GET['surname'].'%');
		if(@$_GET['email']) $patients->where('email', 'like', '%'.$_GET['email'].'%');
		if(@$_GET['city']) $patients->where('city', 'like', '%'.$_GET['city'].'%');
		if(@$_GET['street']) $patients->where('street', 'like', '%'.$_GET['street'].'%');
		if(@$_GET['local_no']) $patients->where('local_no', 'like', '%'.$_GET['local_no'].'%');
	}
	
	public function action_edit(){
		if(@$_POST) $this->save();
		$data['patient']=ORM::factory('Patient', $this->request->param("id"));
		$this->template->content=View::factory("admin/patients/edit", $data);
	}
	
	private function save(){
		$patient=ORM::factory('Patient', @$_POST['pesel']);
		$patient->pesel=$_POST['pesel'];
		$patient->name=$_POST['name'];
		$patient->surname=$_POST['surname'];
		$patient->email=$_POST['email'];
		$patient->city=$_POST['city'];
		$patient->street=$_POST['street'];
		$patient->local_no=$_POST['local_no'];
		$patient->save();
		HTTP::redirect("admin/patients");
	}

	public function action_delete(){
		die('przy usuwaniu trzeba by usunąć też wszystkie szczepienia - chyba że deaktywowanie konta');
		ORM::factory('Patient', $this->request->param("id"))->delete();
		HTTP::redirect("admin/patients");
	}

	/*public function action_vaccines(){
		//if(@$_POST) $this->save_vaccines();
		$data['patient']=ORM::factory('Patient', $this->request->param("id"));
		$vaccines=$data['patient']->timetables;
		if(@$_GET) $this->filter_vaccines($vaccines);
		$data['vaccines']=$vaccines->order_by('vaccination_date')->find_all();
		$this->template->content=View::factory("admin/patients/vaccines", $data);
	}
	
	private function filter_vaccines($vaccines){
		if(@$_GET['user_id']) $vaccines->where('users_id', '=', $_GET['user_id']);
		if(@$_GET['name']) $vaccines->where('name', 'like', '%'.$_GET['name'].'%');
		if(@$_GET['producer']) $vaccines->where('producer', 'like', '%'.$_GET['producer'].'%');
		if(@$_GET['date'][0]) $vaccines->where('vaccination_date', '<=', $_GET['date'][0].' 00:00:00');
		if(@$_GET['date'][1]) $vaccines->where('vaccination_date', '>=', $_GET['date'][1].' 00:00:00');
		if(@$_GET['status']==2) $vaccines->where('payment', 'is', null);
		elseif(@$_GET['status']==3) $vaccines->where('payment', 'is not', null);
	}
	
	private function save_vaccines(){
		
	}

	public function action_delete_vaccine(){
		die('przy usuwaniu tylko wyczyścić pesel i szczepionkę');
		ORM::factory('Patient', $this->request->param("id"))->delete();
		HTTP::redirect("admin/patients/vaccines");
	}//*/

}