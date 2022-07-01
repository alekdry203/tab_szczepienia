<?php class Model_Log extends ORM {
	
	protected $_belongs_to=array(
			'users'=>array(
						'model'=>'User',
						'foreign_key'=>'user_id',
					),
			'patients'=>array(
						'model'=>'Patient',
						'foreign_key'=>'patient_pesel',
					),
	);//*/
	
	public function register(){
		$tab=array();
		if(@$_POST) $tab['post']=$_POST;
		if(@$_GET) $tab['get']=$_GET;
		$log=$this;
		$log->user_id=@$_SESSION['user_id'] ? : null;
		$log->patient_pesel=@$_SESSION['pesel'] ? : null;
		$log->ip=$_SERVER['REMOTE_ADDR'];
		$log->action_time=date('Y-m-d H:i:s');
		$log->url_path=$_SERVER['REQUEST_URI'];
		$log->data=json_encode($tab);
		$log->save();
	}
	
}