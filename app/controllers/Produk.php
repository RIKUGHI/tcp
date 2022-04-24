<?php 

class Produk extends Controller{
    public function index()
    {
        if ($_GET['url'] == 'produk') {
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
            $data['url'] = 'produk/index';
        }
        
        $data['judul'] = 'Produk';
        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
        $data['jumlahHalaman'] = $this->model('Databarang_model')->getJumlahHalaman($jumlahDataPerHalaman);
        $data['produk'] = $this->model('Databarang_model')->getAllDataBarang($awalData, $jumlahDataPerHalaman);
        $data['halamanAktif'] = $halamanAktif;
        $data['awalData'] = $awalData;
        $this->view('templates/header', $data);
        $this->view('produk/index', $data);
        $this->view('templates/footer');
    }
    
    public function cari()
    {
        if (empty($_POST['keyword'])) {
            header('Location: ' . BASEURL . '/produk');
            exit;
        }
        if(isset($_REQUEST["keyword"])){
            if($_REQUEST["keyword"]<>"")
            echo "<a style='position:fixed;right:174px;top:59px;z-index:9;background:#2cde9c;border-radius:10px;padding:0 5px;color:black;font-size:18px;' href='http://localhost/tcp/public/produk'>Kembali</a>";
    }
        
        if ($_GET['url'] == 'produk/cari') {
            $halamanAktif = 1;
            $jumlahDataPerHalaman = 100;
        }else{
            $no = $_GET['url'];
            $lastNo = explode('/', $no);
            $lastNoIndex = end($lastNo);
            $jumlahDataPerHalaman = 100;
            $halamanAktif = $lastNoIndex;
        }
        $data['url'] = 'produk/page/' . $_POST['keyword'] . '/' . $_POST['tipe'] . '';
        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
        $data['jumlahHalaman'] = $this->model('Databarang_model')->getJumlahHalamanCari($jumlahDataPerHalaman);
        $data['halamanAktif'] = $halamanAktif;
        $data['awalData'] = $awalData;

        $data['judul'] = 'Produk';
        $data['produk'] = $this->model('Databarang_model')->cariDataBarang($awalData, $jumlahDataPerHalaman);
        $this->view('templates/header', $data);
        $this->view('produk/index', $data);
        $this->view('templates/footer');
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
        $data['url'] = 'produk/page/' . $keyword . '/' . $tipe . '';
        $data['judul'] = 'Produk';
        $data['produk'] = $this->model('Databarang_model')->cariDataBarangForPage($awalData, $jumlahDataPerHalaman, $tipe, $keyword);
        $this->view('templates/header', $data);
        $this->view('produk/index', $data);
        $this->view('templates/footer');

    }

    public function liveCari()
    {
        $getKey = $_GET['url'];
        $splitKey = explode('/', $getKey);
        $key = end($splitKey);

        echo json_encode($this->model('Databarang_model')->liveCariDataBarang($key));
    }



}