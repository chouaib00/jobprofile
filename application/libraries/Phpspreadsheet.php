<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!defined('BASEPATH')) exit('No direct script access allowed');
include_once APPPATH.'third_party/PhpOffice/index.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Phpspreadsheet {
	private $limit_time_duration = 86400;//Seconds
	public $spreadsheet;
	public $sheet;
	public function getSpreadObj(){
			$this->spreadsheet = new Spreadsheet();
			$this->spreadsheet->getProperties()->setCreator("Brent Macatangay");
      $this->sheet = $this->spreadsheet->getActiveSheet();

			return $this->sheet;
	}


	public function write(){
		$writer = new Xlsx($this->spreadsheet);

		$dir = FCPATH.'/upload/spreadsheet/';
		if (!is_dir($dir)) {
		    mkdir($dir, 0777, true);
		}
		$files = glob($dir . "*");
		foreach($files as $file){
			if((time() - filemtime($file) ) > $this->limit_time_duration){
				unlink($file);
			}
		}
		//Close and output PDF document
		$spreadsheet_name = bin2hex(openssl_random_pseudo_bytes(4)).'.xlsx';
		$writer->save($dir.$spreadsheet_name);
		return $spreadsheet_name;
	}

	// public $pdf;
	// private $limit_count_file = 5;
	// private $limit_time_duration = 86400;//Seconds
	// public function generate($data){
	// 	//Filling up unset optional data
	//
	// 	/*
	// 	For more reference see, https://mpdf.github.io/reference/mpdf-functions/construct.html
	// 	Format list
	// 	- Letter
	// 	- Legal
	// 	- A3
	// 	- A4
	// 	'A0' - 'A10', 'B0' - 'B10', 'C0' - 'C10'
	// 	'4A0', '2A0', 'RA0' - 'RA4', 'SRA0' - 'SRA4'
	// 	'Letter', 'Legal', 'Executive', 'Folio'
	// 	'Demy', 'Royal'
	// 	'A' (Type A paperback 111x178mm)
	// 	'B' (Type B paperback 128x198mm)
	// 	'Ledger'*, 'Tabloid'*
	//
	// 	*/
	//
	//
	// 	$data['mode'] = (array_key_exists('mode', $data))? $data['mode'] : '';
	// 	$data['format'] = (array_key_exists('format', $data))? $data['format'] : 'Letter';
	// 	$data['font_size'] = (array_key_exists('font_size', $data))? $data['font_size'] : 10;
	// 	$data['font'] = (array_key_exists('font', $data))? $data['font'] : 'helvetica';
	// 	$data['margin_left'] = (array_key_exists('margin_left', $data))? $data['margin_left'] : 7;
	// 	$data['margin_right'] = (array_key_exists('margin_right', $data))? $data['margin_right'] : 7;
	// 	$data['margin_top'] = (array_key_exists('margin_top', $data))? $data['margin_top'] : 7;
	// 	$data['margin_bottom'] = (array_key_exists('margin_bottom', $data))? $data['margin_bottom'] : 3;
	// 	$data['margin_head'] = (array_key_exists('margin_head', $data))? $data['margin_head'] : 5;
	// 	$data['margin_foot'] = (array_key_exists('margin_foot', $data))? $data['margin_foot'] : 5;
	// 	$data['orientation'] = (array_key_exists('orientation', $data))? $data['orientation'] : 'P';
	// 	$data['title'] = (array_key_exists('title', $data))? $data['title'] : 'Applicant';
  //               $data['is_create'] = (array_key_exists('is_create', $data))? $data['is_create'] : true;
	//
	//
	// 	// $this->pdf = new \Mpdf\Mpdf(
	// 	// 					$data['mode'],
	// 	// 					($data['orientation'] == 'P')? $data['format'] : $data['format'].'-'.$data['orientation'],
	// 	// 					$data['font_size'],
	// 	// 					$data['font'],
	// 	// 					$data['margin_left'],
	// 	// 					$data['margin_right'],
	// 	// 					$data['margin_top'],
	// 	// 					$data['margin_bottom'],
	// 	// 					$data['margin_head'],
	// 	// 					$data['margin_foot'],
	// 	// 					$data['orientation']);
	// 	$this->pdf = new \Mpdf\Mpdf(array(
	// 		'mode'=>$data['mode']
	// 	,	'format'=>($data['orientation'] == 'P')? $data['format'] : $data['format'].'-'.$data['orientation']
	// 	,	'font_size' =>$data['font_size']
	// 	,	'font' =>$data['font']
	// 	,	'margin_left' =>$data['margin_left']
	// 	,	'margin_right' =>$data['margin_right']
	// 	,	'margin_top' =>$data['margin_top']
	// 	,	'margin_bottom' =>$data['margin_bottom']
	// 	,	'margin_head' =>$data['margin_head']
	// 	,	'margin_foot' =>$data['margin_foot']
	// 	,	'orientation' =>$data['orientation']
	// 	));
  //   $this->pdf->setAutoTopMargin = 'stretch';
  //   $this->pdf->setAutoBottomMargin = 'stretch';
	// 	$this->pdf->SetTitle($data['title']);
	// 	$this->pdf->SetAuthor('Brent Macatangay');
	// 	$this->pdf->SetCreator('Brent Macatangay');
	// 	$this->pdf->WriteHTML($data['html']);
	//
	//
  //   if($data['is_create']){
  //       echo json_encode(array("pdf_name"=>$this->generateFile($this->pdf)));
  //   }
  //   else{
  //       $this->pdf->Output();
  //   }
	//
	// }
	//

	//
	// // private function generateFile($pdfObj){
	// // 	$dir = FCPATH.'/pdf/';
	// //
	// // 	$files = glob($dir . "*");
	// // 	$filecount = ($files)? count($files) : 0 ;
	// // 	if($filecount>=$this->limit_count_file){//Remove the oldest file
	// //
	// // 		$excess_count = $filecount - ($this->limit_count_file-1);
	// // 		array_multisort(
	// // 			array_map( 'filemtime', $files ),
	// // 			SORT_NUMERIC,
	// // 			SORT_ASC,
	// // 			$files
	// // 		);
	// // 		for($i=0; $i<$excess_count; $i++){
	// // 		 	unlink($files[$i]);
	// // 		}
	// //
	// //
	// //
	// // 	}
	// //
  // //       //Close and output PDF document
  // //       $pdf_name = bin2hex(openssl_random_pseudo_bytes(4)).'.pdf';
  // //       $pdfObj->Output($dir.$pdf_name, 'F');
  // //       return $pdf_name;
  // //   }
}
