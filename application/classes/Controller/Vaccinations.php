<?php

class Controller_Vaccinations extends Controller_Main {

	public function action_index(){
		if(!@$_GET['vaccination_date']) $_GET['vaccination_date']=date('Y-m-d');
		$timetables=ORM::factory('Timetable')->where('patients_pesel', 'is', null);
		if(@$_GET) $this->filter_timetables($timetables);
		$data['timetables']=$timetables->order_by('vaccination_date')->find_all();
		
		$data['vaccines']=ORM::factory('Vaccinationwarehouse')
									->join(array('timetable', 'tt'), 'left')
									->on('tt.vaccinations_warehouse_serial_no', '=', 'serial_no')
									->where('expiration_date', '>=', date('Y-m-d'))
									->where('tt.patients_pesel', 'is', null)
									->group_by('producer')
									->group_by('name')
									->order_by('producer')
									->order_by('name')
									->find_all();
		if(!@$_GET['vaccine']) $_GET['vaccine']=$data['vaccines'][0]->name.';'.$data['vaccines'][0]->producer;
		
		$this->template->content=View::factory("vaccinations/index", $data);
	}
	
	private function filter_timetables($timetables){
		if(@$_GET['vaccination_date']) $timetables->where('vaccination_date', '>=', @$_GET['vaccination_date'].' 00:00:00')
													->where('vaccination_date', '<=', @$_GET['vaccination_date'].' 23:59:59');
	}
	
	public function action_vaccines(){
		$data['vaccines']=ORM::factory('Vaccinationwarehouse')->group_by('producer')->group_by('name')->order_by('producer')->order_by('name')->find_all();
		$this->template->content=View::factory("vaccinations/vaccines", $data);
	}
	
	public function action_sign_up(){
		$this->check_if_logged();
		die('wybrane z listy wszystko - wysłać kod aktywacyjny');
		
		$vaccination=ORM::factory('Timetable', $this->request->param("id"));
		$tmp=explode($_GET['vaccine']);
		if(!$tmp[0] || !$tmp[1] || !$vaccination->id) HTTP::redirect("vaccinations/index?fail=1");
		
		$vaccine=ORM::factory('Vaccinationwarehouse')
									->join(array('timetable', 'tt'), 'left')
									->on('tt.vaccinations_warehouse_serial_no', '=', 'serial_no')
									->where('expiration_date', '>=', $vaccination->vaccination_date)
									->where('tt.patients_pesel', 'is', null)
									->where('name', 'like', $tmp[0])
									->where('producer', 'like', $tmp[1])
									->order_by('serial_no', 'asc')
									->find();
		
		$vaccination->vaccinations_warehouse_serial_no=$vaccine->serial_no;
		$vaccination->patients_pesel=$_SESSION['pesel'];
		$vaccination->activation_code=substr(uniqid(),0,12);
		$vaccination->save();
		//die('wysłać maila z potwierdzeniem i kodem aktywacyjnym szczepienia');
		$this->vaccination_reservation_mail($vaccination);
		HTTP::redirect("vaccinations/history");
	}
	
	private function vaccination_reservation_mail($vaccination){
		//$patient=ORM::factory('Patient', $vaccination->patients_pesel);
		$body=View::factory("vaccinations/vaccination_reservation_mail", compact('vaccination'));
		//$body='testowa wiadomość';
		//$headers; //dodać jak nie działa
		mail($vaccination->patient->email, 'Szczepienia - rezerwacja szczepienia', $body);
	}
	
	private function check_if_logged(){
		if(@$_SESSION['user_name'] && @$_SESSION['user_surname'] && @$_SESSION['pesel']) return;
		$_SESSION['redirect']=str_replace(URL::base().'index.php/', '', $_SERVER['REQUEST_URI']);
		HTTP::redirect("login");/*/
		$_SESSION['pesel']=12345678901;
		$_SESSION['user_name']='Grzegorz';
		$_SESSION['user_surname']='Brzęczyszczykliewicz';//*/
	}
	
	public function action_history(){
		$this->check_if_logged();
		$data['patient']=RM::factory('Patient', @$_SESSION['pesel']);
		$vaccinations=$data['patient']->timetables;
		if(@$_GET) $this->filter_history($vaccinations);
		$data['vaccinations']=$vaccinations->find_all();
		$this->template->content=View::factory("vaccinations/history", $data);
	}
	
	private function filter_history($vaccinations){
		if(@$_GET['vaccination_date'][0]) $vaccinations->where('vaccination_date', '>=', @$_GET['vaccination_date'][0]);
		if(@$_GET['vaccination_date'][1]) $vaccinations->where('vaccination_date', '>=', @$_GET['vaccination_date'][1]);
		
		if(@$_GET['name'] || @$_GET['producer']) $vaccinations->join(array('vaccinations_warehouse', 'vw'), 'left')->on('vw.serial_no', '=', 'vaccinations_warehouse_serial_no');//->group_by('id');
		if(@$_GET['name']) $vaccinations->where('vw.name', 'like', '%'.@$_GET['name'].'%');
		if(@$_GET['producer']) $vaccinations->where('vw.producer', 'like', '%'.@$_GET['producer'].'%');
		
		if(@$_GET['status']==1) $vaccinations->where('patients_pesel', 'is', null);
		elseif(@$_GET['status']==2) $vaccinations->where('patients_pesel', 'is not', null)->where('payment', 'is', null);
		elseif(@$_GET['status']==3) $vaccinations->where('payment', 'is not', null);//*/
	}
	
}