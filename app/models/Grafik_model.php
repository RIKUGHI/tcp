<?php 

class Grafik_model{
    private $table = 'grafik';
    private $db;

    public function __construct() {
        $this->db = new Database ;
    }

    public function getAllDataGrafik()
    {
      $mounth = date("Y-m");
      $this->db->query("SELECT * FROM " .  $this->table . " WHERE tanggal LIKE '$mounth%'");
      return $this->db->resultSet();
    }

    public function getAllDataBestSelling($awalData, $jumlahDataPerHalaman)
    {
      $mounthB = date('Y/m');
      $this->db->query("SELECT * FROM best_selling WHERE tahun_bulan = '$mounthB'");
      $jumlahData = count($this->db->resultSet());
      $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
      $queryBestSelling = "SELECT * FROM best_selling WHERE tahun_bulan = '$mounthB' ORDER BY jumlah DESC LIMIT $awalData, $jumlahDataPerHalaman";
      $this->db->query($queryBestSelling);

      return $this->db->resultSet();
    }

    public function getJumlahHalaman($jumlahDataPerHalaman)
    {
      $mounthH = date('Y/m');
      $this->db->query("SELECT * FROM best_selling WHERE tahun_bulan = '$mounthH'");
      $jumlahData = count($this->db->resultSet());
      $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

        return $jumlahHalaman;
    }

    public function allData()
    {
      $mounthBS = date('Y/m');
      $this->db->query("SELECT * FROM best_selling WHERE tahun_bulan = '$mounthBS' ORDER BY jumlah DESC");
      return $this->db->resultSet();
    }



}
