<?php

class User extends Controller
{
    private $sd;
    private $sma;
    private $stan;

    public function __construct()
    {
        //ini barisnya kamal
        if (!($_SESSION['login'] == true) or !(strtolower($_SESSION['level']) == 'user')) {
            header('Location: ' . BASEURL . '/login');
        }
    }


    public function mulai_ujian()
    {
        if (isset($_POST['id_sub'])) {
            $id_sub = $_POST['id_sub'];
            $this->tampil_flyer($id_sub);
        } else {
            $this->view('templates/500');
        }
    }
    public function _startUserSession()
    {
        //cookies : started-at: , started: , sub: , 
        // if(isset($_POST['mulai_ujian']) && isset($_POST['id_sub'])){
        //     //set cookies pengerjaan soal
        //     // if isset belum ada dan jawaban belum ke kunci, maka ditambahkan
        //     date_default_timezone_set('Asia/Bangkok');
        //     $id_sub = $_POST['id_sub'];
        //     $get_date = date('Y-m-d H:i:s', time());
        //     $waktu_mulai = $get_date;
        //     $key = "ayotryout2020";
        //     $cipher = "aes-128-gcm";
        //     $ivlen = openssl_cipher_iv_length($cipher);
        //     $iv = hash('sha256', $key);
        //     $waktu_mulai_encrypt = openssl_encrypt($waktu_mulai, $cipher, $key, $options = 0, $iv, $tag);
        //     $tag_encode = base64_encode($tag);

        //     setcookie("_ts", $waktu_mulai_encrypt, time() + (86400 * 7), "/");
        //     //_ss = start status / apakah ujian sudah dimulai atau belum (yes/no)
        //     setcookie("_ss", true, time() + (86400 * 7), "/");
        //     setcookie("_tag", $tag_encode, time() + (86400 * 7), "/");
        //     setcookie("_ids", $id_sub, time() + (86400 * 7), "/");
        //     // header('Location: ' . BASEURL . '/user/welcome');
        // } else if(isset($_POST['id_sub'])) {
        //     header('Location: ' . BASEURL . '/user/ujian');
        // }
    }

    public function tampil_flyer($id_sub)
    {
        if (isset($_POST['id_sub'])) {
            $data['id_sub'] = $id_sub;
            $data['data_sub'] = $this->model('Sub_jenis_model')->getById($data['id_sub']);
            $this->view('user/templates/header');
            $this->view('user/flyer', $data);
            $this->view('user/templates/footer');
        } else {
            $this->view('templates/500');
        }
    }

