<?php 
  Flasher::flashNoItem();
?>
    <div id="progressbar"></div>
    <div id="scrollpath"></div>
<?php 
  $no = $data['awalData'] + 1;
?>
    <div class="sidebar">
        <h1>Menu</h1>
        <a class="pilih-menu" href="<?= BASEURL; ?>/kelolatoko">
            <i class="fab fa-dashcube"></i>
                Dashboard
        </a>
        <a class="pilih-menu active" href="<?= BASEURL;?>/databarang">
            <i class="fas fa-database fa-10x"></i>
                Data Barang
        </a>
        <a class="pilih-menu" href="<?= BASEURL;?>/kategori">
        <i class="fas fa-box-open"></i>
                Kategori
        </a>
        <a class="pilih-menu" href="<?= BASEURL;?>/penjualan">
            <i class="fas fa-comment-dollar"></i>
                Penjualan   
        </a>
        <a class="pilih-menu" href="<?= BASEURL; ?>/grafik">
            <i class="fas fa-chart-line"></i>
                Grafik Penjualan
        </a>
        <a class="pilih-menu" href="<?= BASEURL; ?>/transaksi">
            <i class="fas fa-handshake"></i>
                Transaksi
        </a>
        <?php $lowStock = 1; ?>
        <?php foreach($data['sale'] as $lowProduct) : ?>
            <?php $lowStock++;  ?>
        <?php endforeach ; ?>
        <?php if(empty($data['sale'])) : ?>
            <a class="pilih-menu" href="<?= BASEURL; ?>/stock">
                <i class="fas fa-cubes"></i>
                    Stock < 5
            </a>
        <?php else : ?>
            <a class="pilih-menu" href="<?= BASEURL; ?>/stock">
                <i class="fas fa-cubes"></i>
                Stock < 5
                <i class="fas fa-ghost"></i>   
                <span><?= $lowStock - 1; ?></span>
            </a>
        <?php endif ; ?>
        <a class="pilih-menu" href="<?= BASEURL; ?>/kasir">
            <i class="fas fa-sign-out-alt"></i>
                Kembali
        </a>
    </div>

    <div class="container-data-barang">
      <div class="download-data">
          <a href="<?= BASEURL; ?>/databarang/download_data" target="_blank">
            Download Data PDF
            <i class="fas fa-download"></i>
          </a>
          <a href="<?= BASEURL; ?>/databarang/download_data_excel">
            Download Data EXCEL
            <i class="fas fa-download"></i>
          </a>
        </div>
        <div class="cari-data-barang">
          <form action="<?= BASEURL; ?>/databarang/cari" method="post">
            <div class="search-box">
              <select name="tipe">
                    <option value="nama_barang">Nama</option>
                    <option value="kode">Kode</option>
                    <option value="kategori">Kategori</option>
                </select>
                <input name="keyword" type="text" class="search-txt" placeholder="Cari Barang" autocomplete="off">
                <button type="submit"><i class="fas fa-search search-btn"></i></button>
            </div>
          </form>



            <?php 
              Flasher::flash();
            ?>

            <button type="button" data-toggle="modal" data-target="#formModal" class="tombolTambahData">
                Tambah Data Barang
            </button>
        </div>
            <table border="1">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kode</th>
                    <th>Harga Grosir</th>
                    <th>Harga Eceran</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Stock</th>
                    <th>Aksi</th>
                </tr>
                <?php foreach ($data['dtb'] as $databarang ): ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $databarang['nama_barang']; ?></td>
                    <td><?= $databarang['kode']; ?></td>
                    <td>Rp <?= number_format($databarang['harga_grosir']); ?></td>
                    <td>Rp <?= number_format($databarang['harga_eceran']); ?></td>
                    <td><?= $databarang['satuan']; ?></td>
                    <td><?= $databarang['kategori']; ?></td>
                    <td><?= $databarang['stock']; ?></td>
                    <td>
                      <div class="aksi">
                        <a href="<?= BASEURL; ?>/databarang/ubah/<?= $databarang['id_barang']; ?>" class="tampilModalUbah" data-toggle="modal" data-target="#formModal" data-id="<?= $databarang['id_barang']; ?>">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= BASEURL; ?>/databarang/hapus/<?= $databarang['id_barang']; ?>" onclick="return confirm('Yakin Produk <?= $databarang['nama_barang'] ?> Ingin Dihapus..?');">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                      </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                
            </table>    
            <div class="link-nomer">
              <?php if($data['halamanAktif'] > 1) : ?>
                  <a href="<?= BASEURL; ?>/databarang" class="prev">&laquo;&nbsp;</a>
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



    <!-- ----------Modal---------- -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Tambah Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL; ?>/databarang/tambah" method="post">
          <input hidden class="forid" type="text" readonly name="id_barang" id="id_barang">
          <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required autocomplete="off">
          </div>
          <div class="form-group">
            <label for="kode">Barcode</label>
            <input type="text" class="form-control" id="kode" name="kode" >
          </div>
          <div class="form-group">
            <label for="harga_grosir">Harga Grosir</label>
            <input type="number" class="form-control" id="harga_grosir" name="harga_grosir">
          </div>
          <div class="form-group">
            <label for="harga_eceran">Harga Eceran</label>
            <input type="number" class="form-control" id="harga_eceran" name="harga_eceran">
          </div>
          <div class="form-group">
            <label for="satuan">Satuan</label>
            <select class="form-control" name="satuan" id="satuan">
              <option value="BIJIAN">BIJIAN</option>
              <option value="RENTENGAN">RENTENGAN</option>
              <option value="LUSINAN">LUSINAN</option>
              <option value="KERDUSAN">KERDUSAN</option>
              <option value="KG">KG</option>
            </select>
          </div>
          <div class="form-group">
            <label for="kategori">Kategori</label>
            <select class="form-control" name="kategori" id="kategori">
              <?php foreach ($data['ktg'] as $ktg): ?>
                <option value="<?= $ktg['kategori']; ?>"><?= $ktg['kategori']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-add">Tambah Data</button>
        </form>
      </div>
    </div>
  </div>
</div>




    </div>

