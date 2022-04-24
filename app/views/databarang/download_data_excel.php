<?php 



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nama Barang');
$sheet->setCellValue('C1', 'Kode');
$sheet->setCellValue('D1', 'Grosir');
$sheet->setCellValue('E1', 'Eceran');
$sheet->setCellValue('F1', 'satuan');
$no = 2;
$nourut = 1;
foreach ($data['dtb'] as $databarang) {
  $sheet->setCellValue('A'.$no, $nourut++);
  $sheet->setCellValue('B'.$no, $databarang['nama_barang']);
  $sheet->setCellValue('C'.$no, $databarang['kode']);
  $sheet->setCellValue('D'.$no, $databarang['harga_grosir']);
  $sheet->setCellValue('E'.$no, $databarang['harga_eceran']);
  $sheet->setCellValue('F'.$no, $databarang['satuan']);
  $no++;
}

$writer = new Xlsx($spreadsheet);
$writer->save('Data-Barang-Terbaru.xlsx');

header('Location: '. BASEURL .'/databarang');
?> 