    public function selesai_ujian()
    {
    }
    public function ujian()
    {
        //Memulai ujian
        $this->_startUserSession();

        //Konfigurasi ujian
        if (isset($_POST['id_sub'])) {

            $token = $_SESSION['token'];
            $email = $_SESSION['email'];
            $id_sub = $_POST['id_sub'];
            $data['current_id_sub'] = $id_sub;
            $data['list_soal'] = $this->model('Soal_model')->tampilSoalByToken($token, $id_sub);
            $data['id_sub'] = $_POST['id_sub'];
            // $data['curr_soal'] = $data['list_soal']
            if (isset($_POST['next_soal']) && isset($_POST['current_index_soal'])) {
                //soal selanjutnya..
                $current_index_soal = $_POST['current_index_soal'] + 1;
                $next_index_soal = $current_index_soal + 1;
                $prev_index_soal = $current_index_soal - 1;
                if (isset($data['list_soal'][$next_index_soal]) and !isset($data['list_soal'][$prev_index_soal])) {
                    // Tidak ada tombol sebelumnya

                    $data['next_soal'] = true;
                    $data['prev_soal'] = false;
                    $data['current_soal'] = $data['list_soal'][$current_index_soal];
                    $data['current_index_soal'] = $current_index_soal;
                    $data['list_sub'] = $this->model('Soal_model')->tampilSubByToken($token);
                    $data['terjawab'] = $this->model('Jawaban_model')->getByEmail($email);
                    $this->view('user/templates/header');
                    $this->view('user/ujian', $data);
                    $this->view('user/templates/footer');
                } else if (isset($data['list_soal'][$next_index_soal]) and isset($data['list_soal'][$prev_index_soal])) {
                    //Ada tombol selanjutnya dan sebelumnya

                    $data['next_soal'] = true;
                    $data['prev_soal'] = true;
                    $data['current_soal'] = $data['list_soal'][$current_index_soal];
                    $data['current_index_soal'] = $current_index_soal;
                    $data['list_sub'] = $this->model('Soal_model')->tampilSubByToken($token);
                    $data['terjawab'] = $this->model('Jawaban_model')->getByEmail($email);
                    $this->view('user/templates/header');
                    $this->view('user/ujian', $data);
                    $this->view('user/templates/footer');
                } else if (!isset($data['list_soal'][$next_index_soal]) and isset($data['list_soal'][$prev_index_soal])) {
                    //Tidak ada tombol selanjutnya atau last soal
                    // echo "usu";
                    $data['next_soal'] = false;
                    $data['prev_soal'] = true;
                    $data['submit'] = true;
                    $data['current_soal'] = $data['list_soal'][$current_index_soal];
                    $data['current_index_soal'] = $current_index_soal;
                    $data['list_sub'] = $this->model('Soal_model')->tampilSubByToken($token);
                    $data['terjawab'] = $this->model('Jawaban_model')->getByEmail($email);
                    $this->view('user/templates/header');
                    $this->view('user/ujian', $data);
                    $this->view('user/templates/footer');
                }
            } else if (isset($_POST['prev_soal']) && isset($_POST['current_index_soal'])) {
                if ($_POST['current_index_soal'] == 1) {
                    // Kembali ke halaman awal
                    $current_index_soal = 0;
                    $data['current_soal'] = $data['list_soal'][$current_index_soal];
                    $data['next_soal'] = true;
                    $data['prev_soal'] = false;
                    $data['current_index_soal'] = $current_index_soal;
                    $data['list_sub'] = $this->model('Soal_model')->tampilSubByToken($token);
                    $data['terjawab'] = $this->model('Jawaban_model')->getByEmail($email);
                    $this->view('user/templates/header');
                    $this->view('user/ujian', $data);
                    $this->view('user/templates/footer');
                } else {
                    // Kembali ke halaman yang > halaman 1
                    $current_index_soal = $_POST['current_index_soal'] - 1;
                    $data['current_soal'] = $data['list_soal'][$current_index_soal];
                    $data['next_soal'] = true;
                    $data['prev_soal'] = true;
                    $data['current_index_soal'] = $current_index_soal;
                    $data['list_sub'] = $this->model('Soal_model')->tampilSubByToken($token);
                    $data['terjawab'] = $this->model('Jawaban_model')->getByEmail($email);
                    $this->view('user/templates/header');
                    $this->view('user/ujian', $data);
                    $this->view('user/templates/footer');
                }
                // } else if(isset($_POST['awal_soal'])) {
            } else if (isset($_POST['first_soal'])) {
                // $prev_index_soal = $current_index_soal - 1;

                $current_index_soal = 0;
                $next_index_soal = $current_index_soal + 1;
                if (isset($data['list_soal'][$next_index_soal])) {
                    //terdapat soal selanjutnya
                    $data['current_soal'] = $data['list_soal'][$current_index_soal];
                    $data['next_soal'] = true;
                    $data['prev_soal'] = false;
                    $data['current_index_soal'] = $current_index_soal;
                    $data['list_sub'] = $this->model('Soal_model')->tampilSubByToken($token);
                    $data['terjawab'] = $this->model('Jawaban_model')->getByEmail($email);
                    $this->view('user/templates/header');
                    $this->view('user/ujian', $data);
                    $this->view('user/templates/footer');
                } else {
                    // tidak terdapat soal selanjutnya
                    $data['current_soal'] = $data['list_soal'][$current_index_soal];
                    $data['next_soal'] = false;
                    $data['prev_soal'] = false;
                    $data['submit'] = true;
                    $data['current_index_soal'] = $current_index_soal;
                    $data['list_sub'] = $this->model('Soal_model')->tampilSubByToken($token);
                    $data['terjawab'] = $this->model('Jawaban_model')->getByEmail($email);
                    $this->view('user/templates/header');
                    $this->view('user/ujian', $data);
                    $this->view('user/templates/footer');

                }
            } else if (isset($_POST['select_soal'])) {
                $current_index_soal = $_POST['current_index_soal'];
                $next_index_soal = $current_index_soal + 1;
                $prev_index_soal = $current_index_soal - 1;
                if (isset($data['list_soal'][$next_index_soal]) and !isset($data['list_soal'][$prev_index_soal])) {
                    // Tidak ada tombol sebelumnya

                    $data['next_soal'] = true;
                    $data['prev_soal'] = false;
                    $data['current_soal'] = $data['list_soal'][$current_index_soal];
                    $data['current_index_soal'] = $current_index_soal;
                    $data['list_sub'] = $this->model('Soal_model')->tampilSubByToken($token);
                    $data['terjawab'] = $this->model('Jawaban_model')->getByEmail($email);
                    $this->view('user/templates/header');
                    $this->view('user/ujian', $data);
                    $this->view('user/templates/footer');
                } else if (isset($data['list_soal'][$next_index_soal]) and isset($data['list_soal'][$prev_index_soal])) {
                    //Ada tombol selanjutnya dan sebelumnya

                    $data['next_soal'] = true;
                    $data['prev_soal'] = true;
                    $data['current_soal'] = $data['list_soal'][$current_index_soal];
                    $data['current_index_soal'] = $current_index_soal;
                    $data['list_sub'] = $this->model('Soal_model')->tampilSubByToken($token);
                    $data['terjawab'] = $this->model('Jawaban_model')->getByEmail($email);
                    $this->view('user/templates/header');
                    $this->view('user/ujian', $data);
                    $this->view('user/templates/footer');
                } else if (!isset($data['list_soal'][$next_index_soal]) and isset($data['list_soal'][$prev_index_soal])) {
                    //Tidak ada tombol selanjutnya atau last soal
                    // echo "usu";
                    $data['next_soal'] = false;
                    $data['prev_soal'] = true;
                    $data['submit'] = true;
                    $data['current_soal'] = $data['list_soal'][$current_index_soal];
                    $data['current_index_soal'] = $current_index_soal;
                    $data['list_sub'] = $this->model('Soal_model')->tampilSubByToken($token);
                    $data['terjawab'] = $this->model('Jawaban_model')->getByEmail($email);
                    $this->view('user/templates/header');
                    $this->view('user/ujian', $data);
                    $this->view('user/templates/footer');
                }
            } else {
                $this->view('templates/500');
            }
            // var_dump($data['list_soal']);
        } else {
            $this->view('templates/500');
        }
    }
    public function index()
    {

        // if ($param != null) {
        // Get sub soal by token 
        $token = $_SESSION['token'];
        $data['data_sub'] = $this->model('Soal_model')->tampilSubByToken($token);
        // Get count id sub by token
        $data['count_soal'] = $this->model('Soal_model')->countIdSoalByToken($token);
        $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
        $this->view('user/templates/header', $data);
        $this->view('user/index', $data);
        $this->view('user/templates/footer');
        // $data['kombinasi_jenis_soal'] = $this->model('Sub_jenis_model')->getSubJenisLengkapByJenjang($token);
        // }
        //  else {
        //     $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
        //     $data['jenjang'] = $this->model('Sub_jenis_model')->getJenjang();
        //     $this->view('user/templates/header', $data);
        //     $this->view('user/index', $data);
        //     $this->view('user/templates/footer');
        // }
    }


