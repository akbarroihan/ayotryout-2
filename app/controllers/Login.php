<?php

class Login extends Controller
{
    public function index()
    {
        $data['judul'] = 'Login';
        $this->view('templates/header', $data);
        $this->view('login/index');
    }

    public function cekLogin()
    {
        if (isset($_POST['form-login'])) {
            if ($hasil = $this->model('User_model')->login_search($_POST)) {
                $_SESSION['login'] = true;
                $_SESSION['username'] = $hasil['username'];
                $_SESSION['email'] = $hasil['email'];
                $_SESSION['telepon'] = $hasil['telepon'];
                $_SESSION['level'] = $hasil['level'];
                $_SESSION['konfirmasi'] = $hasil['konfirmasi'];
                if ($hasil = $this->model('User_model')->token_search($_POST)) {
                    $_SESSION['token'] = $hasil['token'];
                    if($_SESSION['level'] == 'admin' && $_SESSION['konfirmasi'] == '1' && $_SESSION['token'] == '55555'){
                        header('Location: '. BASEURL.'/admin');
                    
                    } else if($hasil = $this->model('User_model')->token_search_jenjang($_POST)){
                        $_SESSION['token'] = $hasil['token'];
                        $_SESSION['jenjang'] = $hasil['jenjang'];

                        if($_SESSION['level'] == 'user' && $_SESSION['konfirmasi'] == '1' && $_SESSION['token'] != '55555' && $_SESSION['jenjang'] == 'SD'){
                            header('Location: '. BASEURL.'/user/sd');
                        
                        } else if($_SESSION['level'] == 'user' && $_SESSION['konfirmasi'] == '1' && $_SESSION['token'] != '55555' && $_SESSION['jenjang'] == 'SMU'){
                            header('Location: '. BASEURL.'/user/smu');
                        
                        
                        } else if($_SESSION['level'] == 'user' && $_SESSION['konfirmasi'] == '1' && $_SESSION['token'] != '55555' && $_SESSION['jenjang'] == 'STAN'){
                            header('Location: '. BASEURL.'/user/stan');
                        
                        
                        } else{
                            $_SESSION['login'] = false;
                            Flasher::setFlash('Gagal', 'Login', 'warning');
                            header('Location: '. BASEURL.'/login');
                            exit;
                        }
                        
                    } else{
                        $_SESSION['login'] = false;
                        Flasher::setFlash('Gagal', 'Login', 'warning');
                        header('Location: '. BASEURL.'/login');
                        exit;
                    }
                } else {
                $_SESSION['login'] = false;
                Flasher::setFlash('Gagal', 'Login', 'warning');
                header('Location: '. BASEURL.'/login');
                }
            } else {
                $_SESSION['login'] = false;
                Flasher::setFlash('Gagal', 'Login', 'warning');
                header('Location: '. BASEURL.'/login');
            }
        } else {
            $this->view('templates/500');
        }
        // var_dump($_POST);
    }
    public function logout()
    {
        session_destroy();
        session_unset();
        header('Location: '.BASEURL.'/login');
    }
}
