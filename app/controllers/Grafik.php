<?php 

class Grafik extends Controller{
    public function index()
    {
        $data['judul'] = 'Data Grafik';
        $data['grafik'] = $this->model('Grafik_model')->getAllDataGrafik();
        $data['sale'] = $this->model('Databarang_model')->getAllDataBarangLowStock();

        if ($_GET['url'] == 'grafik') {
            $halamanAktif = 1;
            $jumlahDataPerHalaman = 10;
        }else{
            $no = $_GET['url'];
            $lastNo = explode('/', $no);
            $lastNoIndex = end($lastNo);
            $jumlahDataPerHalaman = 10;
            $halamanAktif = $lastNoIndex;
        }
        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
        $data['halamanAktif'] = $halamanAktif;
        $data['awalData'] = $awalData;
        $data['jumlahHalaman'] = $this->model('Grafik_model')->getJumlahHalaman($jumlahDataPerHalaman);

        $data['bestSelling'] = $this->model('Grafik_model')->getAllDataBestSelling($awalData, $jumlahDataPerHalaman);
        $data['allData'] = $this->model('Grafik_model')->allData();
        $this->view('templates/header', $data);
        $this->view('grafik/index', $data);
        $this->view('templates/footer');
    }


    
}