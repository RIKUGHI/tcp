    <header>
        <!-- <img class="logo" src="../../../public/img/Text Logo.png" alt=""> -->
        <h3 class="logo">TOKO CAHAYA PERTAMA</h3>
        <nav>
            <ul class="nav_links">
                <li><a class="active" href="<?= BASEURL; ?>">Produk</a></li>
                <li><a href="<?= BASEURL; ?>/kasir">Kasir</a></li>
                <li><a href="<?= BASEURL; ?>/kelolatoko">Kelola Toko</a></li>
            </ul>
        </nav>
        <form action="<?= BASEURL; ?>/produk/cari" method="post">
            <div class="search-box">
                <select name="tipe">
                    <option value="nama_barang">Nama</option>
                    <option value="kode">Kode</option>
                    <option value="kategori">Kategori</option>
                </select>
                <input id="keywordProduk" name="keyword" type="text" class="search-txt" placeholder="Cari Barang" autocomplete="off">
                <button type="submit"><i class="fas fa-search search-btn big-i"></i></button>
            </div>
        </form>
    </header>
<!-- -------------------------------------------------------------------------------------------- -->
<?php 
    $no = $data['awalData'] + 1;
?>
    <div class="container-index">
            <table border="1">
                <tr class="ob">
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kode</th>
                    <th>Harga Grosir</th>
                    <th>Harga Eceran</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Stock</th>
                </tr>
                <tbody id="tbody">
                  <?php if(empty($data['produk'])) : ?>
                    <tr style="border-bottom: 1px solid rgb(27, 31, 32);">
                      <td colspan="8" class="no-item">
                        <i class="far fa-question-circle"></i>
                      </td>
                    </tr>
                    <tr style="border-bottom: 1px solid rgb(27, 31, 32);">
                      <td colspan="8" class="no-item-label">
                        tidak ada barang
                      </td>
                    </tr>
                    <tr>
                      <td colspan="8" class="no-item-label-back">
                        <a href="<?= BASEURL; ?>">kembali</a>
                      </td>
                    </tr>
                  <?php else : ?>
                  
                    <?php foreach ($data['produk'] as $produk ): ?> 
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $produk['nama_barang']; ?></td>
                        <td><?= $produk['kode']; ?></td>
                        <td>Rp <?= number_format($produk['harga_grosir']); ?></td>
                        <td>Rp <?= number_format($produk['harga_eceran']); ?></td>
                        <td><?= $produk['satuan']; ?></td>
                        <td><?= $produk['kategori']; ?></td>
                        <td><?= $produk['stock']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                
        </table>
        <div class="link-nomer">
            <?php if($data['halamanAktif'] > 1) : ?>
                <a href="<?= BASEURL; ?>/<?= $data['url']; ?>/<?= $data['halamanAktif'] - 1; ?>" class="prev">&laquo;</a>
            <?php endif ; ?>
            <?php for ($i=1; $i <= $data['jumlahHalaman']; $i++) :?> 
                <?php if( $i == $data['halamanAktif'] ) : ?>
                    <a href="<?=  BASEURL; ?>/<?= $data['url']; ?>/<?= $i; ?>" class="dasar spe"><?= $i; ?></a>
                <?php else : ?>
                    <a href="<?=  BASEURL; ?>/<?= $data['url']; ?>/<?= $i; ?>" class="dasar"><?= $i; ?></a>
                <?php endif ; ?>
            <?php endfor; ?>
            <?php if($data['halamanAktif'] < $data['jumlahHalaman']) : ?>
                <a href="<?= BASEURL; ?>/<?= $data['url']; ?>/<?= $data['halamanAktif'] + 1; ?>" class="next">&raquo;</a>
            <?php endif ; ?>
        </div>
    </div>
    <?php endif; ?>
<script>
  const keywordP = document.getElementById('keywordProduk');
  keywordP.addEventListener('keyup', async function() {
    let keyP = keywordP.value;
    let result = await liveSearchProduct(keyP);
    showLiveSearch(result);
  });

  function liveSearchProduct(key) {
    return fetch('<?= BASEURL; ?>/produk/liveCari/' + key)
    .then(p => p.json())
    .then(p => p);
  }

  function showLiveSearch(r) {
    const tbody = document.getElementById('tbody');
    tbody.innerHTML = isiProduk(r) ? isiProduk(r) : noProduk();
  }

  function isiProduk(r) { 
    return r.map((r, i) => {
            return `<tr>
                  <td>${i + 1}</td>
                  <td>${r.nama_barang}</td>
                  <td>${r.kode}</td>
                  <td>${r.harga_grosir ?'Rp ' + formatRupiah(r.harga_grosir) : 0}</td>
                  <td>${r.harga_eceran ?'Rp ' + formatRupiah(r.harga_eceran) : 0}</td>
                  <td>${r.satuan}</td>
                  <td>${r.kategori ? r.kategori : 'TIDAK ADA'}</td>
                  <td>${r.stock}</td>
                </tr>`;
          }).join('');
  }

  function noProduk() {
    return `<tr style="border-bottom: 1px solid rgb(27, 31, 32);">
              <td colspan="8" class="no-item">
                <i class="far fa-question-circle"></i>
              </td>
            </tr>
            <tr style="border-bottom: 1px solid rgb(27, 31, 32);">
              <td colspan="8" class="no-item-label">
                tidak ada barang
              </td>
            </tr>
            <tr>
              <td colspan="8" class="no-item-label-back">
                <a href="<?= BASEURL; ?>">kembali</a>
              </td>
            </tr>`;
  }

</script>