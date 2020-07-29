<?php
class Soal_model
{
    private $table = 'soal';
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
        $this->db->query("SELECT soal.id_soal as id_soal, soal.id_sub as id_sub, soal.isi as isi, soal.file as file, soal.true as 'true', soal.pil_a as pil_a, soal.pil_b as pil_b, soal.pil_c as pil_c, soal.pil_d as pil_d, soal.pil_e as pil_e, soal.score_a as score_a, soal.score_b as score_b, soal.score_c as score_c, soal.score_d as score_d, soal.score_e as score_e, sub, jenjang, waktu FROM soal, sub_jenis WHERE soal.id_soal=:id_soal and sub_jenis.id_sub=soal.id_sub");
        $this->db->bind("id_soal", $id);
        return $this->db->single();
    }
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
            echo "<script>alert('ekstensi tidak diizinkan');</script>";
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
    public function _deleteImg($dir, $id_soal)
    {
        if (file_exists(__DIR__ . "/../" . $dir) && $dir != null) {
            unlink(__DIR__ . "/../" . $dir);
            $query = "UPDATE " . $this->table . " SET file=:file where id_soal=:id_soal";
            $this->db->query($query);
            $this->db->bind("file", null);
            $this->db->bind("id_soal", $id_soal);
            $this->db->execute();
            echo "<script>alert('Gambar berhasil dihapus');</script>";
            return true;
        } else {
            echo "<script>alert('Gambar tidak ditemukan');</script>";
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
                    echo "<script>alert('Tidak dapat menghapus gambar lama');</script>";
                    return false;
                }
            } else {
                echo "<script>alert('Gambar lama tidak dapat ditemukan, gambar akan ditambahkan');</script>";
                return $this->_uploadImgLocal($gambarBaru);
            }
        }
        return false;
    }

    public function insert($data, $file = null)
    {
        if ($file['file']['name'] != "") {
            $lokasi = $this->_uploadImgLocal($file);
            if ($lokasi != false) {
                $query = 'INSERT INTO ' . $this->table . '(id_sub, isi, file, `true` , pil_a, score_a, pil_b, score_b, pil_c, score_c, pil_d, score_d, pil_e, score_e) 
                VALUES (:id_sub, :isi, :file, :true, :pil_a, 
                :score_a, :pil_b, :score_b, :pil_c, :score_c, :pil_d, :score_d, :pil_e, :score_e)';
                $this->db->query($query);
                $this->db->bind("id_sub", $data['id_sub']);
                $this->db->bind("isi", $data['isi']);
                $this->db->bind("file", $lokasi);
                $this->db->bind("true", $data['true']);
                $this->db->bind("pil_a", $data['pil_a']);
                $this->db->bind("score_a", $data['score_a']);
                $this->db->bind("pil_b", $data['pil_b']);
                $this->db->bind("score_b", $data['score_b']);
                $this->db->bind("pil_c", $data['pil_c']);
                $this->db->bind("score_c", $data['score_c']);
                $this->db->bind("pil_d", $data['pil_d']);
                $this->db->bind("score_d", $data['score_d']);
                $this->db->bind("pil_e", $data['pil_e']);
                $this->db->bind("score_e", $data['score_e']);
                $this->db->execute();
                return $this->db->rowCount();
            } else {
                return 0;
            }
        } else {
            $query = 'INSERT INTO ' . $this->table . " (id_sub, isi, file, `true` , pil_a, score_a, pil_b, score_b, pil_c, score_c, pil_d, score_d, pil_e, score_e) 
            VALUES (:id_sub, :isi, :file, :true, :pil_a, 
            :score_a, :pil_b, :score_b, :pil_c, :score_c, :pil_d, :score_d, :pil_e, :score_e)";
            $this->db->query($query);
            $this->db->bind("id_sub", $data['id_sub']);
            $this->db->bind("isi", $data['isi']);
            $this->db->bind("file", null);
            $this->db->bind("true", $data['true']);
            $this->db->bind("pil_a", $data['pil_a']);
            $this->db->bind("score_a", $data['score_a']);
            $this->db->bind("pil_b", $data['pil_b']);
            $this->db->bind("score_b", $data['score_b']);
            $this->db->bind("pil_c", $data['pil_c']);
            $this->db->bind("score_c", $data['score_c']);
            $this->db->bind("pil_d", $data['pil_d']);
            $this->db->bind("score_d", $data['score_d']);
            $this->db->bind("pil_e", $data['pil_e']);
            $this->db->bind("score_e", $data['score_e']);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }

    public function update($data, $file = null)
    {
        if ($file['file']['name'] != "") {
            $lokasi = $this->_updateImgLocal($data['file_lama'], $file);
            if ($lokasi != false) {
                $query = "UPDATE " . $this->table . " SET isi=:isi, file=:file, `true`=:true, pil_a=:pil_a, 
                score_a=:score_a, pil_b=:pil_b, score_b=:score_b, pil_c=:pil_c, score_c=:score_c, pil_d=:pil_d, score_d=:score_d, pil_e=:pil_e, score_e=:score_e
                WHERE id_soal=:id_soal";
                $this->db->query($query);
                $this->db->bind("isi", $data['isi']);
                $this->db->bind("file", $lokasi);
                $this->db->bind("true", $data['true']);
                $this->db->bind("pil_a", $data['pil_a']);
                $this->db->bind("score_a", $data['score_a']);
                $this->db->bind("pil_b", $data['pil_b']);
                $this->db->bind("score_b", $data['score_b']);
                $this->db->bind("pil_c", $data['pil_c']);
                $this->db->bind("score_c", $data['score_c']);
                $this->db->bind("pil_d", $data['pil_d']);
                $this->db->bind("score_d", $data['score_d']);
                $this->db->bind("pil_e", $data['pil_e']);
                $this->db->bind("score_e", $data['score_e']);
                $this->db->bind("id_soal", $data['id_soal']);
                $this->db->execute();
                return $this->db->rowCount();
            } else {
                $query = "UPDATE " . $this->table . " SET isi=:isi, `true`=:true, pil_a=:pil_a, 
                score_a=:score_a, pil_b=:pil_b, score_b=:score_b, pil_c=:pil_c, score_c=:score_c, pil_d=:pil_d, score_d=:score_d, pil_e=:pil_e, score_e=:score_e
                WHERE id_soal=:id_soal";
                $this->db->query($query);
                $this->db->bind("isi", $data['isi']);
                $this->db->bind("true", $data['true']);
                $this->db->bind("pil_a", $data['pil_a']);
                $this->db->bind("score_a", $data['score_a']);
                $this->db->bind("pil_b", $data['pil_b']);
                $this->db->bind("score_b", $data['score_b']);
                $this->db->bind("pil_c", $data['pil_c']);
                $this->db->bind("score_c", $data['score_c']);
                $this->db->bind("pil_d", $data['pil_d']);
                $this->db->bind("score_d", $data['score_d']);
                $this->db->bind("pil_e", $data['pil_e']);
                $this->db->bind("score_e", $data['score_e']);
                $this->db->bind("id_soal", $data['id_soal']);
                $this->db->execute();
                return $this->db->rowCount();
            }
        } else {
            $query = "UPDATE " . $this->table . " SET isi=:isi, `true`=:true, pil_a=:pil_a, 
            score_a=:score_a, pil_b=:pil_b, score_b=:score_b, pil_c=:pil_c, score_c=:score_c, pil_d=:pil_d, score_d=:score_d, pil_e=:pil_e, score_e=:score_e
            WHERE id_soal=:id_soal";
            $this->db->query($query);
            $this->db->bind("isi", $data['isi']);
            $this->db->bind("true", $data['true']);
            $this->db->bind("pil_a", $data['pil_a']);
            $this->db->bind("score_a", $data['score_a']);
            $this->db->bind("pil_b", $data['pil_b']);
            $this->db->bind("score_b", $data['score_b']);
            $this->db->bind("pil_c", $data['pil_c']);
            $this->db->bind("score_c", $data['score_c']);
            $this->db->bind("pil_d", $data['pil_d']);
            $this->db->bind("score_d", $data['score_d']);
            $this->db->bind("pil_e", $data['pil_e']);
            $this->db->bind("score_e", $data['score_e']);
            $this->db->bind("id_soal", $data['id_soal']);
            $this->db->execute();
            return $this->db->rowCount();
        }
        return 0;
    }

    public function delete($id)
    {
        $data = $this->getById($id);
        if (isset($data['id_soal'])) {
            $dir = __DIR__ . '/../' . $data['file'];
            if (file_exists($dir) && $dir != null) {
                unlink($dir);
                $query = "DELETE FROM $this->table WHERE id_soal=:id_soal";
                $this->db->query($query);
                $this->db->bind("id_soal", $id);
                $this->db->execute();
                return $this->db->rowCount();
            } else {
                $query = "DELETE FROM $this->table WHERE id_soal=:id_soal";
                $this->db->query($query);
                $this->db->bind("id_soal", $id);
                $this->db->execute();
                $_SESSION['errdelete-msg'] = "Gambar soal tidak terhapus, hal ini karena gambar tida ada/null atau sedang terjadi kesalahan pada sistem";
                return $this->db->rowCount();
            }
        }
    }

    public function tampil_soal_ByIdSub($id_sub = null)
    {
        if ($id_sub != null) {
            $query = "SELECT soal.id_soal as id_soal, soal.id_sub as id_sub, soal.isi as isi, soal.file as file, soal.true as 'true', soal.pil_a as pil_a, soal.pil_b as pil_b, soal.pil_c as pil_c, soal.pil_d as pil_d, soal.pil_e as pil_e, soal.score_a as score_a, soal.score_b as score_b, soal.score_c as score_c, soal.score_d as score_d, soal.score_e as score_e, sub, jenjang, waktu FROM soal, sub_jenis WHERE soal.id_sub=:id_sub and sub_jenis.id_sub=soal.id_sub ORDER BY soal.id_soal ASC";
            $this->db->query($query);
            $this->db->bind("id_sub", $id_sub);
            $this->db->execute();
            return $this->db->resultSet();
        } else {
            return $this->getAll();
        }
    }
    public function tampil_soal_ByJenjang($jenjang = null)
    {
        if ($jenjang != null) {
            $query = "SELECT soal.id_soal as id_soal, soal.id_sub as id_sub, soal.isi as isi, soal.file as file,COUNT(soal.id_sub) as n_id_sub, soal.true as 'true', soal.pil_a as pil_a, soal.pil_b as pil_b, soal.pil_c as pil_c, soal.pil_d as pil_d, soal.pil_e as pil_e, soal.score_a as score_a, soal.score_b as score_b, soal.score_c as score_c, soal.score_d as score_d, soal.score_e as score_e, sub, jenjang, waktu FROM soal, sub_jenis WHERE sub_jenis.jenjang=:jenjang and sub_jenis.id_sub=soal.id_sub";
            $this->db->query($query);
            $this->db->bind("jenjang", $jenjang);
            $this->db->execute();
            return $this->db->resultSet();
        } else {
            return $this->getAll();
        }
    }
    public function getByToken($token = null, $id_sub)
    {
        if ($token != null) {
            $query = "SELECT tokensoal.id_tokensoal, tokensoal.id_token, dt_token.token, soal.id_soal, soal.id_sub as id_sub, 
            soal.isi as isi, soal.file as file, soal.true as 'true', soal.pil_a as pil_a, soal.pil_b as pil_b, soal.pil_c as 
            pil_c, soal.pil_d as pil_d, soal.pil_e as pil_e, soal.score_a as score_a, soal.score_b as score_b, soal.score_c as 
            score_c, soal.score_d as score_d, soal.score_e as score_e, sub, jenjang, waktu FROM tokensoal, dt_token, soal, 
            sub_jenis where soal.id_sub=sub_jenis.id_sub and dt_token.id_token=tokensoal.id_token and 
            tokensoal.id_soal=soal.id_soal and dt_token.token=:token and sub_jenis.id_sub=:id_sub";
            $this->db->query($query);
            $this->db->bind("token", $token);
            $this->db->bind("id_sub", $id_sub);
            $this->db->execute();
            return $this->db->resultSet();
        } else {
            return $this->getAll();
        }
    }
    public function getWhereNotIn($token = null, $id_sub)
    {
        if ($token != null) {
            $query = "SELECT soal.id_soal as id_soal, soal.id_sub as id_sub, soal.isi as isi, soal.file as file, soal.true as 'true', soal.pil_a as pil_a, soal.pil_b as pil_b, soal.pil_c as pil_c, soal.pil_d as pil_d, soal.pil_e as pil_e, soal.score_a as score_a, soal.score_b as score_b, soal.score_c as score_c, soal.score_d as score_d, soal.score_e as score_e, sub, jenjang, waktu FROM soal, sub_jenis WHERE soal.id_soal NOT IN (SELECT soal.id_soal FROM tokensoal, dt_token, soal, sub_jenis where soal.id_sub=sub_jenis.id_sub and dt_token.id_token=tokensoal.id_token and tokensoal.id_soal=soal.id_soal and dt_token.token=:token) and soal.id_sub=:id_sub and sub_jenis.id_sub=soal.id_sub ORDER BY soal.id_soal ASC";
            $this->db->query($query);
            $this->db->bind("token", $token);
            $this->db->bind("id_sub", $id_sub);
            $this->db->execute();
            return $this->db->resultSet();
        } else {
            return $this->getAll();
        }
    }

    public function countIdSubByJenjang($jenjang = null)
    {
        if ($jenjang != null) {
            $query = "SELECT sub_jenis.id_sub as id_sub, sub, jenjang, COUNT(soal.id_soal) as n_id_sub, waktu, nm_jenis, soal.id_soal FROM `sub_jenis` LEFT JOIN jenis_soal ON jenis_soal.id_jenis=sub_jenis.id_jenis LEFT JOIN soal ON soal.id_sub=sub_jenis.id_sub WHERE sub_jenis.jenjang=:jenjang GROUP BY sub_jenis.id_sub";
            $this->db->query($query);
            $this->db->bind("jenjang", $jenjang);
            $this->db->execute();
            return $this->db->resultSet();
        }
    }

    public function countIdSoalByToken($token)
    {
        // if ($jenjang != null) {
        $query = "SELECT sub_jenis.id_sub as id_sub, sub, jenjang, COUNT(soal.id_soal) as n_soal, waktu FROM tokensoal, dt_token, soal, sub_jenis, jenis_soal 
            WHERE soal.id_sub=sub_jenis.id_sub and dt_token.id_token=tokensoal.id_token and tokensoal.id_soal=soal.id_soal and dt_token.token=:token and sub_jenis.id_jenis=jenis_soal.id_jenis 
            GROUP BY sub_jenis.id_sub order BY sub_jenis.id_sub ASC, tokensoal.id_tokensoal ASC";
        $this->db->query($query);
        $this->db->bind("token", $token);
        $this->db->execute();
        return $this->db->resultSet();
        // }
    }

    public function countByToken($token, $id_sub)
    {
        if ($token != null) {
            $query = "SELECT COUNT(soal.id_soal) as n_soal FROM tokensoal, dt_token, soal, sub_jenis where soal.id_sub=sub_jenis.id_sub and dt_token.id_token=tokensoal.id_token and tokensoal.id_soal=soal.id_soal and dt_token.token=:token and sub_jenis.id_sub=:id_sub";
            $this->db->query($query);
            $this->db->bind("token", $token);
            $this->db->bind("id_sub", $id_sub);
            return $this->db->single();
        }
    }

    public function truncateByIdSub($id_sub)
    {
        $query = "DELETE FROM `soal` WHERE id_sub=:id_sub";
        $this->db->query($query);
        $this->db->bind('id_sub', $id_sub);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function uploadExcelSoal($file_excel)
    {
        include 'excel_reader2.php';

        if (isset($file_excel['file']['name']) && $file_excel['file']['type'] == 'application/vnd.ms-excel') {
            $target = basename($file_excel['file']['name']);
            move_uploaded_file($file_excel['file']['tmp_name'], __DIR__ . "/../file-upload/" . $file_excel['file']['name']);

            chmod(__DIR__ . "/../file-upload/" . $file_excel['file']['name'], 0777);
            $data = new Spreadsheet_Excel_Reader(__DIR__ . "/../file-upload/" . $file_excel['file']['name'], false);
            $jumlah_baris = $data->rowcount($sheet_index = 0);
            $berhasil = 0;
            for ($i = 2; $i <= $jumlah_baris; $i++) {
                $id_sub = $data->val($i, 1);
                $isi = $data->val($i, 2);
                $file = $data->val($i, 3);
                $true = $data->val($i, 4);
                $pil_a = $data->val($i, 5);
                $score_a = $data->val($i, 6);
                $pil_b = $data->val($i, 7);
                $score_b = $data->val($i, 8);
                $pil_c = $data->val($i, 9);
                $score_c = $data->val($i, 10);
                $pil_d = $data->val($i, 11);
                $score_d = $data->val($i, 12);
                $pil_e = $data->val($i, 13);
                $score_e = $data->val($i, 14);

                echo  $id_sub . ", " . $isi . ", " . $file . ", " . $true . ", " .
                    $pil_a . ", " . $score_a . ", " . $pil_b . ", " . $score_b . ", " .
                    $pil_c . ", " . $score_c . ", " . $pil_d . ", " . $score_d . ", " .
                    $pil_e . ", " . $score_e;
                echo "<br>";
                if (
                    $id_sub != null && $isi != null && $true != null &&
                    $pil_a != null && $score_a != null && $pil_b != null && $score_b != null &&
                    $pil_c != null && $score_c != null && $pil_d != null && $score_d != null &&
                    $pil_e != null && $score_e != null
                ) {
                    $query = 'INSERT INTO ' . $this->table . '(id_sub, isi, file, `true` , pil_a, score_a, pil_b, score_b, pil_c, score_c, pil_d, score_d, pil_e, score_e) 
                VALUES (:id_sub, :isi, :file, :true, :pil_a, 
                :score_a, :pil_b, :score_b, :pil_c, :score_c, :pil_d, :score_d, :pil_e, :score_e)';
                    $this->db->query($query);
                    $this->db->bind("id_sub", $id_sub);
                    $this->db->bind("isi", $isi);
                    $this->db->bind("file", $file);
                    $this->db->bind("true", $true);
                    $this->db->bind("pil_a", $pil_a);
                    $this->db->bind("score_a", $score_a);
                    $this->db->bind("pil_b", $pil_b);
                    $this->db->bind("score_b", $score_b);
                    $this->db->bind("pil_c", $pil_c);
                    $this->db->bind("score_c", $score_c);
                    $this->db->bind("pil_d", $pil_d);
                    $this->db->bind("score_d", $score_d);
                    $this->db->bind("pil_e", $pil_e);
                    $this->db->bind("score_e", $score_e);
                    $this->db->execute();
                }
            }
            unlink(__DIR__ . "/../file-upload/" . $file_excel['file']['name']);
        } else {
            return false;
        }
        return $this->db->rowCount();
    }

    public function riwayat($token = null)
    {
        if ($token != null) {
            $query = "SELECT jawaban.id_jawaban, jawaban.jawab, jawaban.tanggal, dt_token.token, user.id_user, user.email, soal.id_soal as id_soal, soal.id_sub as id_sub, soal.isi as isi, soal.file as file, soal.true as 'true', soal.pil_a as pil_a, soal.pil_b as pil_b, soal.pil_c as pil_c, soal.pil_d as pil_d, soal.pil_e as pil_e, soal.score_a as score_a, soal.score_b as score_b, soal.score_c as score_c, soal.score_d as score_d, soal.score_e as score_e, sub, jenjang, waktu, jenis_soal.nm_jenis as nm_jenis 
        FROM jawaban, sub_jenis, soal, user, tokensoal, dt_token, jenis_soal WHERE jawaban.id_user=user.id_user AND jawaban.id_tokensoal=tokensoal.id_tokensoal AND tokensoal.id_token=dt_token.id_token AND tokensoal.id_soal=soal.id_soal AND soal.id_sub=sub_jenis.id_sub AND sub_jenis.id_jenis=jenis_soal.id_jenis AND dt_token.token=:token ORDER by tanggal DESC";
            $this->db->query($query);
            $this->db->bind('token', $token);
            return $this->db->resultSet();
        } else {
            $query = "SELECT jawaban.id_jawaban, jawaban.jawab, jawaban.tanggal, dt_token.token, user.id_user, user.email, soal.id_soal as id_soal, soal.id_sub as id_sub, soal.isi as isi, soal.file as file, soal.true as 'true', soal.pil_a as pil_a, soal.pil_b as pil_b, soal.pil_c as pil_c, soal.pil_d as pil_d, soal.pil_e as pil_e, soal.score_a as score_a, soal.score_b as score_b, soal.score_c as score_c, soal.score_d as score_d, soal.score_e as score_e, sub, jenjang, waktu, jenis_soal.nm_jenis as nm_jenis 
        FROM jawaban, sub_jenis, soal, user, tokensoal, dt_token, jenis_soal WHERE jawaban.id_user=user.id_user AND jawaban.id_tokensoal=tokensoal.id_tokensoal AND tokensoal.id_token=dt_token.id_token AND tokensoal.id_soal=soal.id_soal AND soal.id_sub=sub_jenis.id_sub AND sub_jenis.id_jenis=jenis_soal.id_jenis ORDER by tanggal DESC";
            $this->db->query($query);
            return $this->db->resultSet();
        }
    }

    public function detailRiwayat($id_user, $token)
    {
        $query = "SELECT COUNT(sub_jenis.id_sub) as n_id_sub, jawaban.id_jawaban, jawaban.jawab, jawaban.tanggal, dt_token.token, user.id_user, user.email, soal.id_soal as id_soal, soal.id_sub as id_sub, soal.isi as isi, soal.file as file, soal.true as 'true', soal.pil_a as pil_a, soal.pil_b as pil_b, soal.pil_c as pil_c, soal.pil_d as pil_d, soal.pil_e as pil_e, soal.score_a as score_a, soal.score_b as score_b, soal.score_c as score_c, soal.score_d as score_d, soal.score_e as score_e, sub, jenjang, waktu, jenis_soal.nm_jenis as nm_jenis FROM jawaban, sub_jenis, soal, user, tokensoal, dt_token, jenis_soal 
        WHERE jawaban.id_user=user.id_user AND jawaban.id_tokensoal=tokensoal.id_tokensoal AND tokensoal.id_token=dt_token.id_token AND tokensoal.id_soal=soal.id_soal AND soal.id_sub=sub_jenis.id_sub AND sub_jenis.id_jenis=jenis_soal.id_jenis AND user.id_user=:id_user and dt_token.token=:token
        GROUP BY sub_jenis.sub ORDER by tanggal DESC";
        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        $this->db->bind('token', $token);
        return $this->db->resultSet();
    }

    public function getTokenInJawaban()
    {
        $query = "SELECT DISTINCT dt_token.token FROM jawaban, sub_jenis, soal, user, tokensoal, dt_token, jenis_soal WHERE jawaban.id_user=user.id_user AND jawaban.id_tokensoal=tokensoal.id_tokensoal AND tokensoal.id_token=dt_token.id_token AND tokensoal.id_soal=soal.id_soal AND soal.id_sub=sub_jenis.id_sub AND sub_jenis.id_jenis=jenis_soal.id_jenis ORDER by tanggal DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getUserInJawaban()
    {
        $query = "SELECT DISTINCT user.id_user FROM jawaban, sub_jenis, soal, user, tokensoal, dt_token, jenis_soal WHERE jawaban.id_user=user.id_user AND jawaban.id_tokensoal=tokensoal.id_tokensoal AND tokensoal.id_token=dt_token.id_token AND tokensoal.id_soal=soal.id_soal AND soal.id_sub=sub_jenis.id_sub AND sub_jenis.id_jenis=jenis_soal.id_jenis ORDER by tanggal DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function _getRiwayatById($id_user, $token)
    {
        $query = "SELECT jawaban.id_jawaban, jawaban.jawab, jawaban.tanggal, dt_token.token, user.id_user, user.email, soal.id_soal as id_soal, soal.id_sub as id_sub, soal.isi as isi, soal.file as file, soal.true as 'true', soal.pil_a as pil_a, soal.pil_b as pil_b, soal.pil_c as pil_c, soal.pil_d as pil_d, soal.pil_e as pil_e, soal.score_a as score_a, soal.score_b as score_b, soal.score_c as score_c, soal.score_d as score_d, soal.score_e as score_e, sub, jenjang, waktu, jenis_soal.nm_jenis as nm_jenis FROM jawaban, sub_jenis, soal, user, tokensoal, dt_token, jenis_soal
        WHERE jawaban.id_user=user.id_user AND jawaban.id_tokensoal=tokensoal.id_tokensoal AND tokensoal.id_token=dt_token.id_token AND tokensoal.id_soal=soal.id_soal AND soal.id_sub=sub_jenis.id_sub AND sub_jenis.id_jenis=jenis_soal.id_jenis AND user.id_user=:id_user AND dt_token.token=:token ORDER by tanggal DESC";
        $this->db->query($query);
        $this->db->bind('token', $token);
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }

    public function getHistoriByUsername($id_user, $token, $username)
    {
        $query = "SELECT jawaban.id_jawaban, jawaban.jawab, jawaban.tanggal, dt_token.token, user.id_user, user.email, soal.id_soal as id_soal, soal.id_sub as id_sub, soal.isi as isi, soal.file as file, soal.true as 'true', soal.pil_a as pil_a, soal.pil_b as pil_b, soal.pil_c as pil_c, soal.pil_d as pil_d, soal.pil_e as pil_e, soal.score_a as score_a, soal.score_b as score_b, soal.score_c as score_c, soal.score_d as score_d, soal.score_e as score_e, sub, jenjang, waktu, jenis_soal.nm_jenis as nm_jenis FROM jawaban, sub_jenis, soal, user, tokensoal, dt_token, jenis_soal
        WHERE jawaban.id_user=user.id_user AND jawaban.id_tokensoal=tokensoal.id_tokensoal AND tokensoal.id_token=dt_token.id_token AND tokensoal.id_soal=soal.id_soal AND soal.id_sub=sub_jenis.id_sub AND sub_jenis.id_jenis=jenis_soal.id_jenis AND user.id_user=:id_user AND dt_token.token=:token AND user.username=:username ORDER by tanggal DESC";
        $this->db->query($query);
        $this->db->bind('token', $token);
        $this->db->bind('id_user', $id_user);
        $this->db->bind('username', $username);
        return $this->db->resultSet();
    }

    public function tampilSoalByToken($token, $id_sub = null)
    {
        if ($id_sub == null) {

            $query = "SELECT tokensoal.id_tokensoal, tokensoal.id_token, dt_token.token, soal.id_soal, soal.id_sub as id_sub, 
            soal.isi as isi, soal.file as file, soal.true as 'true', soal.pil_a as pil_a, soal.pil_b as pil_b, soal.pil_c as 
            pil_c, soal.pil_d as pil_d, soal.pil_e as pil_e, soal.score_a as score_a, soal.score_b as score_b, soal.score_c as 
            score_c, soal.score_d as score_d, soal.score_e as score_e, sub, jenjang, waktu, nm_jenis FROM tokensoal, dt_token, soal, 
            sub_jenis, jenis_soal WHERE soal.id_sub=sub_jenis.id_sub and dt_token.id_token=tokensoal.id_token and 
            tokensoal.id_soal=soal.id_soal and sub_jenis.id_jenis=jenis_soal.id_jenis and dt_token.token=:token order BY sub_jenis.id_sub ASC, tokensoal.id_tokensoal ASC";
            $this->db->query($query);
            $this->db->bind("token", $token);
            return $this->db->resultSet();
        } else {
            $query = "SELECT tokensoal.id_tokensoal, tokensoal.id_token, dt_token.token, soal.id_soal, soal.id_sub as id_sub, 
                        soal.isi as isi, soal.file as file, soal.true as 'true', soal.pil_a as pil_a, soal.pil_b as pil_b, soal.pil_c as 
                        pil_c, soal.pil_d as pil_d, soal.pil_e as pil_e, soal.score_a as score_a, soal.score_b as score_b, soal.score_c as 
                        score_c, soal.score_d as score_d, soal.score_e as score_e, sub, jenjang, waktu, nm_jenis FROM tokensoal, dt_token, soal, 
                        sub_jenis, jenis_soal WHERE soal.id_sub=sub_jenis.id_sub and dt_token.id_token=tokensoal.id_token and 
                        tokensoal.id_soal=soal.id_soal and sub_jenis.id_jenis=jenis_soal.id_jenis and dt_token.token=:token 
                        and sub_jenis.id_sub=:id_sub order BY sub_jenis.id_sub ASC, tokensoal.id_tokensoal ASC";
            $this->db->query($query);
            $this->db->bind("token", $token);
            $this->db->bind("id_sub", $id_sub);
            return $this->db->resultSet();
        }
    }
    public function tampilSubByToken($token)
    {
        $query = "SELECT sub_jenis.id_sub as id_sub, sub, jenjang, waktu, nm_jenis FROM tokensoal, dt_token, soal, sub_jenis, jenis_soal WHERE 
        soal.id_sub=sub_jenis.id_sub and dt_token.id_token=tokensoal.id_token and tokensoal.id_soal=soal.id_soal and dt_token.token=:token and sub_jenis.id_jenis=jenis_soal.id_jenis 
        GROUP BY sub_jenis.id_sub order BY sub_jenis.id_sub ASC, tokensoal.id_tokensoal ASC";
        $this->db->query($query);
        $this->db->bind("token", $token);
        // $this->db->bind("jenjang", $data['jenjang']);
        // $this->db->execute();
        // return $this->db->resultSet();
        return $this->db->resultSet();
    }
}
