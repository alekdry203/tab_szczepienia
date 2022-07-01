<?php

class Controller_Welcome extends Controller_Main {

	public function action_index(){
		$this->template->content=View::factory("welcome/index");
	}
	
	public function action_mail_test(){
		$to=@$_POST['email'];
		$subject=@$_POST['subject'];
		$body=@$_POST['body'];
		$headers="From: olekdrynda@gmail.com\n";
		$headers.="MIME-Version: 1.0\r\n";
		$headers.="Content-Type: text/html; charset=UTF-8\n";
		if(!mail($to, $subject, $body, $headers)) die('error mailingu');
		HTTP::redirect("welcome/");
	}
	
	public function action_tcpdf_test(){
		$name='testowy_pdf';
		require_once('../TCPDF/tcpdf.php');
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);			
		$pdf->SetTitle($name);
		$pdf->setFontSubsetting(true);
		$pdf->SetFont('freeserif', 'b', 16);
		
		$pdf->setPageOrientation('L');
		
		$pdf->AddPage();
		
		$from_view=true;
		$to_file=false;
		
		if(@$from_view){
			$data=array();
			$view=View::factory("welcome/test_pdf", @$data);
			$pdf->writeHTML($view, true, false, true, false, '');
		}else{
			$pdf->Write(0, 'numer test', '', 0, 'L', true, 0, false, false, 0);
	
			$pdf->Ln();
			$pdf->Write(0, 'Test', '', 0, 'L', true, 0, false, false, 0);
				
			$pdf->SetFont('freeserif', '', 16);
			$pdf->Ln();
			$pdf->Write(0, 'Nazwa test', '', 0, 'L', true, 0, false, false, 0);
			$pdf->Ln();
			
			$pdf->SetFillColor(255,255,255);
			$pdf->SetFont('freeserif', '', 8);
			$pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(153, 153, 153)));
			$pdf->Ln();
			
			$pdf->MultiCell(55, 8, __('Działanie'), 1, 'C', 1, 0);
			$pdf->MultiCell(20, 8, __('Os. odpow.'), 1, 'C', 1, 0);
			$pdf->Ln();
			$pdf->MultiCell(10, 8, __('Prog.')."\n[%]", 1, 'C', 1, 0);
		}
		
		if(@$to_file){
			$pdf->Output(str_replace('application\classes\Controller', 'public\\', __DIR__).$name.".pdf", 'F'); //generowany do pliku w folderze public
		}else{
			$pdf->Output($name.".pdf"); //generowany do przeglądarki
		}
		
		die();
	}

} // End Welcome
