<?php
class Default_Model_Phpexcel extends Zend_Db_Table {
	//
	protected $_name = 'employee_excel';
	protected $_primary = 'id_excel';

		public function saveItem($arrParam = null, $options = null) {
		if ($options['task'] == 'admin-excel-add') {echo 'qua day';var_dump($arrParam)		;	
		//$name = $arrParam['fullname'];
			$row 				= $this->fetchNew();
			$row->fullname 	= $arrParam['fullname'] ; //$arrParam['fullname'];			
			$row->count			=$arrParam['countxfghcvjbxdghvhnlkkl'];	
			
					
			$row->save();
		}
		
		
	}
	//
}	