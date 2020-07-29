<?php

class Flasher
{

    //static agar tidak perlu melakukan instasiasi ketika memanggil function

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
        if (isset($_SESSION['flash'])) {
            echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>        
            <strong>Data ' . $_SESSION['flash']['pesan'] . ' ' . $_SESSION['flash']['aksi'] . '</strong>
                    
                </div>';
        }
        unset($_SESSION['flash']);
    }
}
