<?php 
  Flasher::flashNoItem();
?>
  <header>
      <!-- <img class="logo" src="../../../public/img/Text Logo.png" alt=""> -->
      <h3 class="logo">TOKO CAHAYA PERTAMA</h3>
      <nav>
      <ul class="nav_links">
                <li><a href="<?= BASEURL; ?>">Produk</a></li>
                <li><a class="active" href="<?= BASEURL; ?>/kasir">Kasir</a></li>
                <li><a href="<?= BASEURL; ?>/kelolatoko">Kelola Toko</a></li>
            </ul>
      </nav>
      <ul class="time"> 
        <li id="jam">0</li>
        <li id="menit">0</li>
        <li id="detik">0</li>
      </ul>
  </header>
  <div class="container-kasir">
    <div class="sa">
      <div class="q">
        <form action="<?= BASEURL; ?>/kasir/cari" method="post">
          <div class="search-box">
            <select name="tipe">
                <option value="nama_barang">Nama</option>
                <option value="kode">Kode</option>
            </select>
            <input id="keywordKasir" name="keyword" type="text" class="search-txt" placeholder="Cari Barang" autocomplete="off">
            <button type="submit" class="kasir"><i class="fas fa-search search-btn"></i></button>
          </div>
        </form>
        <form action="<?= BASEURL; ?>/kasir/scanbarcode" method="post" class="scan-barcode">
            <select name="satuan">
                <option value="BIJIAN">BIJI</option>
                <option value="RENTENGAN">RTG</option>
                <option value="KERDUSAN">KRD</option>
            </select>
          <input type="number" name="scanbarcode" placeholder="Scan Barcode" autocomplete="off" autofocus>
        </form>
        <a href="<?= BASEURL; ?>/kasir">Refresh</a>
      </div>
      <div class="w">
        <div class="tbl-header">
          <table border="1">
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Kode</th>
              <th>Harga Grosir</th>
              <th>Harga Eceran</th>
              <th>Satuan</th>
              <th>Add</th>
            </tr>
          </table>
        </div>
        <?php $no = $data['awalData'] + 1; ?>
        <div class="tbl-content">
          <table> 
            <?php if(empty($data['produksir'])): ?>
              <tr style="border-bottom: 1px solid rgb(27, 31, 32);">
                <td colspan="7" class="no-item-kasir">
                  <i class="far fa-question-circle"></i>
                </td>
              </tr>
              <tr style="border-bottom: 1px solid rgb(27, 31, 32);">
                <td colspan="7" class="no-item-label">
                  tidak ada barang
                </td>
              </tr>
              <tr>
                <td colspan="7" class="no-item-label-back">
                  <a href="<?= BASEURL; ?>/kasir">kembali</a>
                </td>
              </tr>
            </table>
            <?php else: ?>
            <table id="tbl-content-kasir" border="1">
              <?php foreach ($data['produksir'] as $produk ): ?> 
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $produk['nama_barang']; ?></td>
                <td><?= $produk['kode']; ?></td>
                <td>Rp <?= number_format($produk['harga_grosir']); ?></td>
                <td>Rp <?= number_format($produk['harga_eceran']); ?></td>
                <td><?= $produk['satuan']; ?></td>
                <td>
                  <a href="#" data-toggle="modal" data-target="#addToCart">
                    <i class="fas fa-cart-plus addtocart" data-id="<?= $produk['id_barang'] ?>"></i>
                  </a>
                </td>
              </tr>
              <?php endforeach; ?>
            </table>
            <div class="link-nomer">
            <?php if($data['halamanAktif'] > 1) : ?>
                <a href="<?= BASEURL; ?>/kasir" class="prev">&laquo;&nbsp;</a>
                <a href="<?= BASEURL; ?>/<?= $data['url']; ?>/<?= $data['halamanAktif'] - 1; ?>" class="prev">&lsaquo;&nbsp;</a>
            <?php endif ; ?>

            <?php if($data['jumlahHalaman'] > 5) : ?>
                <?php if($data['halamanAktif'] >= 3 && $data['halamanAktif'] < $data['jumlahHalaman'] - 2) : ?>
                    <?php for ($i = $data['halamanAktif'] - 2; $i <= $data['halamanAktif'] + 2; $i++) :?> 
                        <?php if( $i == $data['halamanAktif'] ) : ?>
                            <a href="<?=  BASEURL; ?>/<?= $data['url']; ?>/<?= $i; ?>" class="dasar spe"><?= $i; ?></a>
                        <?php else : ?>
                            <a href="<?=  BASEURL; ?>/<?= $data['url']; ?>/<?= $i; ?>" class="dasar"><?= $i; ?></a>
                        <?php endif ; ?>
                    <?php endfor; ?>
                <?php elseif($data['halamanAktif'] >= $data['jumlahHalaman'] - 2) : ?>
                    <?php for ($i = $data['jumlahHalaman'] - 4; $i <= $data['jumlahHalaman']; $i++) :?> 
                        <?php if( $i == $data['halamanAktif'] ) : ?>
                            <a href="<?=  BASEURL; ?>/<?= $data['url']; ?>/<?= $i; ?>" class="dasar spe"><?= $i; ?></a>
                        <?php else : ?>
                            <a href="<?=  BASEURL; ?>/<?= $data['url']; ?>/<?= $i; ?>" class="dasar"><?= $i; ?></a>
                        <?php endif ; ?>
                    <?php endfor; ?>
                <?php else : ?>
                    <?php for ($i = 1   ; $i <= 5; $i++) :?> 
                        <?php if( $i == $data['halamanAktif'] ) : ?>
                            <a href="<?=  BASEURL; ?>/<?= $data['url']; ?>/<?= $i; ?>" class="dasar spe"><?= $i; ?></a>
                        <?php else : ?>
                            <a href="<?=  BASEURL; ?>/<?= $data['url']; ?>/<?= $i; ?>" class="dasar"><?= $i; ?></a>
                        <?php endif ; ?>
                    <?php endfor; ?>
                <?php endif ; ?>
            <?php else : ?>
                <?php for ($i=1; $i <= $data['jumlahHalaman']; $i++) :?> 
                    <?php if( $i == $data['halamanAktif'] ) : ?>
                        <a href="<?=  BASEURL; ?>/<?= $data['url']; ?>/<?= $i; ?>" class="dasar spe"><?= $i; ?></a>
                    <?php else : ?>
                        <a href="<?=  BASEURL; ?>/<?= $data['url']; ?>/<?= $i; ?>" class="dasar"><?= $i; ?></a>
                    <?php endif ; ?>
                <?php endfor; ?>
            <?php endif ; ?>

            <?php if($data['halamanAktif'] < $data['jumlahHalaman']) : ?>
                <a href="<?= BASEURL; ?>/<?= $data['url']; ?>/<?= $data['halamanAktif'] + 1; ?>" class="next">&nbsp;&rsaquo;</a>
                <a href="<?= BASEURL; ?>/<?= $data['url']; ?>/<?= $data['jumlahHalaman']; ?>" class="next">&nbsp;&raquo;</a>
            <?php endif ; ?>
          </div>
            <?php endif; ?>
            
        </div>
      </div>
    </div>
    <?php 
    $today = date("Ymd");
    $tanggal = date("Y-m-d");
    ?>
    <div class="keranjang-belanja">
      <div class="label">
        <h3>Keranjang Penjualan</h3>
          <form action="<?= BASEURL; ?>/transaksi/simpanTransaksi" method="post">
        <h3 style="margin-right:15px;"><?= $data['invoice']; ?></h3>
        <input name="invoice" hidden type="text" value="<?= $data['invoice'] ?>">
      </div>
      <div class="wow">
        <div class="tbl-header">
          <table border="1">
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th>Sub Total</th>
              <th>Aksi</th>
            </tr>
          </table>
        </div>
        <?php $noker = 1;
              $total = 0;
              $jumlah = 0;  ?>
        <div class="tbl-content">
              <?php if(empty($data['produkker'])) : ?>
                <table border="1"> 
                  <tr style="border-bottom: 1px solid #24252A;background:#24252A;">
                    <td colspan="7" class="no-item-kasir">
                      <i class="fas fa-cart-arrow-down" style="color:#00ffa9;"></i>
                    </td>
                  </tr>
                  <tr style="border-bottom: 1px solid #24252A;">
                    <td colspan="7" class="no-item-label" style="background:#24252A;color:#00ffa9;">
                      tidak ada barang
                    </td>
                  </tr>

                </table>
              <?php else : ?>
              <table border="1">
                <?php foreach ($data['produkker'] as $items ): ?> 
                  <?php $subharga = $items['harga'] * $items['jumlah'];
                        $jumlah += $items['jumlah'];
                        $total += $subharga; ?>
                  <tr>
                    <td><?= $noker++; ?></td>
                    <input hidden name="id_barang[]" type="text" value="<?= $items['id_barang']; ?>">
                    <input hidden name="kode[]" type="text" value="<?= $items['kode']; ?>">
                    <input hidden name="satuan[]" type="text" value="<?= $items['satuan']; ?>">
                    <td><?= $items['nama_barang']; ?></td>
                        <input hidden name="nama_barang[]" type="text" value="<?= $items['nama_barang']; ?>">
                    <td>Rp <?= number_format($items['harga']); ?></td>
                        <input hidden name="harga[]" type="text" value="<?= $items['harga']; ?>">
                    <td><?= $items['jumlah']; ?></td>
                        <input hidden name="jumlah[]" type="text" value="<?= $items['jumlah']; ?>">
                    <td>Rp <?= number_format($subharga); ?></td>
                        <input hidden name="subtotal[]" type="text" value="<?= $subharga; ?>">
                    <td>
                      <a href="<?= BASEURL; ?>/kasir/hapusKeranjang/<?= $items['id_barang']; ?>">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?> 
              </table>
              <?php endif ; ?>
          </div>
              <div class="total-bayar">
                <h3>Total Bayar</h3>
                <a href="#" data-toggle="modal" data-target="#formModalTransaksi"><h4>Edit Transaksi</h4></a>
                <h3><?= $jumlah; ?></h3>
                <input hidden name="tanggal" type="date" value="<?= $tanggal; ?>">
                <input hidden name="jumlah_beli" type="number" value="<?= $jumlah; ?>">
                <h3>Rp <?= number_format($total,0,',','.'); ?></h3>
                <input id="total" name="total" hidden style="color:black;" type="text" readonly value="<?= $total; ?>">
              </div>
          <div class="pembayaran">   
                <div class="bayar">
                  <h3>Bayar</h3>
                  <input id="bayar" required type="text" placeholder="Masukan Uang Bayar Disini.." autocomplete="off">
                  <input id="bayarR" hidden required name="bayar" type="text" placeholder="Real.." autocomplete="off" readonly>
                </div>
                <div class="kembalian">
                  <h3>Kembali</h3>
                  <input id="kembali"style="color:black;width:150px;" type="text" readonly value="Rp. <?= $total ? '-'.number_format($total,0,',','.') : 0; ?>">
                  <input id="kembaliR" hidden name="kembali" style="color:black;" type="text" readonly value="<?= $total; ?>">
                </div>
                <div class="simpan-transaksi">
                  <button id="smp" type="submit">Simpan Transaksi</button>
                </div>
            </form>
          </div>
    </div>
  </div>
