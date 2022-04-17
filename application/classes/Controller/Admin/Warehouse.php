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
		if(@$_GET['name']) $warehouse->where('name', 'like', '%'.$_GET['name'].'%');
		if(@$_GET['surname']) $warehouse->where('surname', 'like', '%'.$_GET['surname'].'%');
		if(@$_GET['login']) $warehouse->where('login', 'like', '%'.$_GET['login'].'%');
		if(@$_GET['admin']) $warehouse->where('admin', '=', 1);
	}
	
	public function action_add(){
		if(@$_POST) $this->save_add();
		//$data['warehouse']=ORM::factory('Vaccinationwarehouse');
		$this->template->content=View::factory("admin/warehouse/add");
	}
	
	private function save_add(){
		print_r($_POST);die();
		for($serial_no=$_POST['serial_no'][0]; $serial_no<=$_POST['serial_no'][1]; $serial_no){
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
		$data['warehouse']=ORM::factory('Vaccinationwarehouse', $this->request->param("id"));
		$this->template->content=View::factory("admin/warehouse/edit", $data);
	}
	
	private function save_edit(){
		print_r($_POST);die();
		$warehouse=ORM::factory('Vaccinationwarehouse', @$_POST['serial_no']);
		//$warehouse->serial_no=$_POST['serial_no'];
		$warehouse->name=$_POST['name'];
		$warehouse->producer=$_POST['producer'];
		$warehouse->expiration_date=$_POST['expiration_date'];
		$warehouse->save();
		HTTP::redirect("admin/warehouse");
	}
	
	public function action_delete(){
		die('sprawdzić czy nie wykorzystano / zarezerwowano');
		ORM::factory('Vaccinationwarehouse', $this->request->param("id"))->delete();
		HTTP::redirect("admin/warehouse");
	}
}