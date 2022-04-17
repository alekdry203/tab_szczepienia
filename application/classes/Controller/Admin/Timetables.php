<?php

class Controller_Admin_Timetables extends Controller_Admin_Main {

	public function action_index(){
		$timetables=ORM::factory('Timetable');
		if(@$_GET) $this->filter($timetables);
		$data['timetables']=$timetables->order_by('vaccination_date')
										->find_all();
		$data['users']=ORM::factory('User')->order_by('name')->order_by('surname')->find_all();
		$this->template->content=View::factory("admin/timetables/index", $data);
	}
	
	private function filter($timetables){
		//print_r($_GET);die();
		if(@$_GET['date'][0]) $timetables->where('vaccination_date', '>=', $_GET['date'][0].' 00:00:00');
		if(@$_GET['date'][1]) $timetables->where('vaccination_date', '<=', $_GET['date'][1].' 23:59:59');
		if(@$_GET['user_id']) $timetables->where('users_id', '=', $_GET['user_id']);
		if(@$_GET['patient_pesel']) $timetables->where('patients_pesel', '=', $_GET['patient_pesel']);
		if(@$_GET['status']==1) $timetables->where('patients_pesel', 'is', null);
		elseif(@$_GET['status']==2) $timetables->where('patients_pesel', 'is not', null)->where('payment', 'is', null);
		elseif(@$_GET['status']==3) $timetables->where('payment', 'is not', null);//*/
	}
	
	public function action_add(){
		if(@$_POST) $this->save_add();
		$data['users']=ORM::factory('User')->order_by('name')->order_by('surname')->find_all();
		$this->template->content=View::factory("admin/timetables/add", $data);
	}
	
	private function save_add(){
		//print_r($_POST);die();
		$time=strtotime($_POST['date'].' '.$_POST['time']);
		for($i=0; $i<$_POST['amount']; $i++){
			$tmp=date('Y-m-d H:i:s', ($time+($i*60*$_POST['period'])));
			//echo $tmp;die();
			$timetable=ORM::factory('Timetable');
			$timetable->vaccination_date=$tmp;
			$timetable->users_id=$_POST['user_id'];
			//$timetable->patients_pesel=null;
			//$timetable->payment=null;
			//$timetable->activation_code=null;
			$timetable->save();
		}
		HTTP::redirect("admin/timetables/index");
	}
	
	public function action_edit(){
		if(@$_POST) $this->save_edit();
		$data['timetable']=ORM::factory('Timetable', $this->request->param("id"));
		$data['users']=ORM::factory('User')->order_by('name')->order_by('surname')->find_all();
		$this->template->content=View::factory("admin/timetables/edit", $data);
	}
	
	private function save_edit(){
		//print_r($_POST);die();
		$timetable=ORM::factory('Timetable', $_POST['id']);
		$timetable->vaccination_date=$_POST['date'].' '.$_POST['time'];
		$timetable->users_id=$_POST['user_id'];
		$timetable->patients_pesel=$_POST['patients_pesel'] ? : null;
		$timetable->payment=$_POST['payment'] ? : null;
		//$timetable->activation_code=$_POST['activation_code'] ? : null;
		$timetable->save();
		
		HTTP::redirect("admin/timetables/index");
	}
	
	public function action_delete(){
		$timetable=ORM::factory('Timetable', $this->request->param("id"));
		//$redirect="admin/timetables/edit/".$timetable->users_id.'?date='.date('Y-m-d', strtotime($timetable->vaccination_date));
		if(!$timetable->patients_pesel) $timetable->delete();
		elseif($timetable->patients_pesel && !$timetable->payment) die('wysłać powiadomienie o usunięciu wizyty z propozycją nowej daty?');
		elseif($timetable->patients_pesel && $timetable->payment) die('nie można usunąć zrealizowanego szczepienia');
		else die('nieznany przypadek!!!');
		HTTP::redirect("admin/timetables");
		//HTTP::redirect($redirect);
	}
	
}