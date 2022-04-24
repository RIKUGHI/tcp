<?php 

class Transaksi extends Controller{

  public function index()
  {
      if ($_GET['url'] == 'transaksi') {
        $halamanAktif = 1;
        $jumlahDataPerHalaman = 50;
    }else{
        $no = $_GET['url'];
        $lastNo = explode('/', $no);
        $lastNoIndex = end($lastNo);
        $jumlahDataPerHalaman = 50;
        $halamanAktif = $lastNoIndex;
    }
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
    $data['halamanAktif'] = $halamanAktif;
    $data['awalData'] = $awalData;

      $data['judul'] = 'Data Penjualan';
      $data['sale'] = $this->model('Transaksi_model')->getAlldataTransaksi($awalData, $jumlahDataPerHalaman);
      $data['salelow'] = $this->model('Databarang_model')->getAllDataBarangLowStock();
      $data['jumlahHalaman'] = $this->model('Transaksi_model')->getJumlahHalamanTransaksi($jumlahDataPerHalaman);
      $this->view('templates/header', $data);
      $this->view('transaksi/index', $data);
      $this->view('templates/footer');
  }

    public function simpanTransaksi()
    {
      
      $this->model('Transaksi_model')->tambahDataTransaksi($_POST);
      
    }
  
  






}