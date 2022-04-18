<?php class Model_Patient extends ORM {
	//protected $_table_name='users';
	
	protected $_primary_key="pesel";
	
	protected $_has_many=array(
			'timetables'=>array(
							'model'=>'Timetable',
							'foreign_key'=>'patients_pesel',
						),
	);//*/
}