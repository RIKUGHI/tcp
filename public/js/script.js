let progress = document.getElementById('progressbar');
let totalHeight = document.body.scrollHeight - window.innerHeight;
window.onscroll = function () {
  let progressHeight = (window.pageYOffset / totalHeight) * 100;
  progress.style.height = progressHeight + "%";
};


$(function () {

  $('.tombolTambahData').on('click', function () {
    $('#formModalLabel').html('Tambah Data Barang');
    $('.modal-footer button[type=submit]').html('Tambah Data');
    $('.modal-body form').attr('action', 'http://localhost/tcp/public/databarang/tambah');
    $('#nama_barang').val('');
    $('#kode').val('');
    $('#harga_grosir').val('');
    $('#harga_eceran').val('');
    $('#satuan').val('BIJIAN');
    $('#kategori').val('SEMBAKO');
    $('#stock').val('');
    $('#id_barang').val('');
  });

  $('.tampilModalUbah').on('click', function () {

    $('#formModalLabel').html('Ubah Data Barang');
    $('.modal-footer button[type=submit]').html('Ubah Data');
    $('.modal-body form').attr('action', 'http://localhost/tcp/public/databarang/ubah');

    const id = $(this).data('id');
    $.ajax({
      url: 'http://localhost/tcp/public/databarang/getubah',
      data: {
        id_barang: id
      },
      method: 'post',
      dataType: 'json',
      success: function (data) {
        $('#nama_barang').val(data.nama_barang);
        $('#kode').val(data.kode);
        $('#harga_grosir').val(data.harga_grosir);
        $('#harga_eceran').val(data.harga_eceran);
        $('#satuan').val(data.satuan);
        $('#kategori').val(data.kategori);
        $('#stock').val(data.stock);
        $('#id_barang').val(data.id_barang);
      }
    });

  });

  // -------------------------------------------------------------------------------------------------

  $('.tombolTambahKategori').on('click', function () {
    $('#formModalKategori').html('Tambah Kategori');
    $('.modal-footer button[type=submit]').html('Tambah Kategori');
    $('.modal-body form').attr('action', 'http://localhost/tcp/public/kategori/tambah');
    $('#kategori').val('');
    $('#id_kategori').val('');
  });

  $('.tampilModalUbahKategori').on('click', function () {

    $('#formModalKategori').html('Ubah Kategori');
    $('.modal-footer button[type=submit]').html('Ubah Kategori');
    $('.modal-body form').attr('action', 'http://localhost/tcp/public/kategori/ubah');

    const id = $(this).data('id');
    $.ajax({
      url: 'http://localhost/tcp/public/kategori/getubah',
      data: {
        id_kategori: id
      },
      method: 'post',
      dataType: 'json',
      success: function (data) {
        $('#kategori').val(data.kategori);
        $('#id_kategori').val(data.id_kategori);
      }
    });

  });






  // var bayar = document.getElementById('bayar');
  // var total = $('#total').text();

  // bayar.addEventListener('keyup', function() {
  //   var bil1 = parseInt($("#bayar").val());
  //   var kembali = total - bil1;
  //   console.log(kembali);
  // });










});


document.addEventListener('click', async function (e) {
  if (e.target.classList.contains('addtocart')) {
    const idBarang = e.target.dataset.id;
    const productDetail = await getDetailBarang(idBarang);
    getBarang(productDetail);
  }
});

function getDetailBarang(idBarang) {
  return fetch('http://localhost/tcp/public/databarang/getDataUbah/' + idBarang)
    .then(response => response.json())
    .then(p => p);
}

function getBarang(Barang) {
  const detailBarang = showDetailProduct(Barang);
  const modalBody = document.getElementById('keranjang');
  modalBody.innerHTML = detailBarang;
}

function showDetailProduct(b) {
  return `<form action="http://localhost/tcp/public/kasir/keranjang" method="post">
            <input hidden style="cursor:not-allowed;" class="forid" name="id_barang" readonly value="${b.id_barang}">
            <div class="form-group">
              <label for="nama_barang">Nama Barang</label>
              <input style="cursor:not-allowed;" type="text" class="form-control" name="nama_barang" readonly value="${b.nama_barang}">
            </div>
            <div class="form-group">
              <label for="kode">kode</label>
              <input style="cursor:not-allowed;text-transform:uppercase;" type="text" class="form-control" name="kode" readonly value="${b.kode}">
            </div>
            <div class="form-group">
              <label for="satuan">satuan</label>
              <input style="cursor:not-allowed;text-transform:uppercase;" type="text" class="form-control" name="satuan" readonly value="${b.satuan}">
            </div>
            <div class="form-group">
              <label for="satuan">Satuan</label>
              <select class="form-control" id="harga" name="harga">
                <option value="${b.harga_eceran}">Harga Eceran -- Rp ${formatRupiah(b.harga_eceran)}</option>
                <option value="${b.harga_grosir}">Harga Grosir -- Rp ${b.harga_grosir ? formatRupiah(b.harga_grosir) : 0}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="jumlah">Jumlah</label>
              <input type="number" class="form-control" name="jumlah" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-add">Tambah Ke Keranjang</button>
          </form>`;
}