    public function profil()
    {
        $this->view('user/templates/header');
        $this->view('user/detail_profil');
        $this->view('user/templates/footer');
    }

    public function getDetail()
    {
        echo json_encode($this->model('User_model')->getById($_POST['id']));
    }
    
    public function histori($action = null, $id_user = null, $token = null)
    {
        if ($action == null && $id_user == null && $token == null) {
        $data['data_riwayat'] = $this->_histori();
        $data['jenjang_navbar'] = $this->model('Sub_jenis_model')->getJenjang();
        $this->view('user/templates/header');
        $this->view('user/histori', $data);
        $this->view('user/templates/footer');
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

    public function _histori()
    {
        $data_temp['data_token'] = $this->model('Soal_model')->getTokenInJawaban();
        $data_temp['data_id_user'] = $this->model('Soal_model')->getUserInJawaban();
        $data['data_riwayat'] = array();
        foreach ($data_temp['data_token'] as $riwayat) {
            foreach ($data_temp['data_id_user'] as $user) {
                $id_user = $user['id_user'];
                $token = $riwayat['token'];
                // $username = $user['username']
                $data_temp['data_user'] = $this->model('User_model')->getById($id_user);
                $username = $_SESSION['username'];
                if ($data_temp['mix'] = $this->model('Soal_model')->getHistoriByUsername($id_user, $token, $username)) {

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
                        "sub" => $mix['sub'],
                        "nm_jenis" => $mix['nm_jenis'],
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


//Ini barisnya kiky