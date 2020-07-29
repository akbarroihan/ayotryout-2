<?php

class Admin extends Controller
{
    private $sd;
    private $sma;
    private $stan;

    public function __construct()
    {
        if (!($_SESSION['login'] == true) or !(strtolower($_SESSION['level']) == 'admin')) {
            header('Location: ' . BASEURL . '/login');
        }
    }

    public function soal($id_sub = null, $action = null, $id_soal = null)
    {
        if ($this->model('Sub_jenis_model')->getById($id_sub) > 0) {
            if (strtolower($action) == 'i') {
                // tampilkan halaman tambah soal
                if (!is_null($id_sub)) {
                    $data['type'] = 'tambah';
                    $data['data_sub'] = $this->model('Sub_jenis_model')->getById($id_sub);
                    $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
                    $this->view('admin/templates/header', $data);
                    $this->view('admin/set_soal', $data);
                    $this->view('admin/templates/footer');
                } else {
                    $this->view('templates/404');
                }
            } else if (strtolower($action) == 'truncate-all') {
                $master = $this->model('Sub_jenis_model')->getById($id_sub);
                $jenjang = $master['jenjang'];
                if ($this->model('Soal_model')->truncateByIdSub($id_sub) > 0) {
                    Flasher::setFlash('berhasil', 'dihapus', 'success');
                    header('Location: ' . BASEURL . '/admin/impor/' . $jenjang);
                    exit;
                } else {
                    Flasher::setFlash('berhasil', 'dihapus', 'success');
                    header('Location: ' . BASEURL . '/admin/impor/' . $jenjang);
                    exit;
                }
            } else if (strtolower($action) == 'u') {
                if (!is_null($id_sub) && !is_null($id_soal)) {
                    $data['type'] = 'ubah';
                    $data['data_soal'] = $this->model('Soal_model')->getById($id_soal);
                    $data['data_sub'] = $this->model('Sub_jenis_model')->getById($id_sub);
                    $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
                    $this->view('admin/templates/header', $data);
                    $this->view('admin/set_soal', $data);
                    $this->view('admin/templates/footer');
                } else {
                    $this->view('templates/404');
                }
            } else if (strtolower($action) == 'd') {
                $this->set_soal($action, $id_sub, $id_soal);
            } else if ($action == null) {
                $tampil_soal = $this->model('Soal_model')->tampil_soal_ByIdSub($id_sub);
                $data['jenis_soal'] = $this->model('Sub_jenis_model')->getById($id_sub);
                $data['soal'] = $tampil_soal;
                $data['jumlah_soal'] = count($tampil_soal);
                $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
                $this->view('admin/templates/header', $data);
                $this->view('admin/list_soal', $data);
                $this->view('admin/templates/footer');
            } else {
                $this->view('admin/templates/404');
            }
        } else {
            $this->view('templates/404');
        }
    }

    public function uploadExcel($jenjang = null)
    {
        if ($jenjang != null) {
            if (isset($_FILES['file']['name']) && $_FILES['file']['type'] == 'application/vnd.ms-excel') {
                if ($this->model('Soal_model')->uploadExcelSoal($_FILES)) {
                    Flasher::setFlash('.xls berhasil', 'diimpor', 'success');
                    header('Location: ' . BASEURL . '/admin/impor/' . $jenjang);
                    exit;
                } else {
                    Flasher::setFlash('.xls gagal', 'diimpor', 'warning');
                    header('Location: ' . BASEURL . '/admin/impor/' . $jenjang);
                    exit;
                }
            } else {
                Flasher::setFlash('gagal', 'diimpor, pastikan file anda memiliki format (.xls)', 'warning');
                header('Location: ' . BASEURL . '/admin/impor/' . $jenjang);
                exit;
                // $this->view('templates/500');
            }
        } else {
            $this->view('templates/404');
        }
    }

    public function impor($jenjang = null)
    {
        if ($jenjang != null) {
            $data['list_soal'] = $this->model('Soal_model')->countIdSubByJenjang($jenjang);
            $data['jenjang'] = $jenjang;
            $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
            $this->view('admin/templates/header', $data);
            $this->view('admin/impor', $data);
            $this->view('admin/templates/footer');
        } else if ($jenjang != null) {
            $this->view('admin/templates/404');
        }
    }

