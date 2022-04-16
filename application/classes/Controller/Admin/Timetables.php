<?php

class Controller_Admin_Timetables extends Controller_Admin_Main {

	public function action_index(){
		$timetables=ORM::factory('Timetable');
		//print_r($timetables);die();
		if(@$_GET) $this->filter($timetables);
		$data['timetables']=$timetables->group_by(DB::expr('DATE(vaccination_date)'))->group_by('users_id')->order_by(DB::expr('DATE(vaccination_date)'))->find_all();
		$data['users']=ORM::factory();
		$this->template->content=View::factory("admin/timetables/index");
	}
	
	private function filter($timetables){
		//print_r($_GET);die();
		if(@$_GET['date'][0]) $timetables->where('vaccination_date', '>=', $_GET['date'][0]);
		if(@$_GET['date'][1]) $timetables->where('vaccination_date', '<=', $_GET['date'][1]);
		if(@$_GET['user_id']) $timetables->where('users_id', '=', $_GET['user_id']);
		if(@$_GET['status']==1) $timetables->where('patients_pesel', 'is', null);
		elseif(@$_GET['status']==2) $timetables->where('patients_pesel', 'is not', null)->where('payment', 'is', null);
		elseif(@$_GET['status']==3) $timetables->where('payment', 'is not', null);
	}
	
	public function action_add(){
		if(@$_POST) $this->save_add();
		//$data['timetable']=ORM::factory('Timetable');
		$this->template->content=View::factory("admin/timetables/add");
	}
	
	private function save_add(){
		print_r($_POST);die();
		$time=strtotime($_POST['date'].' '.$_POST['hour']);
		for($i=0; $i<=$_POST['amount']; $i++){
			$tmp=date('Y-m-d H:i:s', $time+($i*$_POST['period']));
			echo $tmp;die();
			$timetable=ORM::factory('Timetable');
			$timetable->vaccination_date=$tmp;
			$timetable->users_id=$_POST['user_id'];
			$timetable->save();
		}
		HTTP::redirect("admin/timetables/edit/".$_POST['user_id']."?date=".$_POST['date']);
	}
	
	public function action_edit(){
		if(@$_POST) $this->save_edit();
		$data['timetable']=ORM::factory('Timetable', $this->request->param("id"));
		$this->template->content=View::factory("admin/timetables/edit");
	}
	
	private function save_edit(){
		print_r($_POST);die();
		$timetable=ORM::factory('Timetable', @$_POST['id']);
		$timetable->name=$_POST['name'];
		$timetable->surname=$_POST['surname'];
		$timetable->login=$_POST['login'];
		$timetable->admin=@$_POST['admin'] ? : null;
		if(@$_POST['password']) $timetable->admin=$this->pass_hash($_POST['password']);
		$timetable->save();
	}
	
	public function action_delete(){
		ORM::factory('Timetable', $this->request->param("id"))->delete();
		HTTP::redirect("admin/timetables");
	}
	
}