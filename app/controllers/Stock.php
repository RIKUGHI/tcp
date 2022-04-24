<?php 

class Stock extends Controller{
    public function index()
    {
        $data['judul'] = 'Stock < 5';
        $data['sale'] = $this->model('Databarang_model')->getAllDataBarangLowStock();
        $this->view('templates/header', $data);
        $this->view('stock/index', $data);
        $this->view('templates/footer');
    }




    
}