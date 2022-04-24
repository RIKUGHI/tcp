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
        <a class="pilih-menu active" href="<?= BASEURL; ?>/grafik">
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

    <div class="container-grafik">
      <canvas id="myChart"></canvas>
      <div class="best-selling">
        <ul>
          <?php foreach($data['bestSelling'] as $bestSelling) : ?>
            <li>
              <label for="">
                <?= $bestSelling['nama_barang']; ?>
              </label>
              <div class="fix-bar">
                <div class="bar-progress">
                  <div class="detail-total">Total Barang : <?= $bestSelling['jumlah'] ?></div>
                  <span>
                    
                  </span>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
        <div class="links-nomer">
        <?php if($data['halamanAktif'] > 1) : ?>
                <a href="<?= BASEURL; ?>/grafik" class="prev">&laquo;&nbsp;</a>
                <a href="<?= BASEURL; ?>/grafik/index/<?= $data['halamanAktif'] - 1; ?>" class="prev">&lsaquo;&nbsp;</a>
            <?php endif ; ?>

            <?php if($data['jumlahHalaman'] > 5) : ?>
                <?php if($data['halamanAktif'] >= 3 && $data['halamanAktif'] < $data['jumlahHalaman'] - 2) : ?>
                    <?php for ($i = $data['halamanAktif'] - 2; $i <= $data['halamanAktif'] + 2; $i++) :?> 
                        <?php if( $i == $data['halamanAktif'] ) : ?>
                            <a href="<?=  BASEURL; ?>/grafik/index/<?= $i; ?>" class="dasar spe"><?= $i; ?></a>
                        <?php else : ?>
                            <a href="<?=  BASEURL; ?>/grafik/index/<?= $i; ?>" class="dasar"><?= $i; ?></a>
                        <?php endif ; ?>
                    <?php endfor; ?>
                <?php elseif($data['halamanAktif'] >= $data['jumlahHalaman'] - 2) : ?>
                    <?php for ($i = $data['jumlahHalaman'] - 4; $i <= $data['jumlahHalaman']; $i++) :?> 
                        <?php if( $i == $data['halamanAktif'] ) : ?>
                            <a href="<?=  BASEURL; ?>/grafik/index/<?= $i; ?>" class="dasar spe"><?= $i; ?></a>
                        <?php else : ?>
                            <a href="<?=  BASEURL; ?>/grafik/index/<?= $i; ?>" class="dasar"><?= $i; ?></a>
                        <?php endif ; ?>
                    <?php endfor; ?>
                <?php else : ?>
                    <?php for ($i = 1   ; $i <= 5; $i++) :?> 
                        <?php if( $i == $data['halamanAktif'] ) : ?>
                            <a href="<?=  BASEURL; ?>/grafik/index/<?= $i; ?>" class="dasar spe"><?= $i; ?></a>
                        <?php else : ?>
                            <a href="<?=  BASEURL; ?>/grafik/index/<?= $i; ?>" class="dasar"><?= $i; ?></a>
                        <?php endif ; ?>
                    <?php endfor; ?>
                <?php endif ; ?>
            <?php else : ?>
                <?php for ($i=1; $i <= $data['jumlahHalaman']; $i++) :?> 
                    <?php if( $i == $data['halamanAktif'] ) : ?>
                        <a href="<?=  BASEURL; ?>/grafik/index/<?= $i; ?>" class="dasar spe"><?= $i; ?></a>
                    <?php else : ?>
                        <a href="<?=  BASEURL; ?>/grafik/index/<?= $i; ?>" class="dasar"><?= $i; ?></a>
                    <?php endif ; ?>
                <?php endfor; ?>
            <?php endif ; ?>

            <?php if($data['halamanAktif'] < $data['jumlahHalaman']) : ?>
                <a href="<?= BASEURL; ?>/grafik/index/<?= $data['halamanAktif'] + 1; ?>" class="next">&nbsp;&rsaquo;</a>
                <a href="<?= BASEURL; ?>/grafik/index/<?= $data['jumlahHalaman']; ?>" class="next">&nbsp;&raquo;</a>
            <?php endif ; ?>
        </div>
      </div>
    </div>

    <script>
        var ctx = document.getElementById("myChart").getContext("2d");
  var data = {
            labels: [
                  <?php foreach ($data['grafik'] as $grafik ): ?> 
                    "<?= $grafik['tanggal'] ?>",
                  <?php endforeach; ?>
            ],
            datasets: [
                  {
                    label: "Barang Yang Terjual Dalam Sehari",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "#F07124",
                    borderColor: "#F07124",
                    pointHoverBackgroundColor: "#F07124",
                    pointHoverBorderColor: "#F07124",
                    data: [
                        <?php foreach ($data['grafik'] as $grafik ): ?> 
                          "<?= $grafik['jumlah_beli'] ?>",
                        <?php endforeach; ?>
                    ]
                  }
                  ]
          };

  var myBarChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
            legend: {
              display: true
            },
            barValueSpacing: 20,
            scales: {
              yAxes: [{
                  ticks: {
                      min: 0,
                  }
              }],
              xAxes: [{
                          gridLines: {
                              color: "rgba(0, 0, 0, 0)",
                          }
                      }]
              }
          }
        });

  const valueBar = document.querySelectorAll('.fix-bar .bar-progress span');
  const barProgress = document.querySelectorAll('.bar-progress');
  let allVal = [
    <?php foreach ($data['allData'] as $bestSelling ): ?> 
      parseInt("<?= $bestSelling['jumlah']; ?>"),
    <?php endforeach; ?>
  ];
  let maxData = allVal.length;
  let awalData = <?= $data['awalData']; ?>;
  let x = allVal.slice(awalData, maxData);
      let total = allVal.reduce((acc, crv) => acc + crv);
      let percent = x.map(val => {
      return (val / total) * 100;
    });

  barProgress.forEach((e, i) => {
    e.style.width = percent[i] + '%';
    if (percent[i] < 3) {
      valueBar[i].style.left = 0;
    }else{
      setTimeout(() => {
        valueBar[i].style.right = 0;
      }, 100);
    }
    let firstNo = percent[i].toString(),
        split = firstNo.split('.');
    if (split.length == 1) {
      split.push('0');
    }
    let firstE = split[0],
        secE = split[1].substr(0, 1);
        if (secE == 0) {
          secE = '';
          combine = firstE;
        }else{
          combine = firstE + ',' + secE;
        }
    valueBar[i].textContent = combine + '%';
  });








    </script>


</body>
</html>