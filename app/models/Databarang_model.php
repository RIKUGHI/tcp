<?php 

class Databarang_model{
    private $table = 'data_barang';
    private $db;

    public function __construct() {
        $this->db = new Database ;
    }

    public function getAllDataBarang($awalData, $jumlahDataPerHalaman)
    {
        
        $query = ("SELECT * FROM " . $this->table);
        $this->db->query($query);
        $jumlahData = count($this->db->resultSet());
        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
        $queryy = ("SELECT * FROM " . $this->table . " LIMIT $awalData, $jumlahDataPerHalaman");
        $this->db->query($queryy);

        return $this->db->resultSet();
    }

    public function getAllDataBarangForDownload()
    {
        $query = ("SELECT * FROM " . $this->table);
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getJumlahHalaman($jumlahDataPerHalaman)
    {
        $query = ("SELECT * FROM " . $this->table);
        $this->db->query($query);
        $jumlahData = count($this->db->resultSet());
        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

        return $jumlahHalaman;
    }

    public function getAllDataBarangLowStock()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' where stock < 5');
        return $this->db->resultSet();
    }

    public function getDataBarangById($id)
    {   
        $this->db->query('SELECT * FROM ' . $this->table . ' where id_barang = :id_barang');//untul menyimpan data yang akan dibinding
        $this->db->bind('id_barang', $id);
        return $this->db->single();
    } 

    public function tambahDataBarang($data)
    {
        if ($data['kode'] != '') {
            $this->db->query('SELECT * FROM ' . $this->table . ' where kode = :kode AND satuan = :satuan');
            $this->db->bind('kode', $data['kode']);
            $this->db->bind('satuan', $data['satuan']);
            $hasil = $this->db->single();

            if ($hasil != '') {
                Flasher::setFlashNoItem(' BARANG DENGAN KODE '. $data['kode'] .' DAN SATUAN '. $data['satuan'] .' SUDAH TERSEDIA ');
            }else{
                $query = "INSERT INTO data_barang VALUES ('', :nama_barang, :kode, :harga_grosir, :harga_eceran, :satuan, :kategori, :stock)"; 
                $this->db->query($query);
                $this->db->bind('nama_barang', strtoupper($data['nama_barang']));
                $this->db->bind('kode', $data['kode']);
                $this->db->bind('harga_grosir', $data['harga_grosir']);
                $this->db->bind('harga_eceran', $data['harga_eceran']);
                $this->db->bind('satuan', $data['satuan']);
                $this->db->bind('kategori', $data['kategori']);
                $this->db->bind('stock', $data['stock']);
                $this->db->execute();
        
                return $this->db->rowCount();
            }
        }else{
            $query = "INSERT INTO data_barang VALUES ('', :nama_barang, :kode, :harga_grosir, :harga_eceran, :satuan, :kategori, :stock)"; 
                $this->db->query($query);
                $this->db->bind('nama_barang', strtoupper($data['nama_barang']));
                $this->db->bind('kode', $data['kode']);
                $this->db->bind('harga_grosir', $data['harga_grosir']);
                $this->db->bind('harga_eceran', $data['harga_eceran']);
                $this->db->bind('satuan', $data['satuan']);
                $this->db->bind('kategori', $data['kategori']);
                $this->db->bind('stock', $data['stock']);
                $this->db->execute();
        
                return $this->db->rowCount();
        }
        



    }

    public function hapusDataBarang($id)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id_barang = :id_barang';
        $this->db->query($query);
        $this->db->bind('id_barang', $id);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahDataBarang($data)
    {
        $query = "UPDATE data_barang SET 
                    nama_barang=:nama_barang, 
                    kode=:kode, 
                    harga_grosir=:harga_grosir, 
                    harga_eceran=:harga_eceran,
                    satuan=:satuan,
                    kategori=:kategori,
                    stock=:stock
                    WHERE id_barang = :id_barang"; 

        $this->db->query($query);
        $this->db->bind('nama_barang', strtoupper($data['nama_barang']));
        $this->db->bind('kode', $data['kode']);
        $this->db->bind('harga_grosir', $data['harga_grosir']);
        $this->db->bind('harga_eceran', $data['harga_eceran']);
        $this->db->bind('satuan', $data['satuan']);
        $this->db->bind('stock', $data['stock']);
        $this->db->bind('kategori', $data['kategori']);
        $this->db->bind('id_barang', $data['id_barang']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cariDataBarangKasir($awalData, $jumlahDataPerHalaman)
    {
        $keyword = $_POST['keyword'];
        $tipe = $_POST['tipe'];
        $this->db->query("SELECT * FROM data_barang WHERE " . $tipe . " LIKE '%$keyword%' LIMIT $awalData, $jumlahDataPerHalaman");
        
        return $this->db->resultSet();
    }

    public function cariDataBarangForKelola($awalData, $jumlahDataPerHalaman)
    {
        $keyword = $_POST['keyword'];
        $tipe = $_POST['tipe'];
        $this->db->query("SELECT * FROM data_barang WHERE " . $tipe . " LIKE '%$keyword%' LIMIT $awalData, $jumlahDataPerHalaman");
        
        return $this->db->resultSet();
    }

    public function cariDataBarang($awalData, $jumlahDataPerHalaman)
    {
        $keyword = $_POST['keyword'];
        $tipe = $_POST['tipe'];
        $this->db->query("SELECT * FROM data_barang WHERE " . $tipe . " LIKE '%$keyword%' LIMIT $awalData, $jumlahDataPerHalaman");
        
        return $this->db->resultSet();
    }

    public function getJumlahHalamanKelolaDataBarang($jumlahDataPerHalaman)
    {
        $keyword = $_POST['keyword'];
        $tipe = $_POST['tipe'];
        $this->db->query("SELECT * FROM data_barang WHERE " . $tipe . " LIKE '%$keyword%'");
        $jumlahData = count($this->db->resultSet());
        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
        
        return $jumlahHalaman;
    }

    public function getJumlahHalamanCari($jumlahDataPerHalaman)
    {
        $keyword = $_POST['keyword'];
        $tipe = $_POST['tipe'];
        $this->db->query("SELECT * FROM data_barang WHERE " . $tipe . " LIKE '%$keyword%'");
        $jumlahData = count($this->db->resultSet());
        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
        
        return $jumlahHalaman;
    }

    public function getJumlahHalamanCariKasir($jumlahDataPerHalaman)
    {
        $keyword = $_POST['keyword'];
        $tipe = $_POST['tipe'];
        $this->db->query("SELECT * FROM data_barang WHERE " . $tipe . " LIKE '%$keyword%'");
        $jumlahData = count($this->db->resultSet());
        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
        
        return $jumlahHalaman;
    }

    public function cariDataBarangForPage($awalData, $jumlahDataPerHalaman, $tipe, $keyword)
    {
        $this->db->query("SELECT * FROM data_barang WHERE " . $tipe . " LIKE '%$keyword%' LIMIT $awalData, $jumlahDataPerHalaman");
        
        return $this->db->resultSet();
    }

    public function getJumlahHalamanCariForPage($jumlahDataPerHalaman, $tipe, $keyword)
    {
        $this->db->query("SELECT * FROM data_barang WHERE " . $tipe . " LIKE '%$keyword%'");
        $jumlahData = count($this->db->resultSet());
        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
        
        return $jumlahHalaman;
    }

    public function liveCariDataBarang($key){
        $query = 'SELECT * FROM data_barang WHERE nama_barang LIKE :keyword LIMIT 0,50';
        $this->db->query($query);
        $this->db->bind('keyword', "%$key%");
        return $this->db->resultSet();
    }

}
