<?php 

class Invoice extends Controller{

    public function index($invoice)
    {
      $data['noinvoice'] = $invoice;
      $data['judul'] = 'Invoice ' . $invoice;
      $data['invoice'] = $this->model('Transaksi_model')->getAllDataTransaksiByInvoice($invoice);
      $this->view('templates/header', $data);
      $this->view('invoice/index', $data);
      $this->view('templates/footer');
      
    }







}