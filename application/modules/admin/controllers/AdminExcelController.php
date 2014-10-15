<?php
class Admin_AdminExcelController extends Zendvn_Controller_Action {
	
	//----- mang chua toan bo tham so nhan duoc o moi Action
	protected $_arrParam;

	//----- duong dan cua controller
	protected $_currentController;
	
	//----- duong dan cua Action mac dinh
	protected $_actionMain;
	
	//----- mang chua thong so phan trang
	protected $_paginator = array(
									'itemCountPerPage'=>10,
									'pageRange'=>3				
								);
	
	//----- bien chua ten session namespace
	protected $_namespace;
	
	//----- bien chua doi tuong translate
	protected $_translate;

		public function init() {
		//----- mang chua toan bo tham so nhan duoc o moi Action
		$this->_arrParam = $this->_request->getParams();
		
		//----- bien session luu toan bo ten cac session khac duoc tao trong qua trinh chay ung dung
		//----- moi khi co mot session duoc tao ra thi ten cua no se duoc luu vao day
		$ssAppSessionList = new Zend_Session_Namespace('app-session-list');
		
		//----- duong dan cua controller
		$this->_currentController = '/' . $this->_arrParam['module'] .
									'/' . $this->_arrParam['controller'];
		
		//----- duong dan cua Action mac dinh
		$this->_actionMain = $this->_currentController . '/index';
		
		//----- thiet lap trang hien tai cho doi tuong phan trang
		$this->_paginator['currentPage'] = $this->_request->getParam('page',1);
		$this->_arrParam['paginator'] = $this->_paginator;
		
		//----- lay bien translate tu Registry
		$this->_translate = Zend_Registry::get('Zend_Translate');
		
		//----- tao bien session luu cac du lieu nhu filter, sort...
		$this->_namespace = $this->_arrParam['module'] .'-' .$this->_arrParam['controller'];
		$ssFilter = new Zend_Session_Namespace($this->_namespace);
		$ssAppSessionList->sessionList .= ':' .$this->_namespace;
		
		if (empty($ssFilter->col)) {
			//----- tu khoa tim kiem
			$ssFilter->keywords = '';
			//----- cot sap xep
			$ssFilter->col = 'u.id';
			//----- huong sap xep
			$ssFilter->order = 'DESC';
			//----- loc user theo group id
			$ssFilter->group_id = 0;
		}
		//----- dua cac gia tri trong session ssFilter vao mang tham so _arrParam
		$this->_arrParam['ssFilter']['keywords'] = $ssFilter->keywords;
		$this->_arrParam['ssFilter']['col'] = $ssFilter->col;
		$this->_arrParam['ssFilter']['order'] = $ssFilter->order;
		$this->_arrParam['ssFilter']['group_id'] = $ssFilter->group_id;
		
		//----- truyen ra view
		$this->view->arrParam = $this->_arrParam;
		$this->view->currentController = $this->_currentController;
		$this->view->actionMain = $this->_actionMain;
		
		$template_path = TEMPLATE_PATH . "/admin/admin-v2";
		$this->loadTemplate($template_path,'template.ini','template');
	}

