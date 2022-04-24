<?php  

class Flasher{
    public static function setFlash($pesan, $aksi, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION['flash'])) 
        {
            echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' " role="alert">
                    Data Barang <strong>' . $_SESSION['flash']['pesan'] . '</strong> ' . $_SESSION['flash']['aksi'] . '
                    <button type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            unset($_SESSION['flash']);
        }
    }

    public static function setFlashNoItem($pesan)
    {
        $_SESSION['noitem'] = [
            'pesan' => $pesan
        ];
    }

    public function flashNoItem()
    {
        if (isset($_SESSION['noitem'])) {
            echo '<div class="alert background-no-item">
                    <div class="flash-no-item">
                        <strong>' . $_SESSION['noitem']['pesan'] . '</strong>
                        <button type="button" data-dismiss="alert" aria-label="Close">  
                            &times;
                        </button>
                    </div>
                </div>';
            unset($_SESSION['noitem']);
        }
    }





}