    public function token($jenjang = null, $action = null, $token = null)
    {
        if ($jenjang != null) {
            if ($action == 'detail' && $token != null) {
                $master = explode("=", $token);
                $data['type'] = 'list_soal_by_token';
                $data['token'] = $master[0];
                $id_sub = end($master);
                $data['jumlah_soal'] = $this->model('Soal_model')->countByToken($data['token'], $id_sub);
                $data['data_soal'] = $this->model('Soal_model')->getByToken($data['token'], $id_sub);
                $data['data_sub'] = $this->model('Sub_jenis_model')->getById($id_sub);
                $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
                $this->view('admin/templates/header', $data);
                $this->view('admin/list_soal', $data);
                $this->view('admin/templates/footer');
            } else if ($action == 'add-soal') {
                //tampil halaman list soal by token
                $data['type'] = 'tambah_by_token';
                $master = explode("=", $token);
                $token_asli = $master[0];
                $id_token = $this->model('Dt_token_model')->getId($token_asli)['id_token'];
                $id_sub = end($master);

                $data['token'] = array('id_token' => $id_token, 'token' => $master[0]);
                $data['jumlah_soal'] = $this->model('Soal_model')->countByToken($token_asli, $id_sub);
                $data['data_soal'] = $this->model('Soal_model')->getWhereNotIn($token_asli, $id_sub);
                $data['data_sub'] = $this->model('Sub_jenis_model')->getById($id_sub);
                $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
                $this->view('admin/templates/header', $data);
                $this->view('admin/set_soal', $data);
                $this->view('admin/templates/footer');
            } else if ($action == 'add-token') {
                $token_baru = bin2hex(openssl_random_pseudo_bytes(2));
                while ($this->model('Dt_token_model')->getId($token_baru) > 0) {
                    $token_baru = bin2hex(openssl_random_pseudo_bytes(2));
                }
                $token_baru = strtoupper($jenjang) . $token_baru;
                $token_baru = substr($token_baru, 0, 6);
                if ($this->model('Dt_token_model')->insert($token_baru)) {
                    Flasher::setFlash('token baru berhasil', 'ditambahkan', 'success');
                    header('Location: ' . BASEURL . '/admin/token/' . $jenjang);
                    exit;
                } else {
                    Flasher::setFlash('token baru gagal', 'ditambahkan', 'warning');
                    header('Location: ' . BASEURL . '/admin/token/' . $jenjang);
                    exit;
                }
            } else if ($action == 'd-ts') {
                $master = explode("=", $token);
                if (isset($master[0]) && isset($master[1]) && isset($master[2])) {
                    $token_asli = $master[0];
                    $id_token = $this->model('Dt_token_model')->getId($token_asli)['id_token'];
                    $id_sub = $master[1];
                    $id_tokensoal = $master[2];
                    if ($id_tokensoal != null) {
                        if ($this->model('Tokensoal_model')->delete($id_tokensoal) > 0) {
                            Flasher::setFlash('berhasil', 'dihapus', 'success');
                            header('Location: ' . BASEURL . '/admin/token/' . $jenjang . '/detail/' .  $token_asli . '=' . $id_sub);
                            exit;
                        } else {
                            Flasher::setFlash('gagal', 'dihapus', 'warning');
                            header('Location: ' . BASEURL . '/admin/token/' . $jenjang . '/detail/' .  $token_asli . '=' . $id_sub);
                            exit;
                        }
                    } else {
                        $this->view('templates/404');
                    }
                } else {
                    $this->view('templates/500');
                }
            } else if ($action == 'd-tn') {
                $id_token = $token;
                if (isset($id_token)) {
                    if ($id_token != null) {
                        if ($this->model('Dt_token_model')->delete($id_token) > 0) {
                            Flasher::setFlash('token berhasil', 'dihapus', 'success');
                            header('Location: ' . BASEURL . '/admin/token/' . $jenjang);
                            exit;
                        } else {
                            Flasher::setFlash('token gagal', 'dihapus', 'warning');
                            header('Location: ' . BASEURL . '/admin/token/' . $jenjang);
                            exit;
                        }
                    } else {
                        $this->view('templates/404');
                    }
                } else {
                    $this->view('templates/500');
                }
            } else if ($action == 'i') {
                //action insert data
                if (isset($_POST)) {
                    var_dump($_POST);
                    if ($this->model('Tokensoal_model')->insert($_POST)) {
                        Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                        header('Location: ' . BASEURL . '/admin/token/' . $jenjang . '/detail/' .  $token);
                        exit;
                    } else {
                        Flasher::setFlash('tidak ada yang', 'ditambahkan', 'success');
                        header('Location: ' . BASEURL . '/admin/token/' . $jenjang . '/detail/' .  $token);
                        exit;
                    }
                }
            } else {
                $data['data_tokensoal'] = $this->model('Dt_token_model')->getByJenjang($jenjang);
                $data['data_sub_jenis'] = $this->model('Sub_jenis_model')->getSubJenisLengkapByJenjang($jenjang);
                $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
                $data['jenjang'] = $jenjang;
                $this->view('admin/templates/header', $data);
                $this->view('admin/token', $data);
                $this->view('admin/templates/footer');
            }
        } else {
            $this->view('templates/404');
        }
    }

