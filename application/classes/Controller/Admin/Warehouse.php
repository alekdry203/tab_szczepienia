<?php

class Controller_Admin_Warehouse extends Controller_Admin_Main {

	public function action_index(){
		$warehouse=ORM::factory('Vaccinationwarehouse');
		//print_r($warehouse);die();
		if(@$_GET) $this->filter($warehouse);
		$data['warehouse']=$warehouse->order_by('expiration_date')->order_by('serial_no')->find_all();
		$this->template->content=View::factory("admin/warehouse/index", $data);
	}
	
	private function filter($warehouse){
		print_r($_GET);die();
		if(@$_GET['serial_no'][0]) $warehouse->where('serial_no', '<=', $_GET['serial_no'][0]);
		if(@$_GET['serial_no'][1]) $warehouse->where('serial_no', '>=', $_GET['serial_no'][1]);
		if(@$_GET['name']) $warehouse->where('name', 'like', '%'.$_GET['name'].'%');
		if(@$_GET['producer']) $warehouse->where('producer', 'like', '%'.$_GET['producer'].'%');
		if(@$_GET['expiration_date'][0]) $warehouse->where('expiration_date', '<=', $_GET['expiration_date'][0]);
		if(@$_GET['expiration_date'][1]) $warehouse->where('expiration_date', '>=', $_GET['expiration_date'][1]);
		//if(@$_GET['status']==1) $timetables->where('patients_pesel', 'is', null);
		//elseif(@$_GET['status']==2) $timetables->where('patients_pesel', 'is not', null);
	}
	
	public function action_add(){
		if(@$_POST) $this->save_add();
		//$data['warehouse']=ORM::factory('Vaccinationwarehouse');
		$this->template->content=View::factory("admin/warehouse/add");
	}
	
	private function save_add(){
		//print_r($_POST);die();
		for($serial_no=$_POST['serial_no'][0]; $serial_no<=$_POST['serial_no'][1]; $serial_no++){
			$warehouse=ORM::factory('Vaccinationwarehouse');
			$warehouse->serial_no=$serial_no;
			$warehouse->name=$_POST['name'];
			$warehouse->producer=$_POST['producer'];
			$warehouse->expiration_date=$_POST['expiration_date'];
			$warehouse->save();
		}
		HTTP::redirect("admin/warehouse");
	}
	
	public function action_edit(){
		if(@$_POST) $this->save_edit();
		$data['vaccine']=ORM::factory('Vaccinationwarehouse', $this->request->param("id"));
		$this->template->content=View::factory("admin/warehouse/edit", $data);
	}
	
	private function save_edit(){
		//print_r($_POST);die();
		$vaccine=ORM::factory('Vaccinationwarehouse', @$_POST['serial_no']);
		//$vaccine->serial_no=$_POST['serial_no'];
		$vaccine->name=$_POST['name'];
		$vaccine->producer=$_POST['producer'];
		$vaccine->expiration_date=$_POST['expiration_date'];
		$vaccine->save();
		HTTP::redirect("admin/warehouse");
	}
	
	public function action_delete(){
		$vaccine=ORM::factory('Vaccinationwarehouse', $this->request->param("id"));
		if($vaccine->timetables->count_all()) die('nie można usunąć wykorzystanych - chyba że admin (wtedy jak uzupełnić szczepionkę w okienkach)');
		else $vaccine->delete();
		HTTP::redirect("admin/warehouse");
	}
}