	public function indexAction() {
		//$this->_helper->viewRenderer->setNoRender();//ko lay view vao
		$this->view->Title = $this->_translate->_('admin-excel-index-title');
		$messenger="";
				if ($this->_request->isPost()) {
					//echo "SSSSSSS";
					//var_dump($this->_arrParam); 
					$upload = new Zend_File_Transfer_Adapter_Http();
					$fileInfo = $upload->getFileInfo('excel');
					$fileName = $fileInfo['excel']['name'];
					$temp = explode(".",$fileName );
					//var_dump( $fileInfo['excel']);
					$extension = end($temp);
					//var_dump($extension );
					if($extension=='xlsx'||$extension=='xls'){
						//code import viet o day ....
						$messenger="IMPORT Successfull";
							$objPHPExcel = new PHPExcel();
		
		 
		$objPHPExcel123 = PHPExcel_IOFactory::createReader('Excel2007');//Excel2003XML
		// $filename ='Attendance1.xlsx';//cho nay dang fix cung//'october-2014.xlsx';//'my-data-sheet1.xls';// 'october-2014.xls';
		 $filename =  $fileInfo['excel']['tmp_name'];//$temp.$extension;
			$excel2 = $objPHPExcel123->load($filename);
			//$excel2->getActiveSheet()->getProtection()->setSheet(true);
			
		  
	
  $dem_arr=array();
  $arr_salary=array();
  $array_INCENTIVE =array();
  $arr_id=array();
  $arr_LOCATION=array();
	foreach ($excel2->getWorksheetIterator() as $worksheet) {
		$worksheetTitle     = $worksheet->getTitle();
	  
		if($worksheetTitle =='Sheet1'){
			$highestRow         = $worksheet->getHighestRow(); // e.g. 10
			$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			$nrColumns = ord($highestColumn) - 64;
			
				for ($row = 1; $row <= $highestRow; ++ $row) {
					$dem=0;
					$name='';
					$salary=0;
					$INCENTIVE=0;
					$id=0;
					$LOCATION='';
					for ($col = 0; $col < $highestColumnIndex; ++ $col) {
						$cell = $worksheet->getCellByColumnAndRow($col, $row);
						$val = $cell->getValue();		           
						$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);		            
						if($col>7){
								echo '<td>'. $val .$col. $row.'</td>';
								if($val=="p"||$val=="P"){
								$dem++;
								}
							}
						$colE=31;		      
						if($col==1){
							$name=$val;
						 }	
						 if($col==3){
							$salary=$val;
						 }	
						 if($col==4){
							$INCENTIVE=$val;
						 }
						 if($col==0){
							$id=$val;
						 }	
						if($col==2){
							$LOCATION=$val;
						 }

					}
					
					 $arr_salary[$name]=$salary;
					 $array_INCENTIVE[$name]=$INCENTIVE;
					$dem_arr[$name]=$dem;
				  	$arr_id[$name]=$id;
				  	$arr_LOCATION[$name]=$LOCATION;
					}
			}
	}
//	var_dump($dem_arr);
	//var_dump($array_INCENTIVE);
	//var_dump($arr_salary);
	//var_dump($arr_id);
	//var_dump($arr_LOCATION);
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->setActiveSheetIndex(0);  
	 $column = 'A';

	$objPHPExcel->getActiveSheet()->setCellValue('B2','NAME');
	$objPHPExcel->getActiveSheet()->setCellValue('A2','SL.NO.');
	$objPHPExcel->getActiveSheet()->setCellValue('C2','LOCATION');
	$objPHPExcel->getActiveSheet()->setCellValue('D2','SALERY');
 	$objPHPExcel->getActiveSheet()->setCellValue('E2','MONTH DAYS');
	$objPHPExcel->getActiveSheet()->setCellValue('F2','PRESENT');
	$objPHPExcel->getActiveSheet()->setCellValue('G2','LEAVE');
	
	$objPHPExcel->getActiveSheet()->setCellValue('H2','AMOUNT BEFORE DEDUCTION');
 	$objPHPExcel->getActiveSheet()->setCellValue('I2','PF 12% Employee');
	$objPHPExcel->getActiveSheet()->setCellValue('J2','ESI 1.75% Employee');
	$objPHPExcel->getActiveSheet()->setCellValue('K2','AMOUNT AFTER DEDUCTION');
	$objPHPExcel->getActiveSheet()->setCellValue('L2','INCENTIVE AMOUNT');
	$objPHPExcel->getActiveSheet()->setCellValue('M2','NET INCENTIVE');
	$objPHPExcel->getActiveSheet()->setCellValue('N2','NET PAY'); 
	
	$num=0;
	foreach ($dem_arr as $name => $value) {
		$num++;
		$a=$num-2;
		$colA=$colB=$colC=$colD=$colE=$colF=$colG=$colH=$colI=$colJ=$colK=$colM=$colL=$colN='';
		if($arr_salary[$name]!=null){
			$colA=$arr_id[$name];
			$colB=$name;
			$colF=$value;
			//var_dump($colA);
			$colC=$arr_LOCATION[$name];
			var_dump($colC);
			$colD=$arr_salary[$name];
			$colE=31;
			$colF=$value;
			$songaynghi=$colG=31-$value;
			//TInh col H
			 $colH= $colD*$colF/31;
			 //Tinh col I
			if( $songaynghi < 6){
				$sheet2G = $songaynghi * 1.3;
			}else{
				$sheet2G = $songaynghi * 1.75;
				}		
			$sheet2F=26-$sheet2G;
			$sheet2H=$colD*$sheet2F/26;
			$colI=0.12*$sheet2H;
			//Tinh j
			$colJ=$sheet2H*0.0175;
			//Tinh K
			$colK=$colH-$colI-$colJ;
			//Tinh L
			$colL=$array_INCENTIVE[$name];
			//Tinh M
			$colM=$colL*$colF/$colE;
			//Tinh N
			$colN=$colK+$colM;
		}
		if($num>1 ){
			$hang=$num+1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$hang,$colA);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$hang,$colB);

			$objPHPExcel->getActiveSheet()->setCellValue('C'.$hang,$colC);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$hang,$colD);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$hang,$colE);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$hang,$colF);

			$objPHPExcel->getActiveSheet()->setCellValue('G'.$hang,$colG);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$hang,$colH);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$hang,$colI);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$hang,$colJ);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$hang,$colK);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$hang,$colL);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$hang,$colM);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$hang,$colN);
			
		}
		
	}
	
	header('Content-Disposition: attachment;filename="my_excel.xlsx"');
	header('Content-Type: application/vnd.ms-excel');
	//header('Content-Disposition: attachment;filename="'.$safe_filename.'"');
	header('Cache-Control: max-age=0');	
	ob_end_clean(); 
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
	$objWriter->save('php://output'); 
	//header("location: admin/admin-excel/sdfsdf");
	//echo "<script> document.location.href='admin/admin-excel/sdfsdf';</script>";
/*	*/
					}else{
						$messenger="Error file ,please try again ! ";

					}

				}
		$this->view->mes=$messenger;		
	}
}