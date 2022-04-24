<?php 

class Kategori_model{
    private $table = 'kategori';
    private $db;

    public function __construct() {
        $this->db = new Database ;
    }


    public function getAllKategori()
    {
        $this->db->query('SELECT * FROM ' . $this->table );//untul menyimpan data yang akan dibinding
        return $this->db->resultSet();
    } 

    public function getKategoriById($id)
    {   
        $this->db->query('SELECT * FROM ' . $this->table . ' where id_kategori = :id_kategori');//untul menyimpan data yang akan dibinding
        $this->db->bind('id_kategori', $id);
        return $this->db->single();
    } 
    
    public function tambahKategori($data)
    {
        $query = "INSERT INTO kategori VALUES ('', :kategori)"; 
        $this->db->query($query);
        $this->db->bind('kategori', strtoupper($data['kategori']));
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahKategori($data)
    {
        print_r($data);
        $query = "UPDATE kategori SET 
                    kategori= :kategori 
                    WHERE id_kategori = :id_kategori"; 

            $this->db->query($query);
            $this->db->bind('kategori', strtoupper($data['kategori']));
            $this->db->bind('id_kategori', $data['id_kategori']);
        
            $this->db->execute();
    }

    public function hapusKategori($id)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id_kategori = :id_kategori';
        $this->db->query($query);
        $this->db->bind('id_kategori', $id);

        $this->db->execute();
        return $this->db->rowCount();
    }



}
