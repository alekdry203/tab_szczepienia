<?php class Model_Vaccinationwarehouse extends ORM {
	protected $_table_name='vaccinations_warehouse';
	
	protected $_primary_key="serial_no";
	
	protected $_has_many=array(
			'timetables'=>array(
							'model'=>'Timetable',
							'foreign_key'=>'vaccinations_warehouse_serial_no',
						),
	);//*/
}