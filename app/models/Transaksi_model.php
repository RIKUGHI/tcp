<?php 

class Transaksi_model{
    private $table = 'transaksi';
    private $db;

    public function __construct() {
        $this->db = new Database ;
    }

    public function getAllDataDetailTransaksi($awalData, $jumlahDataPerHalaman)
    {
        $this->db->query("SELECT * FROM detail_transaksi ORDER BY id_transaksi DESC LIMIT $awalData, $jumlahDataPerHalaman");
        return $this->db->resultSet();
    }

    public function getJumlahHalaman($jumlahDataPerHalaman)
    {
        $this->db->query("SELECT * FROM detail_transaksi");
        $jumlahData = count($this->db->resultSet());
        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
        return $jumlahHalaman;
    }

    public function getAlldataTransaksi($awalData, $jumlahDataPerHalaman)
    {
        $this->db->query("SELECT * FROM transaksi ORDER BY id_transaksi DESC LIMIT $awalData, $jumlahDataPerHalaman");
        return $this->db->resultSet();
    }

    public function getJumlahHalamanTransaksi($jumlahDataPerHalaman)
    {
        $this->db->query(" SELECT * FROM " . $this->table);
        $jumlahData = count($this->db->resultSet());
        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
        return $jumlahHalaman;
    }

    public function getAllDataTransaksiToday()
    {
        $trantoday = date("Ymd");
        $this->db->query("SELECT * FROM transaksi WHERE id_transaksi LIKE '$trantoday%'");
        return $this->db->resultSet();
    }

    public function getAllDataDetailTransaksiToday()
    {
        $trandettoday = date("Ymd");
        $this->db->query("SELECT * FROM detail_transaksi WHERE id_transaksi LIKE '$trandettoday%'");
        return $this->db->resultSet();
    }

