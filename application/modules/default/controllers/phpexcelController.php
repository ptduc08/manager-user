<?php
class phpexcelController extends Zendvn_Controller_Action {
	
	//----- mang chua toan bo tham so nhan duoc o moi Action
	protected $_arrParam;
	
	//----- duong dan cua controller
	protected $_currentController;
	
	//----- duong dan cua Action mac dinh
	protected $_actionMain;
	
	//----- mang chua thong so phan trang
	protected $_paginator = array(
			'itemCountPerPage'=>9,
			'pageRange'=>3
	);
	
	//----- bien chua ten session namespace
	protected $_namespace;
	
	//----- bien chua doi tuong translate
	protected $_translate;
	

	
	public function indexAction() {
		$this->_helper->viewRenderer->setNoRender();//ko lay view vao

		  $objPHPExcel = new PHPExcel();
		
		 
		$objPHPExcel123 = PHPExcel_IOFactory::createReader('Excel2007');//Excel2003XML
		 $filename ='MyExcel.xlsx';//'october-2014.xlsx';//'my-data-sheet1.xls';// 'october-2014.xls';
			$excel2 = $objPHPExcel123->load($filename);
			$excel2->getActiveSheet()->getProtection()->setSheet(true);
			
		  
	
  $dem_arr=array();
	foreach ($excel2->getWorksheetIterator() as $worksheet) {
		$worksheetTitle     = $worksheet->getTitle();
	  
		if($worksheetTitle =='ATTENDENCE'){
			$highestRow         = $worksheet->getHighestRow(); // e.g. 10
			$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			$nrColumns = ord($highestColumn) - 64;
			//echo "<br>The worksheet ".$worksheetTitle." has ";
			//echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
			//echo ' and ' . $highestRow . ' row.';
			echo '<br>Data: <table border="1"><tr>';
			
			for ($row = 1; $row <= $highestRow; ++ $row) {
				$dem=0;
				$name='';
				echo '<tr>';
				for ($col = 0; $col < $highestColumnIndex; ++ $col) {
					$cell = $worksheet->getCellByColumnAndRow($col, $row);
					$val = $cell->getValue();		           
					$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);		            
					if($col>1){
							echo '<td>'. $val .'<br>'.'col:'.$col.'<br>'.'row:'. $row.'</td>';
							if($val=="p"||$val=="P"){
							$dem++;
							}
						}
					$colE=31;		      
					if($col==1){
						$name=$val;
					 }	

				}
				//echo '<td>'.'dem='. $dem.'</td>';
				$dem_arr[$name]=$dem;
			   // var_dump($dem);
			   // var_dump($name);
			   // var_dump( $dem_arr)	;	
			   echo '</tr>';
				
				
				}
				echo '</table>';
			}
			//echo 'sdf';
		//var_dump($dem_arr);


	}	
	var_dump($dem_arr);
	foreach ($dem_arr as $key => $value) {
		$tblUser = new Default_Model_Phpexcel();			
				$arrParam['fullname'] =$key;
				$arrParam['countxfghcvjbxdghvhnlkkl'] =$value;// $dem_arr[$name];
				//$tblUser->saveItem($arrParam,array('task'=>'admin-excel-add'));	
		# code...
	}
		//sheet 1
	foreach ($excel2->getWorksheetIterator() as $worksheet) {
		$worksheetTitle     = $worksheet->getTitle();

			if($worksheetTitle =='Sheet1'){
			$highestRow         = $worksheet->getHighestRow(); // e.g. 10
			$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			$nrColumns = ord($highestColumn) - 64;
			echo "<br>The worksheet ".$worksheetTitle." has ";
			//echo '<br>Data: <table border="1"><tr>';
			
			for ($row = 1; $row <= $highestRow; ++ $row) {
				//echo '<tr>';		    	
				for ($col = 0; $col < $highestColumnIndex; ++ $col) {		    		
					$cell = $worksheet->getCellByColumnAndRow($col, $row);
					$val = $cell->getValue();		           
					$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
					//echo '<td>'.$val.'<br>'.'cot:'.$col.'hang'. $row.'</td>';
					if($col==3){$SALERY=$val;}  
					 if($col==1){$ten=$val;}  
					 
				} 
				if($row>2){
					// echo '<td>'.'SALERY:'.$SALERY.'</td>';
					// $colF= $dem_arr[$ten];  //so ngay di lam
				//	 echo '<td>'.'ten:'.$ten.'</td>';
				  //   var_dump($dem_arr);
					  $colF= $dem_arr[$ten];  //so ngay di lam
					  $songaynghi=31-$colF;
					  //$sheet2G
					  //neu so ngay nghi <6 $sheet2G =1.3*$songaynghi;
					  //neu ko $sheet2G =1.75*$songaynghi;
					  //$sheet2F=26-$sheet2G ;
					  //$sheet2H=$SALERY*$sheet2F/26
					 // $colI=0.12*$sheet2H;
				//	  echo '<td>'.'colF:'.$colF.'</td>';
					  $colH= $SALERY*$colF/31;
					//  echo '<td>'.'colH:'.$colH.'</td>';
					  
					  if( $songaynghi < 6){
						
						$sheet2G = $songaynghi * 1.3;
						// echo '<td>'.'sheet2G:'.$sheet2G.'</td>';
					  }
					  else{
						$sheet2G = $songaynghi * 1.75;
					//	echo '<td>'.'sheet2G:'.$sheet2G.'</td>';
					  }
					 $sheet2F=26-$sheet2G;
					// echo '<td>'.'sheet2F:'.$sheet2F.'</td>';
					 $sheet2H=$SALERY*$sheet2F/26;
				//	 echo '<td>'.'sheet2H:'.$sheet2H.'</td>';
					 $colI=0.12*$sheet2H;
				//	 echo '<td>'.'colI:'.$colI.'</td>';

			//	echo '</tr>';	

			}
			//echo '</table>'; 


		}
		

		}

	//end sheet 1
	//$name = $val;

				//$this->_redirect($this->_actionMain);	

}
	}	//end indexaction
	/*
	public function export2Action(){
		$this->_helper->viewRenderer->setNoRender();//ko lay view vao
		$objPHPExcel = new PHPExcel();
		$objPHPExcel123 = PHPExcel_IOFactory::createReader('Excel2007');//Excel2003XML
		$filename ='Attendance1.xlsx';//'october-2014.xlsx';//'my-data-sheet1.xls';// 'october-2014.xls';
		$excel2 = $objPHPExcel123->load($filename);
		$excel2->getActiveSheet()->getProtection()->setSheet(true);

		$dem_arr=array();
		foreach ($excel2->getWorksheetIterator() as $worksheet) {
			
			$worksheetTitle = $worksheet->getTitle();
			if ($worksheetTitle=='Sheet1') {
				
			$highestRow         = $worksheet->getHighestRow(); // e.g. 10
			$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			$nrColumns = ord($highestColumn) - 64;
echo '<table border=1>'; 
 				for ($row = 1; $row <= $highestRow; ++ $row) {
					$dem=0;
					$name='';
					echo '<tr>';
					for ($col = 0; $col < $highestColumnIndex; ++ $col) {
						$cell = $worksheet->getCellByColumnAndRow($col, $row);
						$val = $cell->getValue();		           
						$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
						echo '<td>'. $val .'<br>'.'col:'.$col.'<br>'.'row:'. $row.'</td>';		            
						if($col>7){
								
								if($val=="p"||$val=="P"){
								$dem++;
								//var_dump($dem);
								}
							}
						$colE=31;		      
						if($col==1){
							$name=$val;
							//var_dump($name);
						 }
						if($col==3){
						$salery = $val;
						//echo '<td>'.$salery.'</td>';
						} 
						if($col == 4){
						$INCENTIVE_AMOUNT = $val;
						//echo '<td>'.$INCENTIVE_AMOUNT.'</td>';
						}
						if($col == 5){
						$EMPLOYEE_ESIC_175 = $val;
						$EMPLOYEE_ESIC_175 = $salery*0.0175;
						//echo '<td>'.$EMPLOYEE_ESIC_175.'</td>';
						}
						if($col == 6){
						$EMPLOYER_ESIC_425 = $val;
						$EMPLOYER_ESIC_425 = $salery*0.0425;
						//echo '<td>'.$EMPLOYER_ESIC_425.'</td>';
						}
						if($col == 7){
						$EMPLOYEE_PF_12 = $val;
						$EMPLOYEE_PF_12 = $salery*0.12;
						//echo '<td>'.$EMPLOYEE_PF_12.'</td>';
						}
						
					}
					
					//$dem_arr[$name]=$dem;
				//	var_dump($dem_arr);	
//var_dump($dem);					
					} 
					echo '</tr>';	
				}
				echo '</table>'; 
				
		}
		
	}
*/
public function export1Action() {
	$this->_helper->viewRenderer->setNoRender();//ko lay view vao
	$objPHPExcel = new PHPExcel();
		
		 
		$objPHPExcel123 = PHPExcel_IOFactory::createReader('Excel2007');//Excel2003XML
		 $filename ='Attendance1.xlsx';//'october-2014.xlsx';//'my-data-sheet1.xls';// 'october-2014.xls';
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
	var_dump($arr_LOCATION);
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
			//var_dump($colC);
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
	/*
	header('Content-Disposition: attachment;filename="my_excel.xlsx"');
	header('Content-Type: application/vnd.ms-excel');
	//header('Content-Disposition: attachment;filename="'.$safe_filename.'"');
	header('Cache-Control: max-age=0');	
	ob_end_clean(); 
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
	$objWriter->save('php://output'); 
	*/
}
public function exportAction() {
$this->_helper->viewRenderer->setNoRender();//ko lay view vao

		$objPHPExcel = new PHPExcel();		 
		$objPHPExcel123 = PHPExcel_IOFactory::createReader('Excel2007');
		$filename ='MyExcel.xlsx';
        $excel2 = $objPHPExcel123->load($filename);
        $excel2->getActiveSheet()->getProtection()->setSheet(true);
		foreach ($excel2->getWorksheetIterator() as $worksheet) {
	    $worksheetTitle     = $worksheet->getTitle();

			if($worksheetTitle =='Sheet1'){
			$highestRow         = $worksheet->getHighestRow(); // e.g. 10
		    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
		    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		    $nrColumns = ord($highestColumn) - 64;
		   // echo "<br>The worksheet ".$worksheetTitle." has ";
		  //  echo '<br>Data: <table border="1"><tr>';
		    for ($row = 1; $row <= $highestRow; ++ $row) {
		    	echo '<tr>';		    	
		    	for ($col = 0; $col < $highestColumnIndex; ++ $col) {		    		
		            $cell = $worksheet->getCellByColumnAndRow($col, $row);
		            $val = $cell->getValue();		           
		            $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
		           // echo '<td>'.$val.'<br>'.'cot:'.$col.'hang'. $row.'</td>';
				
		        } 

		        echo '</tr>';		       
		    }
		    echo '</table>';  
			//var_dump($val[1][3]);
			

		}

		}
		echo '<table border=1>
		<tr>
<td>sl no</td>
<td>name</td>
<td>location</td>
<td>salery</td>
<td>month days</td>

		</tr>
		<tr>
		<td>aa</td>
		</tr>
		</table>
		';
$objPHPExcel = new PHPExcel();  
// Set the active Excel worksheet to sheet 0 
$objPHPExcel->setActiveSheetIndex(0);  
// Initialise the Excel row number 

// Redirect output to a client’s web browser (Excel5) 
//header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="Limesurvey_Results.xls"'); 
//header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save('php://output');		
		
}
//end exportAction
}
