<?php
class Pembahasan_model
{
    private $table = 'pembahasan';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_bahas=:id_bahas");
        $this->db->bind("id_bahas", $id);
        return $this->db->single();
    }

    public function getByIdSoal($id_soal)
    {
        $this->db->query("SELECT * FROM $this->table WHERE pembahasan.id_soal=:id_soal ");
        $this->db->bind("id_soal", $id_soal);
        return $this->db->single();
    }

    public function insert($data, $file = null)
    {
        if ($file != null) {
            $query = 'INSERT INTO ' . $this->table . ' (id_soal, isi, file) 
            VALUES (:id_soal, :isi, :file)';
            $lokasi = $this->_uploadImgLocal($file);
            if ($lokasi) {
                $this->db->query($query);
                $this->db->bind("id_soal", $data['id_soal']);
                $this->db->bind("isi", $data['isi']);
                $this->db->bind("file", $lokasi);
                $this->db->execute();
                return $this->db->rowCount();
            } else {
                $this->db->query($query);
                $this->db->bind("id_soal", $data['id_soal']);
                $this->db->bind("isi", $data['isi']);
                $this->db->bind("file", null);
                $this->db->execute();
                return $this->db->rowCount();
            }
        } else {
            $query = 'INSERT INTO ' . $this->table . ' (id_soal, isi, file) 
            VALUES (:id_soal, :isi, :file)';
            $this->db->query($query);
            $this->db->bind("id_soal", $data['id_soal']);
            $this->db->bind("isi", $data['isi']);
            $this->db->bind("file", null);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }

    public function update($data, $file = null)
    {
        if ($file['file']['name'] != "") {
            $lokasi = $this->_updateImgLocal($data['file_lama'], $file);
            if ($lokasi != false) {
                $query = 'UPDATE ' . $this->table . ' SET id_soal=:id_soal, isi=:isi, file=:file WHERE id_bahas=:id_bahas';
                $this->db->query($query);
                $this->db->bind("id_soal", $data['id_soal']);
                $this->db->bind("isi", $data['isi']);
                $this->db->bind("file", $lokasi);
                $this->db->bind("id_bahas", $data['id_bahas']);
                $this->db->execute();
                return $this->db->rowCount();
            } else {
                $query = 'UPDATE ' . $this->table . ' SET id_soal=:id_soal, isi=:isi WHERE id_bahas=:id_bahas';
                $this->db->query($query);
                $this->db->bind("id_soal", $data['id_soal']);
                $this->db->bind("isi", $data['isi']);
                $this->db->bind("id_bahas", $data['id_bahas']);
                $this->db->execute();
                return $this->db->rowCount();
            } 
        } else {
            $query = 'UPDATE ' . $this->table . ' SET id_soal=:id_soal, isi=:isi WHERE id_bahas=:id_bahas';
            $this->db->query($query);
            $this->db->bind("id_soal", $data['id_soal']);
            $this->db->bind("isi", $data['isi']);
            $this->db->bind("id_bahas", $data['id_bahas']);
            $this->db->execute();
            return $this->db->rowCount();
        }
        return 0;
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id_bahas=:id_bahas";
        $this->db->query($query);
        $this->db->bind("id_bahas", $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    //Fungsi upload gambar
    public function _uploadImgLocal($gambar)
    {
        $ekstensi_diizinkan = array('png', 'jpg');
        $nama = $gambar['file']['name'];
        $x = explode('.', $nama);
        $ekstensi = strtolower(end($x));
        $nama_1 = strtolower($x[0]);
        $ukuran = $gambar['file']['size'];
        $file_tmp = $gambar['file']['tmp_name'];
        if (in_array($ekstensi, $ekstensi_diizinkan) === true) {
            $increment = '';
            $cari_nama = "/../file-upload/" . $nama_1 . ".$ekstensi";
            while (file_exists(__DIR__ . $cari_nama)) {
                $increment++;
                $cari_nama = "/../file-upload/" . $nama_1 . "_$increment.$ekstensi";
            }
            if ($increment != '' or (int) $increment >= 1) {
                move_uploaded_file($file_tmp, __DIR__ . "/../file-upload/" . $nama_1 . "_$increment." . $ekstensi);
                $lokasi = "file-upload/" .  $nama_1 . "_$increment." . $ekstensi;
            } else {
                move_uploaded_file($file_tmp, __DIR__ . "/../file-upload/" . $nama_1 . "." . $ekstensi);
                $lokasi = "file-upload/" . $nama_1 . "." . $ekstensi;
            }

            return $lokasi;
        } else {
            return false;
        }
        return false;
    }
    public function _deleteImgLocal($dir)
    {
        if (file_exists($dir) && $dir != null) {
            unlink($dir);
            return true;
        }
        return false;
    }
    public function _deleteImg($dir, $id)
    {
        if (file_exists(__DIR__ . "/../" . $dir) && $dir != null) {
            unlink(__DIR__ . "/../" . $dir);
            $query = "UPDATE " . $this->table . " SET file=:file where id_bahas=:id_bahas";
            $this->db->query($query);
            $this->db->bind("file", null);
            $this->db->bind("id_bahas", $id);
            $this->db->execute();
            echo "<script>alert('Gambar berhasil dihapus');</script>";
            return true;
        } else {
            echo "<script>alert('Gambar tidak ditemukan di folder');</script>";
            $query = "UPDATE " . $this->table . " SET file=:file where id_bahas=:id_bahas";
            $this->db->query($query);
            $this->db->bind("file", null);
            $this->db->bind("id_bahas", $id);
            $this->db->execute();
        }
        return false;
    }

    public function _updateImgLocal($dirGambarLama, $gambarBaru)
    {
        $ekstensi_diizinkan = array('png', 'jpg');

        //data gambar lama
        $cari_nama_lama = "/../" . $dirGambarLama;

        //data gambar baru
        $nama_baru = $gambarBaru['file']['name'];
        $x_baru = explode('.', $nama_baru);
        $ekstensi_baru = strtolower(end($x_baru));
        $nama_1_baru = strtolower($x_baru[0]);
        $ukuran_baru = $gambarBaru['file']['size'];
        $file_tmp_baru = $gambarBaru['file']['tmp_name'];
        $cari_nama_baru = "/../file-upload/" . $nama_1_baru . ".$ekstensi_baru";

        if ($gambarBaru['file']['name'] != "") {
            if (file_exists(__DIR__ . $cari_nama_lama) and $dirGambarLama != null) {
                //Hapus gambar lama di local
                if ($this->_deleteImgLocal(__DIR__ . $cari_nama_lama)) {

                    if (in_array($ekstensi_baru, $ekstensi_diizinkan) === true) {
                        $increment = '';
                        $cari_nama_baru = "/../file-upload/" . $nama_1_baru . ".$ekstensi_baru";
                        while (file_exists(__DIR__ . $cari_nama_baru)) {
                            $increment++;
                            $cari_nama_baru = "/../file-upload/" . $nama_1_baru . "_$increment.$ekstensi_baru";
                        }
                        if ($increment != '' or (int) $increment >= 1) {
                            move_uploaded_file($file_tmp_baru, __DIR__ . "/../file-upload/" . $nama_1_baru . "_$increment." . $ekstensi_baru);
                            $lokasi = "file-upload/" .  $nama_1_baru . "_$increment." . $ekstensi_baru;
                        } else {
                            move_uploaded_file($file_tmp_baru, __DIR__ . "/../file-upload/" . $nama_1_baru . "." . $ekstensi_baru);
                            $lokasi = "file-upload/" . $nama_1_baru . "." . $ekstensi_baru;
                        }

                        return $lokasi;
                    } else {
                        echo "<script>alert('Ekstensi tidak diizinkan');</script>";
                        return false;
                    }
                } else {
                }
            } else {
                echo "<script>alert('Gambar lama tidak dapat ditemukan, gambar akan ditambahkan');</script>";
                return $this->_uploadImgLocal($gambarBaru);
            }
        }
        return false;
    }
    //End fungsi upload gambar
}