    public function pembahasan($perintah = null, $id = null)
    {
        if (!is_null($perintah)) {
            if ($perintah == 'i') {
                if ($this->model('Pembahasan_model')->insert($_POST, $_FILES)) {
                    $id_soal = $id;
                    $data = $this->model('Soal_model')->getById($id_soal);
                    Flasher::setFlash('pembahasan berhasil', 'ditambahkan', 'success');
                    header('Location: ' . BASEURL . '/admin/soal/' . $data['id_sub']);
                    exit;
                } else {
                    $this->view('templates/500');
                }
            } else if ($perintah == 'detail-u') {
                //Tampil dalam bentuk form 
                $id_bahas = $id;
                $data['data_pembahasan'] = $this->model('Pembahasan_model')->getById($id_bahas);
                $data['data_soal'] = $this->model('Soal_model')->getById($data['data_pembahasan']['id_soal']);
                $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
                $data['action'] = 'update';
                $this->view('admin/templates/header', $data);
                $this->view('admin/pembahasan', $data);
                $this->view('admin/templates/footer');
            } else if ($perintah == 'u' && $id != null) {
                $id_bahas = $id;
                if ($this->model('Pembahasan_model')->getById($id_bahas)) {
                    $data['data_pembahasan'] = $this->model('Pembahasan_model')->getById($id_bahas);
                    if (isset($_POST['ubah_pembahasan'])) {
                        if ($this->model('Pembahasan_model')->update($_POST, $_FILES) > 0) {
                            Flasher::setFlash('berhasil', 'diupdate', 'success');
                            header('Location: ' . BASEURL . '/admin/pembahasan/detail/' . $data['data_pembahasan']['id_soal']);
                            exit;
                        } else {
                            Flasher::setFlash('tidak ada yang', 'diupdate', 'warning');
                            header('Location: ' . BASEURL . '/admin/pembahasan/detail/' .  $data['data_pembahasan']['id_soal']);
                            exit;
                        }
                    } else {
                        Flasher::setFlash('gagal', 'diupdate', 'warning');
                        header('Location: ' . BASEURL . '/admin/pembahasan/detail/' .  $data['data_pembahasan']['id_soal']);
                        exit;
                    }
                }
            } else if ($perintah == 'dimg') {
                $id_bahas = $id;
                $data = $this->model('Pembahasan_model')->getById($id_bahas);
                if (isset($data['file'])) {
                    if ($this->model('Pembahasan_model')->_deleteImg($data['file'], $id_bahas) > 0) {
                        Flasher::setFlash('gambar berhasil', 'dihapus', 'success');
                        header('Location: ' . BASEURL . '/admin/pembahasan/detail-u/' . $id_bahas);
                        exit;
                    } else {
                        Flasher::setFlash('gambar gagal', 'dihapus', 'warning');
                        header('Location: ' . BASEURL . '/admin/pembahasan/detail-u/' . $id_bahas);
                        exit;
                    }
                } else {
                    Flasher::setFlash('gagal', 'dihapus', 'warning');
                    header('Location: ' . BASEURL . '/admin/pembahasan/detail-u/' . $id_bahas);
                    exit;
                }
            } else if ($perintah == 'detail') {
                $id_soal = $id;
                $data['data_pembahasan'] = $this->model('Pembahasan_model')->getByIdSoal($id_soal);
                $data['data_soal'] = $this->model('Soal_model')->getById($id_soal);
                if ($data['data_pembahasan']) {
                    $data['action'] = 'detail';
                    $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
                    $this->view('admin/templates/header', $data);
                    $this->view('admin/pembahasan', $data);
                    $this->view('admin/templates/footer');
                } else {
                    //Tampil dalam bentuk form 
                    $data['action'] = 'insert';
                    $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
                    $this->view('admin/templates/header', $data);
                    $this->view('admin/pembahasan', $data);
                    $this->view('admin/templates/footer');
                }
            } else {
                $this->view('templates/404');
            }
        } else {
            $this->view('templates/404');
        }
    }

