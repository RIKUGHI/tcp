<?php 

class Kelolatoko extends Controller{
    public function index()
    {
        $data['judul'] = 'Kelola Toko';
        $data['tran'] = $this->model('Transaksi_model')->getAllDataTransaksiToday();
        $data['trandetail'] = $this->model('Transaksi_model')->getAllDataDetailTransaksiToday();
        $data['sale'] = $this->model('Databarang_model')->getAllDataBarangLowStock();
        $this->view('templates/header', $data);
        $this->view('kelolatoko/index', $data);
        $this->view('templates/footer');
    }

    public function simpanHarian()
    {
      var_dump($_POST['Profit']);
      //$this->model('Grafik_model')->simpanDataHarian($_POST);
            
    }


}