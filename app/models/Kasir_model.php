<?php 

class Kasir_model{
    private $table = 'keranjang';
    private $db;

    public function __construct() {
        $this->db = new Database ;
    }


    public function getAllDataKeranjang()
    {
        $this->db->query('SELECT * FROM ' . $this->table );//untul menyimpan data yang akan dibinding
        return $this->db->resultSet();
    } 
    
    public function tambahDataKeKeranjang($data)
    {
        $query = "INSERT INTO keranjang VALUES (:id_barang, :nama_barang, :kode, :harga, :satuan, :jumlah)"; 
        $this->db->query($query);
        $this->db->bind('id_barang', $data['id_barang']);
        $this->db->bind('nama_barang', $data['nama_barang']);
        $this->db->bind('kode', $data['kode']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('satuan', $data['satuan']);
        $this->db->bind('jumlah', $data['jumlah']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function tambahDataKeKeranjangByCode($barcode)
    {
        $kode = $barcode['scanbarcode'];
        $satuan = $barcode['satuan'];
        $this->db->query("SELECT * FROM data_barang WHERE kode='$kode' AND satuan='$satuan'");
        $hasil = $this->db->single();
        if ( $satuan == 'BIJIAN' ) {
            if ( $hasil != '' ) {
                $jumlah = 1;
                $query = "INSERT INTO keranjang VALUES (:id_barang, :nama_barang, :kode, :harga, :satuan, :jumlah)"; 
                    $this->db->query($query);
                    $this->db->bind('id_barang', $hasil['id_barang']);
                    $this->db->bind('nama_barang', $hasil['nama_barang']);
                    $this->db->bind('kode', $hasil['kode']);
                    $this->db->bind('harga', $hasil['harga_eceran']);
                    $this->db->bind('satuan', $hasil['satuan']);
                    $this->db->bind('jumlah', $jumlah);
                    $this->db->execute();
                    
                    return $this->db->rowCount();
            }else{
                echo "kosong";
            }
        }else {
            if ( $hasil != '' ) {
                $jumlah = 1;
                $query = "INSERT INTO keranjang VALUES (:id_barang, :nama_barang, :kode, :harga, :satuan, :jumlah)"; 
                    $this->db->query($query);
                    $this->db->bind('id_barang', $hasil['id_barang']);
                    $this->db->bind('nama_barang', $hasil['nama_barang']);
                    $this->db->bind('kode', $hasil['kode']);
                    $this->db->bind('harga', $hasil['harga_grosir']);
                    $this->db->bind('satuan', $hasil['satuan']);
                    $this->db->bind('jumlah', $jumlah);
                    $this->db->execute();
                    
                    return $this->db->rowCount();
            }else{
                echo "kosong";
            }
        }
    }

    public function ubahDataKeranjang()
    {
        
        $query = "UPDATE keranjang SET 
                    jumlah=:jumlah 
                    WHERE id_barang = :id_barang"; 

        $index = 0;
            foreach ($_POST['id_barang'] as $data) {
            $this->db->query($query);
            $this->db->bind('jumlah', $_POST['jumlah'][$index]);
            $this->db->bind('id_barang', $data);
            
            $index++;
        
            $this->db->execute();
        }
        header('Location: ' .BASEURL . '/kasir/index/1');
        //return $this->db->rowCount();
    }

    public function hapusDataKeranjang($id)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id_barang = :id_barang';
        $this->db->query($query);
        $this->db->bind('id_barang', $id);

        $this->db->execute();
        return $this->db->rowCount();
    }



}
