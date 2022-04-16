<?php

class Controller_Admin_Users extends Controller_Admin_Main {

	public function action_index(){
		$users=ORM::factory('User');
		if(@$_GET) $this->filter($users);
		$data['users']=$users->order_by('name')->order_by('surname')->find_all();
		//print_r($data['users']);die();
		$this->template->content=View::factory("admin/users/index", $data);
	}
	
	private function filter($users){
		if(@$_GET['name']) $users->where('name', 'like', '%'.$_GET['name'].'%');
		if(@$_GET['surname']) $users->where('surname', 'like', '%'.$_GET['surname'].'%');
		if(@$_GET['login']) $users->where('login', 'like', '%'.$_GET['login'].'%');
		if(@$_GET['admin']==1) $users->where('admin', '=', 1);
		elseif(@$_GET['admin']==-1) $users->where_open()->where('admin', '!=', 1)->or_where('admin', 'is', null)->where_close();
	}
	
	public function action_edit(){
		if(@$_POST) $this->save();
		$data['user']=ORM::factory('User', $this->request->param("id"));
		$this->template->content=View::factory("admin/users/edit", $data);
	}
	
	private function save(){
		$user=ORM::factory('User', @$_POST['id']);
		$user->name=$_POST['name'];
		$user->surname=$_POST['surname'];
		$user->login=$_POST['login'];
		$user->admin=@$_POST['admin'] ? : null;
		if(@$_POST['password']) $user->admin=$this->pass_hash($_POST['password']);
		$user->save();
		HTTP::redirect("admin/users?login=".$user->login);
	}
	
	private function pass_hash($password){
		$salf=$salt_pattern='1ad, 3,asd 5, 9, 14, 15, asdas20, ';
		return md5($salf.md5($password).$salf);
	}
	
	
	public function action_delete(){
		ORM::factory('User', $this->request->param("id"))->delete();
		HTTP::redirect("admin/users");
	}
}