
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
        <a class="pilih-menu active" href="<?= BASEURL;?>/penjualan">
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
        <?php foreach($data['salelow'] as $lowProduct) : ?>
            <?php $lowStock++;  ?>
        <?php endforeach ; ?>
        <?php if(empty($data['salelow'])) : ?>
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

    <div class="container-data-penjualan">
        <table border="0">
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Nama Barang</th>
                <th>Kode</th>
                <th>Harga</th>
                <th>Satuan</th>
                <th>Jumlah</th>
                <th>SubTotal</th>
            </tr>
            <?php $no = $data['awalData'] + 1; ?>
            <?php foreach ($data['sale'] as $sale ): ?> 
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $sale['id_transaksi']; ?></td>
                <td><?= $sale['nama_barang']; ?></td>
                <td><?= $sale['kode']; ?></td>
                <td>Rp. <?= number_format($sale['harga']); ?></td>
                <td><?= $sale['satuan']; ?></td>
                <td><?= $sale['jumlah']; ?></td>
                <td>Rp. <?= number_format($sale['subtotal']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <div class="links-nomer">
            <?php if($data['halamanAktif'] > 1) : ?>
                <a href="<?= BASEURL; ?>/penjualan" class="prev">&laquo;&nbsp;</a>
                <a href="<?= BASEURL; ?>/penjualan/index/<?= $data['halamanAktif'] - 1; ?>" class="prev">&lsaquo;&nbsp;</a>
            <?php endif ; ?>

            <?php if($data['jumlahHalaman'] > 5) : ?>
                <?php if($data['halamanAktif'] >= 3 && $data['halamanAktif'] < $data['jumlahHalaman'] - 2) : ?>
                    <?php for ($i = $data['halamanAktif'] - 2; $i <= $data['halamanAktif'] + 2; $i++) :?> 
                        <?php if( $i == $data['halamanAktif'] ) : ?>
                            <a href="<?=  BASEURL; ?>/penjualan/index/<?= $i; ?>" class="dasar spe"><?= $i; ?></a>
                        <?php else : ?>
                            <a href="<?=  BASEURL; ?>/penjualan/index/<?= $i; ?>" class="dasar"><?= $i; ?></a>
                        <?php endif ; ?>
                    <?php endfor; ?>
                <?php elseif($data['halamanAktif'] >= $data['jumlahHalaman'] - 2) : ?>
                    <?php for ($i = $data['jumlahHalaman'] - 4; $i <= $data['jumlahHalaman']; $i++) :?> 
                        <?php if( $i == $data['halamanAktif'] ) : ?>
                            <a href="<?=  BASEURL; ?>/penjualan/index/<?= $i; ?>" class="dasar spe"><?= $i; ?></a>
                        <?php else : ?>
                            <a href="<?=  BASEURL; ?>/penjualan/index/<?= $i; ?>" class="dasar"><?= $i; ?></a>
                        <?php endif ; ?>
                    <?php endfor; ?>
                <?php else : ?>
                    <?php for ($i = 1   ; $i <= 5; $i++) :?> 
                        <?php if( $i == $data['halamanAktif'] ) : ?>
                            <a href="<?=  BASEURL; ?>/penjualan/index/<?= $i; ?>" class="dasar spe"><?= $i; ?></a>
                        <?php else : ?>
                            <a href="<?=  BASEURL; ?>/penjualan/index/<?= $i; ?>" class="dasar"><?= $i; ?></a>
                        <?php endif ; ?>
                    <?php endfor; ?>
                <?php endif ; ?>
            <?php else : ?>
                <?php for ($i=1; $i <= $data['jumlahHalaman']; $i++) :?> 
                    <?php if( $i == $data['halamanAktif'] ) : ?>
                        <a href="<?=  BASEURL; ?>/penjualan/index/<?= $i; ?>" class="dasar spe"><?= $i; ?></a>
                    <?php else : ?>
                        <a href="<?=  BASEURL; ?>/penjualan/index/<?= $i; ?>" class="dasar"><?= $i; ?></a>
                    <?php endif ; ?>
                <?php endfor; ?>
            <?php endif ; ?>

            <?php if($data['halamanAktif'] < $data['jumlahHalaman']) : ?>
                <a href="<?= BASEURL; ?>/penjualan/index/<?= $data['halamanAktif'] + 1; ?>" class="next">&nbsp;&rsaquo;</a>
                <a href="<?= BASEURL; ?>/penjualan/index/<?= $data['jumlahHalaman']; ?>" class="next">&nbsp;&raquo;</a>
            <?php endif ; ?>
        </div>
    </div>
