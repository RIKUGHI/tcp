<?php 

class Kasir extends Controller{
    public function index()
    {
        if ($_GET['url'] == 'kasir') {
            $halamanAktif = 1;
            $jumlahDataPerHalaman = 100;
        }else{
            $no = $_GET['url'];
            $lastNo = explode('/', $no);
            $lastNoIndex = end($lastNo);
            $jumlahDataPerHalaman = 100;
            if (empty($lastNoIndex)) {
                $halamanAktif = 1;
            }else{
                $halamanAktif = $lastNoIndex;
            }
        }
        $data['url'] = 'kasir/index';
        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
        $data['jumlahHalaman'] = $this->model('Databarang_model')->getJumlahHalaman($jumlahDataPerHalaman);
        $data['halamanAktif'] = $halamanAktif;
        $data['awalData'] = $awalData;
        $data['judul'] = 'Kasir';
        $data['produksir'] = $this->model('Databarang_model')->getAllDataBarang($awalData, $jumlahDataPerHalaman);
        $data['produkker'] = $this->model('Kasir_model')->getAllDataKeranjang();
        $data['invoice'] = $this->model('Transaksi_model')->getInvoice();
        $this->view('templates/header', $data);
        $this->view('kasir/index', $data);
        $this->view('templates/footer');
    }

    public function keranjang()
    {
        if ($this->model('Kasir_model')->tambahDataKeKeranjang($_POST) > 0) {    
            header('Location: ' .BASEURL . '/kasir');
            exit;
        }
    }

    public function getbarang($id)
    {
        $data['judul'] = 'Tambah Barang';
        $data['dtbrng'] = $this->model('Databarang_model')->getDataBarangById($id);
        $this->view('templates/header', $data);
        $this->view('kasir/tambah', $data);
        $this->view('templates/footer');
    }

    public function ubahKeranjang()
    {
        $this->model('Kasir_model')->ubahDataKeranjang();
        //if ( > 0) {    
            //header('Location: ' .BASEURL . '/kasir');
            //exit;
        //}
    }

    public function hapusKeranjang($id)
    {
        if ($this->model('Kasir_model')->hapusDataKeranjang($id) > 0) {    
            header('Location: ' .BASEURL . '/kasir');
            exit;
        }
    }

    public function getProduk()
    {
        echo json_encode($this->model('Databarang_model')->getDataBarangById($_POST['id_barang']));
    }

    public function getLiveBarang()
    {   
        $getKey = $_GET['url'];
        $splitKey = explode('/', $getKey);
        $key = end($splitKey);
        echo json_encode($this->model('Databarang_model')->liveCariDataBarang($key));
    }


    public function cari()
    {
        if (empty($_POST['keyword'])) {
            header('Location: ' . BASEURL . '/kasir');
            exit;
        }

        if ($_GET['url'] == 'kasir/cari') {
            $halamanAktif = 1;
        }else{
            $no = $_GET['url'];
            $lastNo = explode('/', $no);
            $lastNoIndex = end($lastNo);
            $halamanAktif = $lastNoIndex;
        }
        $data['url'] = 'kasir/page/' . $_POST['keyword'] . '/' . $_POST['tipe'] . '';

        $jumlahDataPerHalaman = 100;
        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
        $data['jumlahHalaman'] = $this->model('Databarang_model')->getJumlahHalamanCariKasir($jumlahDataPerHalaman);
        $data['halamanAktif'] = $halamanAktif;
        $data['awalData'] = $awalData;
        
        $data['judul'] = 'Kasir';
        $data['produksir'] = $this->model('Databarang_model')->cariDataBarangKasir($awalData, $jumlahDataPerHalaman);
        $data['produkker'] = $this->model('Kasir_model')->getAllDataKeranjang();
        $data['invoice'] = $this->model('Transaksi_model')->getInvoice();
        $this->view('templates/header', $data);
        $this->view('kasir/index', $data);
        $this->view('templates/footer');
    }

    public function scanbarcode()
    {
        if($this->model('Kasir_model')->tambahDataKeKeranjangByCode($_POST) > 0){
            header('Location: ' .BASEURL . '/kasir');
            exit;
        }else{
            Flasher::setFlashNoItem(' BARANG BELUM TERSEDIA ');
            header('Location: ' .BASEURL . '/kasir');
            exit;
        }
    }

    public function page()
    {
        $no = $_GET['url'];
        $lastNo = explode('/', $no);
        $lastNoIndex = end($lastNo);
        $jumlahDataPerHalaman = 100;
        $halamanAktif = $lastNoIndex;
        $tipe = $lastNo[3];
        $keyword = $lastNo[2];
        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
        $data['jumlahHalaman'] = $this->model('Databarang_model')->getJumlahHalamanCariForPage($jumlahDataPerHalaman, $tipe, $keyword);
        $data['halamanAktif'] = $halamanAktif;
        $data['awalData'] = $awalData;
        $data['url'] = 'kasir/page/' . $keyword . '/' . $tipe . '';
        $data['judul'] = 'Kasir';
        $data['produksir'] = $this->model('Databarang_model')->cariDataBarangForPage($awalData, $jumlahDataPerHalaman, $tipe, $keyword);
        $data['produkker'] = $this->model('Kasir_model')->getAllDataKeranjang();
        $data['invoice'] = $this->model('Transaksi_model')->getInvoice();
        $this->view('templates/header', $data);
        $this->view('kasir/index', $data);
        $this->view('templates/footer');

    }




}