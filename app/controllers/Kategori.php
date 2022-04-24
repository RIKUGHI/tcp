<?php 

class Kategori extends Controller{
    public function index()
    {
        $data['judul'] = 'Kategori';
        $data['sale'] = $this->model('Databarang_model')->getAllDataBarangLowStock();
        $data['ktg'] = $this->model('Kategori_model')->getAllKategori();
        $this->view('templates/header', $data);
        $this->view('kategori/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $this->model('Kategori_model')->tambahKategori($_POST);
        header('Location: ' .BASEURL . '/kategori');
        exit;
    }

    public function ubah()
    {
        $this->model('Kategori_model')->ubahKategori($_POST);
        header('Location: ' .BASEURL . '/kategori');
        exit;
    }

    public function hapus($id)
    {
        $this->model('Kategori_model')->hapusKategori($id);
        header('Location: ' .BASEURL . '/kategori');
        exit;
    }

    public function getubah()
    {
        echo json_encode($this->model('Kategori_model')->getKategoriById($_POST['id_kategori']));
    }




    

    
}