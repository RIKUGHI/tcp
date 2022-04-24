<?php foreach ($data['invoice'] as $invoice): ?> 
<?php $noinvoice = $invoice['id_transaksi']; $no = 1;?>
<?php endforeach; ?>
<?php



$mpdf = new \Mpdf\Mpdf();

$html= '
<h2 style="margin:0;">TOKO CAHAYA PERTAMA</h2>
  <h3 style="margin:0;">Jalan gx tau</h3>
  <h3 style="margin:0 0 20px 0;">Invoice : '. $noinvoice .'</h3>
  <table cellpadding="10" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th style="border-bottom: 1px dashed black;">No</th>
        <th style="border-bottom: 1px dashed black;border-left:1px dashed black;">Nama Barang</th>
        <th style="border-bottom: 1px dashed black;border-left:1px dashed black;">Harga</th>
        <th style="border-bottom: 1px dashed black;border-left:1px dashed black;">Jumlah</th>
        <th style="border-bottom: 1px dashed black;border-left:1px dashed black;">Sub Total</th>
      </tr>
    </thead>';

    foreach ($data['invoice'] as $invoice) {
      $html .= '
      <tbody>
        <tr> 
          <td>'.$no++.'</td>
          <td style="ttext-transform:uppercase;">'.$invoice['nama_barang'].'</td>
          <td>Rp '.number_format($invoice['harga'],0,',','.').'</td>
          <td style="text-align:center;">'.$invoice['jumlah'].'</td>
          <td>Rp '.number_format($invoice['subtotal'],0,',','.').'</td>
        </tr>
      </tbody>';
      $total = $invoice['total']; $bayar = $invoice['bayar']; $kembali = $invoice['kembali'];
    }

      $html .= '
      <tfoot>
        <tr>
          <td style="border-top:1px dashed black;">TOTAL</td>
          <td style="border-top:1px dashed black;"></td>
          <td style="border-top:1px dashed black;"></td>
          <td style="border-top:1px dashed black;"></td>
          <td style="border-top:1px dashed black;">Rp '. number_format($total,0,',','.') .'</td>
        </tr>
        <tr>
          <td>UANG BAYAR</td>
          <td></td>
          <td></td>
          <td></td>
          <td>Rp '. number_format($bayar,0,',','.') .'</td>
        </tr>
        <tr>
          <td>KEMBALI</td>
          <td></td>
          <td></td>
          <td></td>
          <td>Rp '. number_format($kembali,0,',','.') .'</td>
        </tr>
      </tfoot>';

$html .= '</table>';

$mpdf->WriteHTML($html);
$mpdf->Output($noinvoice, \Mpdf\Output\Destination::INLINE);
?>
<h2>saya</h2>
