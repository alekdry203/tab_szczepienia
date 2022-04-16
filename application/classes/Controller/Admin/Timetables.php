<?php

class Controller_Admin_Timetables extends Controller_Admin_Main {

	public function action_index(){
		$timetables=ORM::factory('Timetable');
		//print_r($timetables);die();
		if(@$_GET) $this->filter($timetables);
		$data['timetables']=$timetables->group_by(DB::expr('DATE(vaccination_date)'))
										->group_by('users_id')
										->order_by(DB::expr('DATE(vaccination_date)'))
										->select(array(DB::expr('DATE(vaccination_date)'), 'day'))
										->find_all();
		$data['users']=ORM::factory('User')->order_by('name')->order_by('surname')->find_all();
		$this->template->content=View::factory("admin/timetables/index", $data);
	}
	
	private function filter($timetables){
		//print_r($_GET);die();
		if(@$_GET['date'][0]) $timetables->where('vaccination_date', '>=', $_GET['date'][0].' 00:00:00');
		if(@$_GET['date'][1]) $timetables->where('vaccination_date', '<=', $_GET['date'][1].' 23:59:59');
		if(@$_GET['user_id']) $timetables->where('users_id', '=', $_GET['user_id']);
		/*if(@$_GET['status']==1) $timetables->where('patients_pesel', 'is', null);
		elseif(@$_GET['status']==2) $timetables->where('patients_pesel', 'is not', null)->where('payment', 'is', null);
		elseif(@$_GET['status']==3) $timetables->where('payment', 'is not', null);//*/
	}
	
	public function action_edit(){
		if(@$_POST) $this->save();
		$timetables=ORM::factory('Timetable');
		if(@$_GET['date']) $timetables->where('vaccination_date', '>=', @$_GET['date'].' 00:00:00')
										->where('vaccination_date', '<=', @$_GET['date'].' 23:59:59');
		else $timetables->or_where('id', 'in', array(0));
		if($this->request->param("id")) $timetables->where('users_id', '=', $this->request->param("id"));
		//$data['timetables']=ORM::factory('Timetable')->select(array(DB::expr('DATE(vaccination_date)'), 'day'))->find_all();
		$data['timetables']=$timetables->order_by(DB::expr('DATE(vaccination_date)'))
										->select(array(DB::expr('DATE(vaccination_date)'), 'day'))
										->find_all();//*/
		$data['users']=ORM::factory('User')->order_by('name')->order_by('surname')->find_all();
		$this->template->content=View::factory("admin/timetables/edit", $data);
	}
	
	private function save(){
		//print_r($_POST);die();
		foreach($_POST['id'] as $i=>$val){
			$timetable=ORM::factory('Timetable', $val);
			$timetable->vaccination_date=$_POST['vaccination_date_day'][$i].' '.$_POST['vaccination_date_time'][$i];
			$timetable->users_id=$_POST['user_id'];
			$timetable->patients_pesel=$_POST['patients_pesel'][$i] ? : null;
			$timetable->payment=$_POST['payment'][$i] ? : null;
			$timetable->activation_code=$_POST['activation_code'][$i] ? : null;
			$timetable->save();
		}
		HTTP::redirect("admin/timetables/edit/".$_POST['user_id']."?date=".@$_POST['vaccination_date_day'][0]);
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
	
	public function action_delete_day(){
		$timetables=ORM::factory('Timetable')->where('vaccination_date', '>=', @$_GET['date'].' 00:00:00')
											->where('vaccination_date', '<=', @$_GET['date'].' 23:59:59')
											->where('users_id', '=', $this->request->param("id"))
											->find_all();
		foreach($timetables as $timetable){
			if(!$timetable->patients_pesel) $timetable->delete();
			elseif($timetable->patients_pesel && !$timetable->payment) die('wysłać powiadomienie o usunięciu wizyty z propozycją nowej daty?');
			elseif($timetable->patients_pesel && $timetable->payment) die('nie można usunąć zrealizowanego szczepienia');
			else die('nieznany przypadek!!!');
		}
		HTTP::redirect("admin/timetables");
	}
	
}