<?php 
$no = 1;
$mpdf = new \Mpdf\Mpdf();

$html = '<table border="1" cellpadding="10" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Kode</th>
              <th>Grosir</th>
              <th>Eceran</th>
              <th>satuan</th>
            </tr>
          </thead>';

foreach ($data['dtb'] as $databarang) {
  $html .= '<tbody>
              <tr>
                <td>'. $no++ .'</td>
                <td>'. $databarang['nama_barang'].'</td>
                <td>'. $databarang['kode'].'</td>
                <td>'. number_format($databarang['harga_grosir'],0,',','.').'</td>
                <td>'. number_format($databarang['harga_eceran'],0,',','.').'</td>
                <td>'. $databarang['satuan'].'</td>
              </tr>
            </tbody>';
}

$html .= '</table>';


$mpdf->WriteHTML($html);
$mpdf->Output('Data-Barang.pdf', 'D');









?>