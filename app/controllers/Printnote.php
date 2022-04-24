<?php 

class Printnote extends Controller{

    public function index($invoice)
    {
      $data['judul'] = 'Print ' . $invoice;
      $data['invoice'] = $this->model('Transaksi_model')->getAllDataTransaksiByInvoice($invoice);
      $this->view('templates/header', $data);
      $this->view('print/index', $data);
      $this->view('templates/footer');
      
    }







}