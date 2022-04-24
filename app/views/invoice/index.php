
<style>
  .container-invoice{
    width: 80%;
    margin: 20px auto;
  }

  h2,h3{
    color: white;
  }

  table{
    width: 100%;
    margin-bottom: 20px;
  }

  tbody tr td:nth-child(4){
      text-align: center;
  }

  thead tr th:nth-child(4){
      text-align: center;
  }

  tfoot tr:nth-child(odd){
    background: rgba(43, 52, 54, 0.822);
  }

  tfoot tr:nth-child(2){
    background: rgb(27, 31, 32);
  }
  
  .container-invoice table th:nth-child(6),
  .container-invoice table td:nth-child(6){
    text-align: center;
  }
  
  .footer-note{
    display: flex;
    justify-content: space-evenly;
    align-items: center;
  }

  .footer-note a:nth-child(1){
    cursor: pointer;
    color: black;
    text-align: center;
    font-weight: bold;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 23px;
    outline: none;
    width: 30%;
    height: 40px;
    border: none;
    text-transform: uppercase;
    border-radius: 10px;
    background: linear-gradient(to right, #00ff2a, #0077ff);
    transition: 1s;
  }

  .footer-note a:nth-child(1):hover{
    border-radius: 20px;
    width: 40%;
    height: 45px;
  }

  .footer-note i{
    background: linear-gradient(to right, #0077ff, #00ff2a);
    border-radius: 30%;
    font-size: 25px;
    color: black;
    padding: 7px;
    transition: 0.8s;
  }

  .footer-note i:hover{
    border-radius: 50%;
    font-size: 30px;
    padding: 10px;
  }

  .notransaction{
    text-align: center;
    font-size: 100px;
    transition: .8s ease;
    animation: notran 1.5s ease infinite alternate forwards;
  }

  @keyframes notran {
    0%{
      transform: rotateY(0deg);
      color: #1fb8a1;
    }100%{
      transform: rotateY(180deg);
      color: #1ebda5;
    }
  }

  .notran-cap{
    background: #1b1f20;
    text-align: center;
    font-size: 30px;
    font-family: fantasy;
    font-weight: bold;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #1fb8a1;
  }

  @media print{
    body{
      background: none;
    }

    h2,h3{
      color: black;
    }

    thead tr{
    border-bottom: 1px dashed black;
    }

    thead tr th{
      background: white;
      color: black;
    }

    thead tr th:nth-child(2),
    thead tr th:nth-child(3),
    thead tr th:nth-child(4),
    thead tr th:nth-child(5){
      border-left: 1px dashed black;
    }

    thead th:nth-child(3){
      width: 15%;
    }

    thead th:nth-child(5){
      width: 15%;
    }

    tbody tr td{
      background: white;
      color: black;
    }

    tbody tr td:nth-child(4){
      text-align: center;
    }

    tfoot{
      border-top: 1px dashed black;
    }

    tfoot tr td{
      background: white;
      color: black;
    }
  
    .footer-note{
        display: none;
    }
    
}

  
}


</style>
      <?php foreach ($data['invoice'] as $invoice): ?> 
      <?php $noinvoice = $invoice['id_transaksi']; ?>
      <?php endforeach; ?>
<div class="container-invoice">
  <h2>TOKO CAHAYA PERTAMA</h2>
  <h3>Jalan gx tau</h3>
  <h3>
    Invoice : <?php if(empty($data['invoice'])) : ?>
                <?= $data['noinvoice']; ?>
              <?php else : ?>
                <?= $noinvoice; ?>
              <?php endif; ?>
  </h3>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
    <?php if(empty($data['invoice'])) : ?>
        <tr>
          <td colspan="5" class="notransaction">
            <i class="fas fa-search-dollar"></i>
          </td>
        </tr>
        <tr>
          <td colspan="5" class="notran-cap">
            tidak ada transaksi
          </td>
        </tr>
    </table>
        <div class="footer-note">
          <a href="<?= BASEURL; ?>/kasir">
              KEMBALI
          </a>
        </div>
      
    <?php else : ?>

        <?php $no = 1; ?>
          <?php foreach ($data['invoice'] as $invoice): ?> 
        <tr>
          <td><?= $no++; ?></td>
          <td style="text-transform:uppercase;"><?= $invoice['nama_barang']; ?></td>
          <td>Rp <?= number_format($invoice['harga'],0,',','.'); ?></td>
          <td><?= $invoice['jumlah']; ?></td>
          <td>Rp <?= number_format($invoice['subtotal'],0,',','.'); ?></td>
        </tr>
      </tbody>
        <?php $total = $invoice['total']; $bayar = $invoice['bayar']; $kembali = $invoice['kembali']; ?>
        <?php endforeach; ?>
      <tfoot>
        <tr>
          <td>TOTAL</td>
          <td></td>
          <td></td>
          <td></td>
          <td>Rp <?= number_format($total,0,',','.'); ?></td>
        </tr>
        <tr>
          <td>UANG BAYAR</td>
          <td></td>
          <td></td>
          <td></td>
          <td>Rp <?= number_format($bayar,0,',','.'); ?></td>
        </tr>
        <tr>
          <td>UANG KEMBALIAN</td>
          <td></td>
          <td></td>
          <td></td>
          <td>Rp <?= number_format($kembali,0,',','.'); ?></td>
        </tr>
      </tfoot>
      </table>
      <div class="footer-note">
        <a href="<?= BASEURL; ?>/kasir">
            KEMBALI
        </a>
        <a href="<?= BASEURL; ?>/printnote/<?= $noinvoice ?>" target="_blank">
          <i class="fas fa-print"></i>
        </a>
      </div>

    <?php endif; ?>
      

</div>