    public function set_soal($perintah = null, $id_sub = null, $id_soal = null)
    {
        if ($perintah == 'i') {
            if (isset($_POST['tambah_soal'])) {
                if ($this->model('Soal_model')->insert($_POST, $_FILES) > 0) {
                    Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                    header('Location: ' . BASEURL . '/admin/soal/' . $id_sub);
                    exit;
                } else {
                    Flasher::setFlash('gagal', 'ditambahkan', 'warning');
                    header('Location: ' . BASEURL . '/admin/soal/' . $id_sub);
                    exit;
                }
            }
        } else if ($perintah == 'u') {
            if (isset($_POST['ubah_soal'])) {
                if ($this->model('Soal_model')->update($_POST, $_FILES) > 0) {
                    Flasher::setFlash('berhasil', 'diubah', 'success');
                    header('Location: ' . BASEURL . '/admin/soal/' . $id_sub);
                    exit;
                } else {
                    Flasher::setFlash('', 'tidak ada yang diubah', 'warning');
                    header('Location: ' . BASEURL . '/admin/soal/' . $id_sub);
                    exit;
                }
            }
        } else if ($perintah == 'd' and $id_soal != null) {
            if ($this->model('Soal_model')->delete($id_soal) > 0) {
                Flasher::setFlash('berhasil', 'dihapus', 'success');
                header('Location: ' . BASEURL . '/admin/soal/' . $id_sub);
            } else {
                Flasher::setFlash('gagal', 'dihapus', 'warning');
                header('Location: ' . BASEURL . '/admin/soal/' . $id_sub);
            }
        } else if ($perintah == 'dimg' and $id_soal != null) {
            $data = $this->model('Soal_model')->getById($id_soal);
            if (isset($data['file'])) {
                if ($this->model('Soal_model')->_deleteImg($data['file'], $id_soal) > 0) {
                    Flasher::setFlash('berhasil', 'dihapus', 'success');
                    header('Location: ' . BASEURL . '/admin/soal/' . $id_sub . '/u/' . $id_soal);
                    exit;
                } else {
                    Flasher::setFlash('gagal', 'dihapus', 'warning');
                    header('Location: ' . BASEURL . '/admin/soal/' . $id_sub . '/u/' . $id_soal);
                    exit;
                }
            } else {
                Flasher::setFlash('gagal', 'dihapus', 'warning');
                header('Location: ' . BASEURL . '/admin/soal/' . $id_sub . '/u/' . $id_soal);
                exit;
            }
        } else {
            $this->view('templates/404');
        }
    }

    // end of uji coba
    public function index($param = null)
    {
        if ($param != null) {
            $data['kombinasi_jenis_soal'] = $this->model('Sub_jenis_model')->getSubJenisLengkapByJenjang($param);
            $data['list_soal'] = $this->model('Soal_model')->countIdSubByJenjang($param);
            $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
            $this->view('admin/templates/header', $data);
            $this->view('admin/index', $data);
            $this->view('admin/templates/footer');
        } else {
            $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
            $data['jenjang'] = $this->model('Sub_jenis_model')->getJenjang();
            $this->view('admin/templates/header', $data);
            $this->view('admin/index', $data);
            $this->view('admin/templates/footer');
        }
    }

    public function profil()
    {

        $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
        $this->view('admin/templates/header', $data);
        $this->view('admin/detail_profil');
        $this->view('admin/templates/footer');
    }
    public function akun($action = null, $id_user = null)
    {
        if ($action == null && $id_user == null) {
            $hasil_user = $this->model('User_model')->getAll('user');
            $data['data_user'] = $hasil_user;
            $data['jumlah_user'] = count($hasil_user);
            $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
            $this->view('admin/templates/header', $data);
            $this->view('admin/list_profil', $data);
            $this->view('admin/templates/footer');
        } else if ($action == 'u') {
            if ($hasil_user = $this->model('User_model')->update($_POST) > 0) {
                Flasher::setFlash('berhasil', 'diubah', 'success');
                header('Location: ' . BASEURL . '/admin/akun');
                exit;
            } else {
                Flasher::setFlash('gagal', 'diubah', 'warning');
                header('Location: ' . BASEURL . '/admin/akun');
                exit;
            }
        } else if ($action == 'd' && $id_user != null) {
            if ($hasil_user = $this->model('User_model')->delete($id_user) > 0) {
                Flasher::setFlash('berhasil', 'dihapus', 'success');
                header('Location: ' . BASEURL . '/admin/akun');
                exit;
            } else {
                Flasher::setFlash('gagal', 'dihapus', 'warning');
                header('Location: ' . BASEURL . '/admin/akun');
                exit;
            }
        } else if ($action == 'c' && isset($_POST['cari_akun'])) {
            $hasil_user = $this->model('User_model')->search($_POST);
            if (count($hasil_user) > 0) {
                $data['data_user'] = $hasil_user;
                $hasil_user_all = $this->model('User_model')->getAll('user');

                $data['jumlah_user'] = count($hasil_user_all);

                $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
                $this->view('admin/templates/header', $data);
                $this->view('admin/list_profil', $data);
                $this->view('admin/templates/footer');
            } else {
                echo "<script>window.location.href='" . BASEURL . "/admin/akun';alert('Data tidak dapat ditemukan');</script>";
            }
        } else {
            $this->view('templates/404');
        }
    }

