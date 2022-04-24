    <div class="sidebar">
        <h1>Menu</h1>
        <a class="pilih-menu active" href="<?= BASEURL; ?>/kelolatoko">
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
    <?php $today = date("Y-m-d"); ?>
    <div class="container-dashboard">
        <div class="items-sold">    
            <div class="label">
                BARANG YANG TERJUAL HARI INI
            </div>
            <?php $itemstoday = 0; ?>
            <div class="number">
            <?php foreach ($data['trandetail'] as $items ): ?> 
                <?php $itemstoday += $items['jumlah'] ?>
            <?php endforeach; ?>
                <?= $itemstoday; ?>
            </div>
        </div>
        <div class="data-today">
            <table>
                <tr>
                    <th>No</th>
                    <th>Invoice</th>
                    <th>Jumlah Beli</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Kembali</th>
                </tr>
            <?php $no = 1; ?>
            <?php foreach ($data['tran'] as $transaksi ): ?> 
                <tr>
                    <td><?= $no++; ?></td>
                    <td>
                        <a style="font-size:15px;color:#03fc90;border-bottom:1px solid #03fc90;" href="<?= BASEURL; ?>/invoice/index/<?= $transaksi['id_transaksi']; ?>">
                        <?= $transaksi['id_transaksi']; ?>
                        </a>
                    </td>
                    <td><?= $transaksi['jumlah_beli']; ?></td>
                    <td>Rp <?= number_format($transaksi['total'],0,',','.'); ?></td>
                    <td>Rp <?= number_format($transaksi['bayar'],0,',','.'); ?></td>
                    <td>Rp <?= number_format($transaksi['kembali'],0,',','.'); ?></td>
                </tr>
            <?php endforeach; ?>
                
            </table>
        </div>
    </div>


