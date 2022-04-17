<?php

class Controller_Admin_Warehouse extends Controller_Admin_Main {

	public function action_index(){
		$warehouse=ORM::factory('Vaccinationwarehouse');
		print_r($warehouse);die();
		if(@$_GET) $this->filter($warehouse);
		$data['warehouse']=$warehouse->order_by('name')->order_by('surname')->find_all();
		$this->template->content=View::factory("admin/warehouse/index", $data);
	}
	
	/*public function action_index_batch(){
		$warehouse=ORM::factory('Vaccinationwarehouse');
		print_r($warehouse);die();
		if(@$_GET) $this->filter($warehouse);
		$data['warehouse']=$warehouse->order_by('name')->order_by('surname')->find_all();
		$this->template->content=View::factory("admin/warehouse/index_batch");
	}//*/
	
	private function filter($warehouse){
		print_r($_GET);die();
		if(@$_GET['name']) $warehouse->where('name', 'like', '%'.$_GET['name'].'%');
		if(@$_GET['surname']) $warehouse->where('surname', 'like', '%'.$_GET['surname'].'%');
		if(@$_GET['login']) $warehouse->where('login', 'like', '%'.$_GET['login'].'%');
		if(@$_GET['admin']) $warehouse->where('admin', '=', 1);
	}
	
	public function action_edit(){
		if(@$_POST) $this->save();
		$data['warehouse']=ORM::factory('Vaccinationwarehouse', $this->request->param("id"));
		$this->template->content=View::factory("admin/warehouse/edit");
	}
	
	private function save(){
		print_r($_POST);die();
		$warehouse=ORM::factory('Vaccinationwarehouse', @$_POST['id']);
		$warehouse->name=$_POST['name'];
		$warehouse->surname=$_POST['surname'];
		$warehouse->login=$_POST['login'];
		$warehouse->admin=@$_POST['admin'] ? : null;
		if(@$_POST['password']) $warehouse->admin=$this->pass_hash($_POST['password']);
		$warehouse->save();
	}
	
	public function action_edit_single(){
		if(@$_POST) $this->save_single();
		$data['warehouse']=ORM::factory('Vaccinationwarehouse', $this->request->param("id"));
		$this->template->content=View::factory("admin/warehouse/edit_single");
	}
	
	private function save_single(){
		print_r($_POST);die();
		$warehouse=ORM::factory('Vaccinationwarehouse', @$_POST['id']);
		$warehouse->name=$_POST['name'];
		$warehouse->surname=$_POST['surname'];
		$warehouse->login=$_POST['login'];
		$warehouse->admin=@$_POST['admin'] ? : null;
		if(@$_POST['password']) $warehouse->admin=$this->pass_hash($_POST['password']);
		$warehouse->save();
	}
	
	public function action_delete(){
		ORM::factory('Vaccinationwarehouse', $this->request->param("id"))->delete();
		HTTP::redirect("admin/warehouse");
	}
	
	public function action_delete_single(){
		ORM::factory('Vaccinationwarehouse', $this->request->param("id"))->delete();
		HTTP::redirect("admin/warehouse");
	}
}