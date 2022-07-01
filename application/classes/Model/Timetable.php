<?php class Model_Timetable extends ORM {
	
	protected $_table_name='timetable';
	
	protected $_belongs_to=array(
			'user'=>array(
						'model'=>'User',
						'foreign_key'=>'users_id',
					),
			'patient'=>array(
						'model'=>'Patient',
						'foreign_key'=>'patients_pesel',
					),
			'vaccine'=>array(
						'model'=>'Vaccinationwarehouse',
						'foreign_key'=>'vaccinations_warehouse_serial_no',
					),
	);//*/
}