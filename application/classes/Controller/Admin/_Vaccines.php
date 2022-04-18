<?php

class Controller_Admin_Vaccines extends Controller_Admin_Main {

	public function action_index(){
		$vaccines=ORM::factory('Vaccinationwarehouse');
		print_r($vaccines);die();
		if(@$_GET) $this->filter($vaccines);
		$data['vaccines']=$vaccines->order_by('name')->order_by('surname')->find_all();
		$this->template->content=View::factory("admin/vaccines/index");
	}
	
	public function action_index_batch(){
		$vaccines=ORM::factory('Vaccinationwarehouse');
		print_r($vaccines);die();
		if(@$_GET) $this->filter($vaccines);
		$data['vaccines']=$vaccines->order_by('name')->order_by('surname')->find_all();
		$this->template->content=View::factory("admin/vaccines/index_batch");
	}
	
	private function filter($vaccines){
		print_r($_GET);die();
		if(@$_GET['name']) $vaccines->where('name', 'like', '%'.$_GET['name'].'%');
		if(@$_GET['surname']) $vaccines->where('surname', 'like', '%'.$_GET['surname'].'%');
		if(@$_GET['login']) $vaccines->where('login', 'like', '%'.$_GET['login'].'%');
		if(@$_GET['admin']) $vaccines->where('admin', '=', 1);
	}
	
	public function action_edit(){
		if(@$_POST) $this->save();
		$data['vaccine']=ORM::factory('Vaccinationwarehouse', $this->request->param("id"));
		$this->template->content=View::factory("admin/vaccines/edit");
	}
	
	private function save(){
		print_r($_POST);die();
		$vaccine=ORM::factory('Vaccinationwarehouse', @$_POST['id']);
		$vaccine->name=$_POST['name'];
		$vaccine->surname=$_POST['surname'];
		$vaccine->login=$_POST['login'];
		$vaccine->admin=@$_POST['admin'] ? : null;
		if(@$_POST['password']) $vaccine->admin=$this->pass_hash($_POST['password']);
		$vaccine->save();
	}
	
	public function action_edit_single(){
		if(@$_POST) $this->save_single();
		$data['vaccine']=ORM::factory('Vaccinationwarehouse', $this->request->param("id"));
		$this->template->content=View::factory("admin/vaccines/edit_single");
	}
	
	private function save_single(){
		print_r($_POST);die();
		$vaccine=ORM::factory('Vaccinationwarehouse', @$_POST['id']);
		$vaccine->name=$_POST['name'];
		$vaccine->surname=$_POST['surname'];
		$vaccine->login=$_POST['login'];
		$vaccine->admin=@$_POST['admin'] ? : null;
		if(@$_POST['password']) $vaccine->admin=$this->pass_hash($_POST['password']);
		$vaccine->save();
	}
	
	public function action_delete(){
		ORM::factory('Vaccinationwarehouse', $this->request->param("id"))->delete();
		HTTP::redirect("admin/vaccines");
	}
	
	public function action_delete_single(){
		ORM::factory('Vaccinationwarehouse', $this->request->param("id"))->delete();
		HTTP::redirect("admin/vaccines");
	}
}