function formatRupiah(harga) {
  var number_string = harga.toString(),
    sisa = number_string.length % 3,
    rupiah = number_string.substr(0, sisa),
    ribuan = number_string.substr(sisa).match(/\d{3}/g);

  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }
  return rupiah;
}

const bayar = document.getElementById('bayar');
const bayarR = document.getElementById('bayarR');
const total = document.getElementById('total');
const kembalian = document.getElementById('kembali');
const kembalianR = document.getElementById('kembaliR');
bayar.addEventListener('keyup', function () {
  bayar.value = liveFormatRupiah(this.value, 'Rp. ');
  let uangB = bayar.value.split('.');
  uangB.shift();
  let uang = uangB.join('');
  uang = parseInt(uang);
  bayarR.value = uang;

  let totalB = parseInt(total.value);
  kembalianR.value = liveKembalian(uang, totalB);
  kembalian.value = showLiveKembalian(uang, totalB, 'Rp. ');

});

function showLiveKembalian(bayar, total, prefix) {
  let kembalian = bayar - total,
    number_string = kembalian.toString(),
    sisa = [...number_string];
  sisa.shift();

  if (kembalian < 0) {
    let hargaString = kembalian.toString(),
      sisaL = sisa.length % 3;
    rupiah = hargaString.substr(1, sisaL),
      ribuan = hargaString.substr(sisaL + 1).match(/\d{3}/g);

    if (ribuan) {
      separator = sisaL ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
    return prefix += '-' + rupiah;
  } else {
    let hargaString = kembalian.toString(),
      sisaL = [...number_string].length % 3,
      rupiah = hargaString.substr(0, sisaL),
      ribuan = hargaString.substr(sisaL).match(/\d{3}/g);

    if (ribuan) {
      separator = sisaL ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
    return prefix + rupiah;
  }
}

function liveKembalian(bayar, total) {
  let kembalian = bayar - total;
  return kembalian;
}

function liveFormatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split = number_string.split(','),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}


let jam = document.getElementById('jam'),
  menit = document.getElementById('menit'),
  detik = document.getElementById('detik');
setInterval(() => {
  let time = new Date();
  jam.textContent = jamN(time);
  menit.textContent = menitN(time);
  detik.textContent = detikN(time);
}, 1000);

function jamN(time) {
  let j = time.getHours().toString();
  let [...jam] = j;
  if (jam.length == 1) {
    return 0 + jam;
  } else {
    return jam.join('');
  }
}

function menitN(time) {
  let m = time.getMinutes().toString();
  let [...menit] = m;
  if (menit.length == 1) {
    return 0 + menit;
  } else {
    return menit.join('');
  }
}

function detikN(time) {
  let s = time.getSeconds().toString();
  let [...seconds] = s;
  if (seconds.length == 1) {
    return 0 + seconds;
  } else {
    return seconds.join('');
  }
}

const keyK = document.getElementById('keywordKasir');
keyK.addEventListener('keyup', async function () {
  let keyKasir = keyK.value;
  let hasil = await getProductBySearch(keyKasir);
  showLiveProduct(hasil);
});

function getProductBySearch(key) {
  return fetch('http://localhost/tcp/public/kasir/getLiveBarang/' + key)
    .then(p => p.json())
    .then(p => p);
}

function showLiveProduct(r) {
  const content = document.getElementById('tbl-content-kasir');
  content.innerHTML = showProductForKasir(r) ? showProductForKasir(r) : noProdukForKasir();
}

function showProductForKasir(r) {
  return r.map((r, i) => {
    return `<tr>
          <td>${i + 1}</td>
          <td>${r.nama_barang}</td>
          <td>${r.kode}</td>
          <td>${r.harga_grosir ?'Rp ' + formatRupiah(r.harga_grosir) : 0}</td>
          <td>${r.harga_eceran ?'Rp ' + formatRupiah(r.harga_eceran) : 0}</td>
          <td>${r.satuan}</td>
          <td>
            <a href="#" data-toggle="modal" data-target="#addToCart">
              <i class="fas fa-cart-plus addtocart" data-id="${r.id_barang}"></i>
            </a>
          </td>
        </tr>`;
  }).join('');
}

function noProdukForKasir() {
  return `<tr style="border-bottom: 1px solid rgb(27, 31, 32);">
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
              <a href="http://localhost/tcp/public/kasir">kembali</a>
            </td>
          </tr>`;
}