<script>
//   $("#bayar").keyup(function () {
//     var total = parseInt($("#total").val());
//     var bayar = parseInt($("#bayar").val());
//     var kembali = bayar - total;

//     $("#kembali").attr("value", 'Rp '+ kembali);
//     $("#kembali1").attr("value", kembali);

    
// });
let pay = document.getElementById('bayar');

$("#smp").on('click', function() {
  if (pay.value == '') {
    window.alert('Masukan Uang Terlebih Dahulu');
  }else if(pay.value != ''){
    window.alert("Data Transaksi Berhasil Disimpan");
  }
});


</script>


<!------- Modal Add To Cart ------->
<div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="formModalAddToCart" aria-hidden="true">
  <div style="width:60%;margin:35px auto;" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabelAddToCart">Tambah Ke Keranjang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body" id="keranjang">
        
      </div>
    </div>
  </div>
</div>











<!-- ----------Modal Keranjang---------- -->
<div class="modal fade" id="formModalTransaksi" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div style="width:60%;margin:35px auto;" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabelKeranjang">Edit Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <?php 
      $tanggal = date('d-m-Y');
      ?>
      <div class="modal-body">
        <form action="<?= BASEURL; ?>/kasir/ubahKeranjang" method="post">
          <input hidden name="tanggal" readonly style="color:black;" type="text" value="<?= $tanggal; ?>">
          <table border="1" style="margin-top:10px;">
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Kode</th>
              <th>Harga</th>
              <th>satuan</th>
              <th>Jumlah</th>
              <th>Sub Total</th>
            </tr>
            <?php 
            $noedittran = 1; 
            ?>
            <?php foreach ($data['produkker'] as $items ): ?> 
              <?php $subharga = $items['harga'] * $items['jumlah'];
                  ?>
              <tr>
                <td hidden><input name="id_barang[]" style="color:black;" type="text" value="<?= $items['id_barang']; ?>"></td>
                <td><?= $noedittran++; ?></td>
                <td><input name="nama_barang[]" readonly style="text-transform:uppercase;outline:none;width:100%;background:none;width:100%;color:white;border:none;height:30px;font-size:14px;" type="text" value="<?= $items['nama_barang']; ?>"></td>
                <td><input name="kode[]" readonly style="text-transform:uppercase;outline:none;background:none;width:100%;color:white;border:none;height:30px;font-size:14px;" type="text" value="<?= $items['kode']; ?>"></td>
                <td><input readonly style="outline:none;width:100%;background:none;width:100%;color:white;border:none;height:30px;font-size:14px;" type="text" value="Rp <?= number_format($items['harga'],0,',','.'); ?>"></td>
                <td hidden><input name="harga[]" readonly style="outline:none;width:100%;background:none;width:100%;color:white;border:none;height:30px;font-size:14px;" type="number" value="<?= $items['harga']; ?>"></td>
                <td><input name="satuan[]" readonly style="text-transform:uppercase;outline:none;width:100%;background:none;width:100%;color:white;border:none;height:30px;font-size:14px;" type="text" value="<?= $items['satuan']; ?>"></td>
                <td><input name="jumlah[]" style="width:100%;color:black;border:none;height:30px;font-size:14px;" type="number" value="<?= $items['jumlah']; ?>"></td>
                <td><input name="subharga[]" readonly style="outline:none;background:none;width:100%;color:white;border:none;height:30px;font-size:14px;" type="number" value="<?= $subharga; ?>"></td>
                
              </tr>
              <?php endforeach; ?> 
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-add">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>