    public function getDetail()
    {
        echo json_encode($this->model('User_model')->getById($_POST['id']));
    }

    public function riwayat($action = null, $id_user = null, $token = null)
    {
        if ($action == null && $id_user == null && $token == null) {
            $data['data_riwayat'] = $this->_riwayat();
            $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
            $this->view('admin/templates/header', $data);
            $this->view('admin/riwayat', $data);
            $this->view('admin/templates/footer');
        } else if ($action == '_showDataUser') {
            $this->_showDataUser($id_user, $token);
        } else if ($action == "_showDataProgress"){
            $this->_showDataProgress($id_user, $token);
        }
    }

    public function _showDataProgress($id_user, $token){
        $data['data_riwayat'] = $this->model('Soal_model')->detailRiwayat($id_user, $token);
        if ($data['data_riwayat'] != null){
            $no = 1;
            foreach($data['data_riwayat'] as $riwayat){
                echo "<tr>
                <td> ".$no++."</td>";
                echo "<td>";
                if ($riwayat['sub'] != $riwayat['nm_jenis']) {
                    echo $riwayat['nm_jenis'] . " (" . $riwayat['sub'] . ")";
                } else {
                    echo $riwayat['nm_jenis'];
                }
                echo "</td>";
                echo "
                <td>".$riwayat['n_id_sub']."</td>
            </tr>";
            }
        }
    }
    public function _showDataUser($id_user, $token){
        $data['data_riwayat'] = $this->model('Soal_model')->detailRiwayat($id_user, $token);
            if($data['data_riwayat'] != null ){
                $data['data_user'] = $this->model('User_model')->getById($id_user);
                $email_user = $data['data_user']['email'];
                echo "<div class='row'>
                <h4 style='text-align: center;'>Data User</h4>
                </div>
                <div class='row'>
                <div class='col-sm-2'>
                <h4>Email
                </h4>
                </div>
                <div class='col-sm-5'>".$email_user."</div>
                </div>
                <div class='row'>
                <div class='col-sm-2'>
                <h4>Token
                </h4>
                </div>
                <div class='col-sm-5'>".$token."</div>
                </div>
                <br>";
            } 
    }
    public function _riwayat()
    {
        $data_temp['data_token'] = $this->model('Soal_model')->getTokenInJawaban();
        $data_temp['data_id_user'] = $this->model('Soal_model')->getUserInJawaban();
        $data['data_riwayat'] = array();
        foreach ($data_temp['data_token'] as $riwayat) {
            foreach ($data_temp['data_id_user'] as $user) {
                $id_user = $user['id_user'];
                $token = $riwayat['token'];
                $data_temp['data_user'] = $this->model('User_model')->getById($id_user);

                if ($data_temp['mix'] = $this->model('Soal_model')->_getRiwayatById($id_user, $token)) {

                    $benar = 0;
                    $salah = 0;

                    foreach ($data_temp['mix'] as $mix) {
                        if (strtolower($mix['true']) == strtolower($mix['jawab'])) {
                            $benar++;
                        } else {
                            $salah++;
                        }
                    }
                    array_push($data['data_riwayat'], array(
                        "id_user" => $id_user,
                        "username" => $data_temp['data_user']['username'],
                        "email" => $data_temp['data_user']['email'],
                        "benar" => $benar,
                        "salah" => $salah,
                        "token" => $token,
                        "tanggal" => $mix['tanggal']
                    ));
                }
            }
        }
        return $data['data_riwayat'];
    }
}
