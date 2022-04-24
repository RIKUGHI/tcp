<?php 

class Penjualan extends Controller{
    public function index()
    {
        $data['judul'] = 'Data Penjualan';
        $data['salelow'] = $this->model('Databarang_model')->getAllDataBarangLowStock();

        if ($_GET['url'] == 'penjualan') {
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
        $data['sale'] = $this->model('Transaksi_model')->getAllDataDetailTransaksi($awalData, $jumlahDataPerHalaman);
        $data['jumlahHalaman'] = $this->model('Transaksi_model')->getJumlahHalaman($jumlahDataPerHalaman);
        $this->view('templates/header', $data);
        $this->view('penjualan/index', $data);
        $this->view('templates/footer');
    }




    
}