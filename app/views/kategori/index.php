    <div id="progressbar"></div>
    <div id="scrollpath"></div>

    <div class="sidebar">
        <h1>Menu</h1>
        <a class="pilih-menu" href="<?= BASEURL; ?>/kelolatoko">
            <i class="fab fa-dashcube"></i>
                Dashboard
        </a>
        <a class="pilih-menu" href="<?= BASEURL;?>/databarang">
            <i class="fas fa-database fa-10x"></i>
                Data Barang
        </a>
        <a class="pilih-menu active" href="<?= BASEURL;?>/kategori">
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

    <div class="container-kategori">

        <div class="tambah-kategori">

            <?php 
              Flasher::flash();
            ?>

            <button type="button" data-toggle="modal" data-target="#formKategori" class="tombolTambahKategori">
                Tambah Kategori
            </button>
        </div>
            <table border="1">
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
                <?php $no = 1; ?>
                <?php foreach ($data['ktg'] as $databarang ): ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $databarang['kategori']; ?></td>
                    <td>
                      <div class="aksi">
                        <a href="<?= BASEURL; ?>/kategori/ubah/<?= $databarang['id_kategori']; ?>" class="tampilModalUbahKategori" data-toggle="modal" data-target="#formKategori" data-id="<?= $databarang['id_kategori']; ?>">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= BASEURL; ?>/kategori/hapus/<?= $databarang['id_kategori']; ?>" onclick="return confirm('Yakin Kategori <?= $databarang['kategori'] ?> Ingin Dihapus..?');">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                      </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                
            </table>    



    <!-- ----------Modal---------- -->
<div class="modal fade" id="formKategori" tabindex="-1" role="dialog" aria-labelledby="formModalKategori" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalKategori">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL; ?>/kategori/tambah" method="post">
          <input class="forid" type="text" readonly name="id_kategori" id="id_kategori">
          <div class="form-group">
            <label for="nama_barang">Nama Kategori</label>
            <input type="text" class="form-control" name="kategori" id="kategori" required autocomplete="off">
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

