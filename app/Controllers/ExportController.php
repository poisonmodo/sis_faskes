<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use \TCPDF;

class ExportController extends AppController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function get_student_ijazah()
	{
		$ExportModel = new \App\Models\ExportModel();
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();

		helper('url');
		$uri = service('uri');
		$dat = $this->request->getPost();
		$studentlist = $ExportModel->get_student_ijazah_xls($dat);
		
		// if ($this->request->getPost('exportbtn')) {
			
			
		// 	// Create new Spreadsheet object
		// 	$spreadsheet = new Spreadsheet();

		// 	$spreadsheet->setActiveSheetIndex(0);
		
		// 	$spreadsheet->getActiveSheet()->mergeCells("A1:Q1")->setTitle('Laporan Ijazah '.date('d-m-Y H'));
			
		// 	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		// 	$spreadsheet->setActiveSheetIndex(0);

		// 	//Get Data 
		// 	if($studentlist) {
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Mahasiswa');
		// 		$spreadsheet->setActiveSheetIndex(0)
		// 						->getStyle('A4:R4')
		// 						->getBorders()
		// 						->getAllBorders()
		// 						->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		// 		//Attribut
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('A4', 'No');
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('B4', 'NIM Mahasiswa');
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('C4', 'Nama Mahasiswa');
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('D4', 'Jenis Kelamin');
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('E4', 'Tempat/Tanggal Lahir');
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('F4', 'No KTP');
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('G4', 'No Handphone');
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('H4', 'Alamat Email');
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('I4', 'Alamat');
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('J4', 'Kota');
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('K4', 'Propinsi');
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('L4', 'Kode Pos');
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('M4', 'Nama Ayah');
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('N4', 'Nama Ibu');
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('O4', 'Jurusan');
		// 	 	$spreadsheet->setActiveSheetIndex(0)->setCellValue('P4', 'Tahun Ajaran');
		// 		$spreadsheet->setActiveSheetIndex(0)->setCellValue('Q4', 'No Ijazah');
		// 	 	$spreadsheet->setActiveSheetIndex(0)->setCellValue('R4', 'Tanggal Yudisium');
			 	 
		// 	 	$spreadsheet->setActiveSheetIndex(0)
		// 						->getStyle('A4:R4')
		// 						->getFont()->setBold(true);
				
		// 		foreach (range('A','N') as $col) {
		// 			$spreadsheet->setActiveSheetIndex(0)->getColumnDimension($col)->setAutoSize(true);
		// 		}		
								

		// 		//Get Data
		// 		$y=4;$no=0;
		// 		foreach($studentlist as $student) {
		// 			$y++;
		// 			$no++;
		// 			$spreadsheet->setActiveSheetIndex(0)
		// 						->getStyle('A'.$y.':R'.$y)
		// 						->getBorders()
		// 						->getAllBorders()
		// 						->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);	

								
		// 			if($student->jenis_kelamin==1) {
		// 				$jns="Pria";
		// 			}
		// 			else if($student->jenis_kelamin==2) {
		// 				$jns="Wanita";
		// 			}
		// 			$lahir="";	
		// 			if($student->tempat_lahir && $student->tgl_lahir) {
		// 				$lahir = $student->tempat_lahir.", ".date("d F Y",strtotime($student->tgl_lahir));
		// 			}	

		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$y, $no);
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$y, $student->nim);
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$y, $student->nama_lengkap);
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$y, $jns);
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$y, $lahir);
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$y, $student->no_identitas);
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$y, $student->hp);
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('H'.$y, $student->email);
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('I'.$y, $student->alamat_rumah);
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('J'.$y, $student->kota);
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('K'.$y, $student->propinsi);
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('L'.$y, $student->kodepos);
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('M'.$y, $student->nama_ayah);
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('N'.$y, $student->nama_ibu);
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('O'.$y, $student->jurusan);
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('P'.$y, $student->tahun_akademik);	
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('Q'.$y, $student->no_ijazah);	
		// 			$spreadsheet->setActiveSheetIndex(0)->setCellValue('R'.$y, $student->tgl_lulus);	
		// 		}
		// 		//Redirect output to a client’s web browser (Xlsx)
		// 		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		// 		header('Content-Disposition: attachment;filename="Laporan_ijazah.xlsx"');
		// 		header('Cache-Control: max-age=0');
		// 		// If you're serving to IE 9, then the following may be needed
		// 		header('Cache-Control: max-age=1');

		// 		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		// 		$writer->save('php://output');
		// 		exit;
		// 	}
				 
		
		// }

		if ($this->request->getPost('exportbtn2')) {
			$this->ijazah_printpdf($studentlist);
		}

		$jurusanlist = $CollegeStudentModel->get_jurusan_select();
		$tahunlist = $CollegeStudentModel->get_tahun_select();

		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"group_id" => $this->viewdata["group_id"],
			"studentlist" => $studentlist,
			"page" => "get_students_ijazah_export_xls",
			"jurusanlist" => $jurusanlist,
			"tahunlist" => $tahunlist,	
			"nim" => (!isset($dat["nim"]))?"":$dat["nim"],
			"nama" => (!isset($dat["nama"]))?"":$dat["nama"],
			"jurusan_id" => (!isset($dat["jurusan"]))?"":$dat["jurusan"],
			"tahun_ajaran" => (!isset($dat["thn_ajaran"]))?"":$dat["thn_ajaran"],
			"no_ijazah" => (!isset($dat["no_ijazah"]))?"":$dat["no_ijazah"],
			"thn_lulus" => (!isset($dat["thn_lulus"]))?"":$dat["thn_lulus"]
		];	
		
		return view('exports/get_students_ijazah',$data);
	}

	public function ijazah_printpdf($studentlist) {

		$pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);

		// $pdf->SetCreator(PDF_CREATOR);
		// $pdf->SetAuthor('Dea Venditama');
		// $pdf->SetTitle('Invoice');
		// $pdf->SetSubject('Invoice');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->addPage();
		
		$html='<table border="1" cellpadding="5" style="font-size:6px">
					<thead>
						<tr>
							<td style="width:25px;text-align:center;font-weight:bold;vertical-align:middle;">No</td>
							<td style="width:55px;text-align:center;font-weight:bold;vertical-align:middle;">NIM Mahasiswa</td>
							<td style="width:70px;text-align:center;font-weight:bold;vertical-align:middle;">Nama Mahasiswa</td>
							<td style="width:55px;text-align:center;font-weight:bold;vertical-align:middle;">Jurusan</td>
							<td style="width:50px;text-align:center;font-weight:bold;vertical-align:middle;">Tanggal Yudisium</td>
							<td style="width:60px;text-align:center;font-weight:bold;vertical-align:middle;">Tahun Akademik</td>
							<td style="width:50px;text-align:center;font-weight:bold;vertical-align:middle;">Tanggal Ijazah</td>
							<td style="width:70px;text-align:center;font-weight:bold;vertical-align:middle;">No Ijazah</td>
							<td style="width:100px;text-align:center;font-weight:bold;vertical-align:middle;">Foto Ijazah</td>
						</tr>
					</thead>
					<tbody>';
		$n = count($studentlist);
		$path=FCPATH."/images/ijazah";
		for($a=0;$a<$n;$a++) {
			$b=$a+1;
			$html.='	<tr>
							<td style="width:25px;">'.$b.'</td>
							<td style="width:55px">'.$studentlist[$a]->nim.'</td>
							<td style="width:70px;">'.$studentlist[$a]->nama_lengkap.'</td>
							<td style="width:55px;">'.$studentlist[$a]->jurusan.'</td>
							<td style="width:50px;">'.$studentlist[$a]->tanggal_yudisium.'</td>
							<td style="width:60px;">'.$studentlist[$a]->tahun_akademik.'</td>
							<td style="width:50px;">'.$studentlist[$a]->tanggal_ijazah.'</td>
							<td style="width:70px;">'.$studentlist[$a]->no_ijazah.'</td>
							<td style="width:100px;">';
							
			$imgpath = $path."/".$studentlist[$a]->nim; 
			$imgurl = site_url("images/ijazah/".$studentlist[$a]->nim."/".$studentlist[$a]->filename);      
			if(file_exists($imgpath."/".$studentlist[$a]->filename)) { 
				$html.='		<img src="'.$imgurl.'">';   
            }
							
			$html.='		</td>
							
						</tr>';
		}
		$html.="	
					</tbody>
			   </table>";	
		// echo $html;
		// exit();
		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');
		//line ini penting
		$this->response->setContentType('application/pdf');
		//Close and output PDF document
		$pdf->Output('laporan_ijazah.pdf', 'D');
	}


	
	public function students_printpdf($studentlist) {

		$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

		// $pdf->SetCreator(PDF_CREATOR);
		// $pdf->SetAuthor('Dea Venditama');
		// $pdf->SetTitle('Invoice');
		// $pdf->SetSubject('Invoice');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->addPage();
		
		$html='<table border="1" cellpadding="5" style="font-size:7px">
					<thead>
						<tr>
							<td style="width:25px;text-align:center;font-weight:bold;vertical-align:middle;">No</td>
							<td style="width:60px;text-align:center;font-weight:bold;vertical-align:middle;">NIM Mahasiswa</td>
							<td style="width:75px;text-align:center;font-weight:bold;vertical-align:middle;">Nama Mahasiswa</td>
							<td style="width:95px;text-align:center;font-weight:bold;vertical-align:middle;">Tempat/Tanggal Lahir</td>
							<td style="width:38px;text-align:center;font-weight:bold;vertical-align:middle;">Jenis Kelamin</td>
							<td style="width:60px;text-align:center;font-weight:bold;vertical-align:middle;">Jurusan</td>
							<td style="width:60px;text-align:center;font-weight:bold;vertical-align:middle;">Tahun Akademik</td>
							<td style="width:80px;text-align:center;font-weight:bold;vertical-align:middle;">Nama Orang Tua/Wali</td>
							<td style="width:130px;text-align:center;font-weight:bold;vertical-align:middle;">Alamat Orang Tua/Wali</td>
						</tr>
					</thead>
					<tbody>';
		$n = count($studentlist);
		for($a=0;$a<$n;$a++) {
			$b=$a+1;
			if($studentlist[$a]->jenis_kelamin==1) {
				$jns="Pria";
			}
			else if($studentlist[$a]->jenis_kelamin==2) {
				$jns="Wanita";
			}
			$lahir="";	
			if($studentlist[$a]->tempat_lahir && $studentlist[$a]->tgl_lahir) {
				$lahir = $studentlist[$a]->tempat_lahir.", ".date("d F Y",strtotime($studentlist[$a]->tgl_lahir));
			}	
			$html.='	<tr>
							<td style="width:25px;">'.$b.'</td>
							<td style="width:60px">'.$studentlist[$a]->nim.'</td>
							<td style="width:75px;">'.$studentlist[$a]->nama_lengkap.'</td>
							<td style="width:95px;">'.$lahir.'</td>
							<td style="width:38px;">'.$jns.'</td>
							<td style="width:60px;">'.$studentlist[$a]->jurusan.'</td>
							<td style="width:60px;">'.$studentlist[$a]->tahun_akademik.'</td>
							<td style="width:80px;">'.$studentlist[$a]->nama_ortu.'</td>
							<td style="width:130px;">'.$studentlist[$a]->alamat_ortu.'</td>
							
							
							
						</tr>';
		}
		$html.="	
					</tbody>
			   </table>";	
		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');
		//line ini penting
		$this->response->setContentType('application/pdf');
		//Close and output PDF document
		$pdf->Output('laporan_mahasiswa.pdf', 'D');
	}


	public function get_students()
	{
		$ExportModel = new \App\Models\ExportModel();
		$CollegeStudentModel = new \App\Models\CollegeStudentModel();

		helper('url');
		$uri = service('uri');
		$dat = $this->request->getPost();
		$studentlist = $ExportModel->get_student_xls($dat);
		if ($this->request->getPost('exportbtn')) {
			
			
			// Create new Spreadsheet object
			$spreadsheet = new Spreadsheet();

			$spreadsheet->setActiveSheetIndex(0);
		
			$spreadsheet->getActiveSheet()->mergeCells("A1:O1")->setTitle('Laporan Mahasiswa '.date('d-m-Y H'));
			
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$spreadsheet->setActiveSheetIndex(0);

			//Get Data 
			if($studentlist) {
				$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Mahasiswa');
				$spreadsheet->setActiveSheetIndex(0)
								->getStyle('A4:O4')
								->getBorders()
								->getAllBorders()
								->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
				//Attribut
				$spreadsheet->setActiveSheetIndex(0)->setCellValue('A4', 'No');
				$spreadsheet->setActiveSheetIndex(0)->setCellValue('B4', 'NIM Mahasiswa');
				$spreadsheet->setActiveSheetIndex(0)->setCellValue('C4', 'Nama Mahasiswa');
				$spreadsheet->setActiveSheetIndex(0)->setCellValue('D4', 'Tempat/Tanggal Lahir');
				$spreadsheet->setActiveSheetIndex(0)->setCellValue('E4', 'Jenis Kelamin');
				$spreadsheet->setActiveSheetIndex(0)->setCellValue('F4', 'Jurusan');
				$spreadsheet->setActiveSheetIndex(0)->setCellValue('G4', 'Tahun Ajaran');
				$spreadsheet->setActiveSheetIndex(0)->setCellValue('H4', 'Nama Ayah');
				$spreadsheet->setActiveSheetIndex(0)->setCellValue('I4', 'Alamat');
			 	
			 	$spreadsheet->setActiveSheetIndex(0)
								->getStyle('A4:P4')
								->getFont()->setBold(true);
				
				foreach (range('A','P') as $col) {
					$spreadsheet->setActiveSheetIndex(0)->getColumnDimension($col)->setAutoSize(true);
				}		
								

				//Get Data
				$y=4;$no=0;
				foreach($studentlist as $student) {
					$y++;
					$no++;
					$spreadsheet->setActiveSheetIndex(0)
								->getStyle('A'.$y.':P'.$y)
								->getBorders()
								->getAllBorders()
								->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);	

								
					if($student->jenis_kelamin==1) {
						$jns="Pria";
					}
					else if($student->jenis_kelamin==2) {
						$jns="Wanita";
					}
					$lahir="";	
					if($student->tempat_lahir && $student->tgl_lahir) {
						$lahir = $student->tempat_lahir.", ".date("d F Y",strtotime($student->tgl_lahir));
					}	

					$spreadsheet->setActiveSheetIndex(0)->setCellValue('A'.$y, $no);
					$spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$y, $student->nim);
					$spreadsheet->setActiveSheetIndex(0)->setCellValue('C'.$y,$student->nama_lengkap);
					$spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$y, $lahir);
					$spreadsheet->setActiveSheetIndex(0)->setCellValue('E'.$y, $jns);
					$spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$y, $student->jurusan);
					$spreadsheet->setActiveSheetIndex(0)->setCellValue('G'.$y, $student->tahun_akademik);	
					$spreadsheet->setActiveSheetIndex(0)->setCellValue('H'.$y, $student->nama_ortu);
					$spreadsheet->setActiveSheetIndex(0)->setCellValue('I'.$y, $student->alamat_ortu);
					
					
				}
				//Redirect output to a client’s web browser (Xlsx)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="Laporan_mahasiswa.xlsx"');
				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
				$writer->save('php://output');
				exit;
			}
				 
		
		}

		if ($this->request->getPost('exportbtn2')) {
			$this->students_printpdf($studentlist);
		}

		$jurusanlist = $CollegeStudentModel->get_jurusan_select();
		$tahunlist = $CollegeStudentModel->get_tahun_select();

		$data = [
			"site_name" => $this->settings["SITENAME"],
			"footer" => $this->settings["FOOTER"],
			"uname" => $this->viewdata["uname"],
			"group_id" => $this->viewdata["group_id"],
			"studentlist" => $studentlist,
			"page" => "get_students_export_xls",
			"jurusanlist" => $jurusanlist,
			"tahunlist" => $tahunlist,	
			"nim" => (!isset($dat["nim"]))?"":$dat["nim"],
			"nama" => (!isset($dat["nama"]))?"":$dat["nama"],
			"jurusan_id" => (!isset($dat["jurusan"]))?"":$dat["jurusan"],
			"tahun_ajaran" => (!isset($dat["tahun_akademik"]))?"":$dat["tahun_akademik"] ,
		];	
		
		return view('exports/get_students',$data);
	}

	//--------------------------------------------------------------------

}
