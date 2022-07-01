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
		if(@$_GET['date'][0]) $timetables->where('vaccination_date', '>=', $_GET['date'][0].' 00:00:00');
		if(@$_GET['date'][1]) $timetables->where('vaccination_date', '<=', $_GET['date'][1].' 23:59:59');
		if(@$_GET['user_id']) $timetables->where('users_id', '=', $_GET['user_id']);
		if(@$_GET['patient_pesel']) $timetables->where('patients_pesel', '=', $_GET['patient_pesel']);
		if(@$_GET['status']==1) $timetables->where('patients_pesel', 'is', null);
		elseif(@$_GET['status']==2) $timetables->where('patients_pesel', 'is not', null)->where('payment', 'is', null);
		elseif(@$_GET['status']==3) $timetables->where('payment', 'is not', null);
	}
	
	public function action_add(){
		if(@$_POST) $this->save_add();
		$data['users']=ORM::factory('User')->order_by('name')->order_by('surname')->find_all();
		$this->template->content=View::factory("admin/timetables/add", $data);
	}
	
	private function save_add(){
		$time=strtotime($_POST['date'].' '.$_POST['time']);
		for($i=0; $i<$_POST['amount']; $i++){
			$check=ORM::factory('Timetable')
						->where('users_id', '=', @$_POST['user_id'])
						->where('vaccination_date', '>=', date('Y-m-d H:i:s', ($time+($i*60*$_POST['period'])-(3*60))))
						->where('vaccination_date', '<=', date('Y-m-d H:i:s', ($time+($i*60*$_POST['period'])+(3*60))))
						->find();
						
			if($check->id) continue;
			$tmp=date('Y-m-d H:i:s', ($time+($i*60*$_POST['period'])));
			$timetable=ORM::factory('Timetable');
			$timetable->vaccination_date=$tmp;
			$timetable->users_id=@$_POST['user_id'];
			$timetable->save();
		}
		HTTP::redirect("admin/timetables/index");
	}
	
	public function action_edit(){
		if(@$_POST) $this->save_edit();
		$data['timetable']=ORM::factory('Timetable', $this->request->param("id"));
		$data['users']=ORM::factory('User')->order_by('name')->order_by('surname')->find_all();
		
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
		$this->template->content=View::factory("admin/timetables/edit", $data);
	}
	
	private function save_edit(){
		$timetable=ORM::factory('Timetable', $_POST['id']);
		$timetable->vaccination_date=$_POST['date'].' '.$_POST['time'];
		
		if(!$timetable->id || ($timetable->vaccine->name.';'.$timetable->vaccine->producer!=@$_POST['vaccine'] && @$_POST['vaccine'])){
			$tmp=explode(';', $_POST['vaccine']);
			$vaccine=ORM::factory('Vaccinationwarehouse')
									->join(array('timetable', 'tt'), 'left')
									->on('tt.vaccinations_warehouse_serial_no', '=', 'serial_no')
									->where('expiration_date', '>=', $timetable->vaccination_date)
									->where('tt.patients_pesel', 'is', null)
									->where('name', 'like', $tmp[0])
									->where('producer', 'like', $tmp[1])
									->order_by('serial_no', 'asc')
									->find();
			
			if($vaccine->serial_no) $timetable->vaccinations_warehouse_serial_no=$vaccine->serial_no;
		}
		
		$timetable->users_id=$_POST['user_id'];
		
		$mail=false;
		if(!$timetable->patients_pesel && @$_POST['patients_pesel']){
			$timetable->activation_code=substr(uniqid(),0,12);
			if($timetable->vaccinations_warehouse_serial_no) $mail=true;
		}
		
		$timetable->patients_pesel=@$_POST['patients_pesel'] ? : null;
		$timetable->payment=@$_POST['payment'] ? : null;
		//$timetable->activation_code=$_POST['activation_code'] ? : null;
		$timetable->save();
		
		if($mail){
			die('mail');
			$body=View::factory("vaccinations/vaccination_reservation_mail", array('vaccination'=>$timetable));
			mail($timetable->patient->email, 'Szczepienia - rezerwacja szczepienia', $body);
		}
		
		HTTP::redirect("admin/timetables/index");
	}
	
	public function action_delete(){
		$timetable=ORM::factory('Timetable', $this->request->param("id"));
		if(!$timetable->patients_pesel) $timetable->delete();
		/*elseif($timetable->patients_pesel && !$timetable->payment) die('wysłać powiadomienie o usunięciu wizyty z propozycją nowej daty?');
		elseif($timetable->patients_pesel && $timetable->payment) die('nie można usunąć zrealizowanego szczepienia');
		else die('nieznany przypadek!!!');//*/
		HTTP::redirect("admin/timetables");
	}
	
	public function action_pdf(){
		$data['vaccination']=ORM::factory('Timetable', $this->request->param("id"));
		$data['patient']=ORM::factory('Patient', $data['vaccination']->patients_pesel);
		
		$name=$data['patient']->pesel.'_'.str_replace(':', '-', $data['vaccination']->vaccination_date);
		$name.='_'.$data['vaccination']->vaccine->name.'_'.$data['vaccination']->vaccine->producer;
		require_once('../TCPDF/tcpdf.php');
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);			
		$pdf->SetTitle($name);
		$pdf->setFontSubsetting(true);
		$pdf->SetFont('freeserif', 'b', 16);
		$pdf->setPageOrientation('L');
		$pdf->AddPage();
		
		$to_file=false;
		
		$view=View::factory("patients/pdf", @$data);
		$pdf->writeHTML($view, true, false, true, false, '');
		
		if(@$to_file){
			$pdf->Output(str_replace('application\classes\Controller', 'public\\', __DIR__).$name.".pdf", 'F'); //generowany do pliku w folderze public
		}else{
			$pdf->Output($name.".pdf"); //generowany do przeglądarki
		}
		
		die();
	}
	
}