    public function getAllDataTransaksiByInvoice($invoice)
    {
        $this->db->query("SELECT dt.id_transaksi, dt.kode, dt.nama_barang, dt.harga, dt.satuan, dt.jumlah , dt.subtotal, t.total, t.bayar, t.kembali  
        FROM detail_transaksi dt, transaksi t WHERE dt.id_transaksi=t.id_transaksi AND dt.id_transaksi='$invoice'");
        return $this->db->resultSet();
    }

    public function getInvoice()
    {
        $today = date("Ymd");
        $query = "SELECT max(id_transaksi) AS last FROM transaksi WHERE id_transaksi LIKE '$today%'";
        $this->db->query($query);
        $hasil =  $this->db->single();
        $lastNoTransaksi = $hasil['last'];
        // print_r($lastNoTransaksi);
        // print_r ("<br>");
        // baca nomor urut transaksi dari id transaksi terakhir 
        $lastNoUrut = substr($lastNoTransaksi, 8, 4); 
        // print_r($lastNoUrut);
        // print_r ("<br>");
        // nomor urut ditambah 1
        $nextNoUrut = $lastNoUrut + 1;
        // print_r($nextNoUrut);
        // print_r ("<br>");
        // membuat format nomor transaksi berikutnya
        $nextNoTransaksi = $today.sprintf('%04s', $nextNoUrut);
        // print_r($nextNoTransaksi);
        // print_r ("<br>");
        return $nextNoTransaksi;
    }


    public function tambahDataTransaksi($data)
    {
        // print_r($_POST['invoice']);
        // print_r ("<br>");
        // print_r($_POST['id_barang']);
        // print_r ("<br>");
        // print_r($_POST['barcode']);
        // print_r ("<br>");
        // print_r($_POST['nama_barang']);
        // print_r ("<br>");
        // print_r($_POST['harga']);
        // print_r ("<br>");
        // print_r($_POST['satuan']);
        // print_r ("<br>");
        // print_r($_POST['jumlah']);
        // print_r ("<br>");
        // print_r($_POST['subtotal']);
        // print_r ("<br>");
        // print_r($_POST['total']);
        // print_r ("<br>");
        // print_r($_POST['bayar']);
        // print_r ("<br>");
        // print_r($_POST['kembali']);
        // print_r ("<br>");
        // -------------------- Tambah Data Ke Transaksi --------------------

        $query = "INSERT INTO transaksi VALUES (:id_transaksi, :jumlah_beli, :total, :bayar, :kembali)"; 
        $this->db->query($query);
        $this->db->bind('id_transaksi', $data['invoice']);
        $this->db->bind('jumlah_beli', $data['jumlah_beli']);
        $this->db->bind('total', $data['total']);
        $this->db->bind('bayar', $data['bayar']);
        $this->db->bind('kembali', $data['kembali']);
        $this->db->execute();

        // -------------------- Tambah Data Ke Grafik --------------------

        $tanggal = date("Y-m-d");
        $query = "SELECT * FROM grafik WHERE tanggal = '$tanggal'"; 
        $this->db->query($query);
        $hasiltanggal =  $this->db->single();
        if ($hasiltanggal != '') {
            $qry = "SELECT MAX(jumlah_beli) AS last FROM grafik WHERE tanggal = '$tanggal'"; 
            $this->db->query($qry);
            $hasilbeli =  $this->db->single();
            $lastjumlahbeli = $hasilbeli['last'];
            $updatejumlahbeli = $lastjumlahbeli + $data['jumlah_beli'];
            $queryi = "UPDATE grafik SET jumlah_beli=:jumlah_beli WHERE tanggal = :tanggal"; 
                $this->db->query($queryi);
                $this->db->bind('jumlah_beli', $updatejumlahbeli);
                $this->db->bind('tanggal', $data['tanggal']);
                $this->db->execute(); 
        }else{
            $queryy = "INSERT INTO grafik VALUES (:tanggal, :jumlah_beli)"; 
            $this->db->query($queryy);
            $this->db->bind('tanggal', $data['tanggal']);
            $this->db->bind('jumlah_beli', $data['jumlah_beli']);
            $this->db->execute();
        }

        //-------------------- Tambah Data Ke Detail Transaksi --------------------

        $query = "INSERT INTO detail_transaksi VALUES (:id_transaksi, :id_barang, :nama_barang, :kode, :harga, :satuan, :jumlah, :subtotal)"; 

        $index = 0;
            foreach ($_POST['id_barang'] as $data) {
                $this->db->query($query);
                $this->db->bind('id_barang', $data);
                $this->db->bind('nama_barang', $_POST['nama_barang'][$index]);
                $this->db->bind('kode', $_POST['kode'][$index]);
                $this->db->bind('harga', $_POST['harga'][$index]);
                $this->db->bind('satuan', $_POST['satuan'][$index]);
                $this->db->bind('jumlah', $_POST['jumlah'][$index]);
                $this->db->bind('subtotal', $_POST['subtotal'][$index]);
                $this->db->bind('id_transaksi', $_POST['invoice']);
            
            $index++;
        
            $this->db->execute();
        }

        //-------------------- Tambah Data Ke Best Selling --------------------

        //cek apakah ada id barang 
        //jika ada update
        //jika tidak insert
        $tahunBulan = date('Y/m');
        $index = 0;
            foreach ($_POST['id_barang'] as $data) {
                $this->db->query("SELECT * FROM best_selling WHERE id_barang = '$data'");
                $hasilFind = $this->db->single();
                if (empty($hasilFind)) {
                    $queryb = "INSERT INTO best_selling VALUES (:tahun_bulan, :id_barang, :nama_barang, :jumlah)"; 
                    $this->db->query($queryb);
                    $this->db->bind('id_barang', $data);
                    $this->db->bind('nama_barang', $_POST['nama_barang'][$index]);
                    $this->db->bind('jumlah', $_POST['jumlah'][$index]);
                    $this->db->bind('tahun_bulan', $tahunBulan);
                    $this->db->execute();
                }else{
                    $this->db->query("SELECT MAX(jumlah) AS lastjml FROM best_selling WHERE id_barang = '$data'");
                    $maxJumlah = $this->db->single();
                    $lastJlm = $maxJumlah['lastjml'];
                    $updateJml = $lastJlm + $_POST['jumlah'][$index];
                    $this->db->query("UPDATE best_selling SET jumlah=:jumlah WHERE id_barang = :id_barang");
                    $this->db->bind('jumlah', $updateJml);
                    $this->db->bind('id_barang', $data);
                    $this->db->execute(); 
                }
            
            $index++;
        
            
        }

        //-------------------- Update Stock Data Barang --------------------

        $querys = "SELECT MAX(stock) AS last FROM data_barang WHERE id_barang = :id_barang "; 

        $index = 0;
            foreach ($_POST['id_barang'] as $data) {
                $this->db->query($querys);
                $this->db->bind('id_barang', $data);
                $this->db->execute();
                $hasilstock =  $this->db->single();
                $laststock = $hasilstock['last'];
                $updatestock = $laststock - $_POST['jumlah'][$index];
                $queryss = "UPDATE data_barang SET stock=:stock WHERE id_barang = :id_barang"; 
                $this->db->query($queryss);
                $this->db->bind('id_barang', $data);
                $this->db->bind('stock', $updatestock);

            $index++;
        
            $this->db->execute();
        }

        //-------------------- Hapus Data Dari Keranjang --------------------

        $query = "DELETE FROM keranjang WHERE id_barang = :id_barang";


            foreach ($_POST['id_barang'] as $data) {
                $this->db->query($query);
                $this->db->bind('id_barang', $data);
            

        
            $this->db->execute();
        }
        header('Location: ' .BASEURL . '/invoice/index/'. $_POST['invoice']);
        exit;


        



    }







}
