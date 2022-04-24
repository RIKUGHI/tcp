<?php 

class Databarang extends Controller{
    public function index()
    {
        if ($_GET['url'] == 'databarang') {
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
        $data['url'] = 'databarang/index';
        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
        $data['jumlahHalaman'] = $this->model('Databarang_model')->getJumlahHalaman($jumlahDataPerHalaman);
        $data['halamanAktif'] = $halamanAktif;
        $data['awalData'] = $awalData;
        $data['judul'] = 'Daftar Barang';
        $data['dtb'] = $this->model('Databarang_model')->getAllDataBarang($awalData, $jumlahDataPerHalaman);
        $data['sale'] = $this->model('Databarang_model')->getAllDataBarangLowStock();
        $data['ktg'] = $this->model('Kategori_model')->getAllKategori();
        $this->view('templates/header', $data);
        $this->view('databarang/index', $data);
        $this->view('templates/footer');
        
    }

    public function download_data()
    {
        print_r($_GET);
        $data['judul'] = 'Download Data Barang';
        $data['dtb'] = $this->model('Databarang_model')->getAllDataBarangForDownload();
        $this->view('templates/header', $data);
        $this->view('databarang/download_data', $data);
        $this->view('templates/footer');
    }

    public function download_data_excel()
    {
        $data['judul'] = 'Download Data Barang';
        $data['dtb'] = $this->model('Databarang_model')->getAllDataBarangForDownload();
        $this->view('templates/header', $data);
        $this->view('databarang/download_data_excel', $data);
        $this->view('templates/footer');
        // header("Content-type: application/vnd-ms-excel");
        // header("Content-Disposition: attachment; filename=nama_filenya.xls");
    }



    public function tambah()
    {
        if ($this->model('Databarang_model')->tambahDataBarang($_POST) > 0) {    
            Flasher::setFlash(' Berhasil ', ' ditambahkan ', 'yey');
            header('Location: ' .BASEURL . '/databarang');
            exit;
        } else {
            Flasher::setFlash(' Gagal', 'ditambahkan', 'gagal');
            header('Location: ' .BASEURL . '/databarang');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('Databarang_model')->hapusDataBarang($id) > 0) {    
            Flasher::setFlash(' Berhasil', 'dihapus', 'yey');
            header('Location: ' .BASEURL . '/databarang');
            exit;
        }else {
            Flasher::setFlash(' Gagal', 'dihapus', 'gagal');
            header('Location: ' .BASEURL . '/databarang');
            exit;
        }
    }

    public function getubah()
    {
        echo json_encode($this->model('Databarang_model')->getDataBarangById($_POST['id_barang']));
    }

    public function getDataUbah()
    {
        $lastIndex = $_GET['url'];
        $pecahUrl = explode('/', $lastIndex);
        $getLastI = end($pecahUrl);
        echo json_encode($this->model('Databarang_model')->getDataBarangById($getLastI));
    }

    public function ubah()
    {
        if ($this->model('Databarang_model')->ubahDataBarang($_POST) > 0) {    
            Flasher::setFlash(' Berhasil', 'diubah', 'yey');
            header('Location: ' .BASEURL . '/databarang');
            exit;
        }else {
            Flasher::setFlash(' Gagal', 'diubah', 'gagal');
            header('Location: ' .BASEURL . '/databarang');
            exit;
        }
    }

    public function cari()
    {
        if (empty($_POST['keyword'])) {
            header('Location: ' . BASEURL . '/databarang');
            exit;
        }

        if(isset($_REQUEST["keyword"])){
            if($_REQUEST["keyword"]<>"")
            echo "<a style='position:fixed;top:80px;left:23%;padding:0 5px; border-radius:10px;background:linear-gradient(to right, #c300ff, #0077ff);font-weight:bold;font-size:16px;' href='http://localhost/tcp/public/databarang'>Kembali</a>";
    }
        
        if ($_GET['url'] == 'databarang/cari') {
            $halamanAktif = 1;
        }else{
            $no = $_GET['url'];
            $lastNo = explode('/', $no);
            $lastNoIndex = end($lastNo);
            $halamanAktif = $lastNoIndex;
        }
    
        $jumlahDataPerHalaman = 100;
        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
        $data['jumlahHalaman'] = $this->model('Databarang_model')->getJumlahHalamanKelolaDataBarang($jumlahDataPerHalaman);
        $data['halamanAktif'] = $halamanAktif;
        $data['awalData'] = $awalData;

        $data['url'] = 'databarang/page/' . $_POST['keyword'] . '/' . $_POST['tipe'] . '';


        $data['judul'] = 'Daftar Barang';
        $data['dtb'] = $this->model('Databarang_model')->cariDataBarangForKelola($awalData, $jumlahDataPerHalaman);
        $data['sale'] = $this->model('Databarang_model')->getAllDataBarangLowStock();
        $data['ktg'] = $this->model('Kategori_model')->getAllKategori();
        $this->view('templates/header', $data);
        $this->view('databarang/index', $data);
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
        $data['url'] = 'databarang/page/' . $keyword . '/' . $tipe . '';
        $data['judul'] = 'databarang';
        $data['dtb'] = $this->model('Databarang_model')->cariDataBarangForPage($awalData, $jumlahDataPerHalaman, $tipe, $keyword);
        $data['sale'] = $this->model('Databarang_model')->getAllDataBarangLowStock();

        $this->view('templates/header', $data);
        $this->view('databarang/index', $data);
        $this->view('templates/footer');

    }



    

    
}