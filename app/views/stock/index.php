
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
            <a class="pilih-menu active" href="<?= BASEURL; ?>/stock">
                <i class="fas fa-cubes"></i>
                    Stock < 5
            </a>
        <?php else : ?>
            <a class="pilih-menu active" href="<?= BASEURL; ?>/stock">
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

    <div class="container-data-stock">
        <table border="0">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kode</th>
                <th>Kategori</th>
                <th>Stock</th>
            </tr>
            <?php $no = 1; ?>
            <?php foreach ($data['sale'] as $sale ): ?> 
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $sale['nama_barang']; ?></td>
                <td><?= $sale['kode']; ?></td>
                <td><?= $sale['satuan']; ?></td>
                <td><?= $sale['stock']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
