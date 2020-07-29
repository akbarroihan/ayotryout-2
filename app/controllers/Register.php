<?php

class Register extends Controller{
    public function index(){
        $data['judul'] = 'Register';
        $this->view('templates/header', $data);
        $this->view('register/index');
        // $this->view('templates/footer');
    }

    public function cekregister()
    {
        // if(isset($_POST['form-register'])){
            // var_dump($_POST);
            if($_POST['password'] != $_POST['re-password']){
                Flasher::setFlash('Password', ' Tidak Sama', 'warning');
                header('Location:' .BASEURL. '/register');
                exit;
            }else if($hasil = $this->model('User_model')->login_search($_POST)){
                // $_SESSION['username'] = $hasil['username'];
                // $_SESSION['password'] = $hasil['password'];
                // if($_SESSION['username'] == ['username'] && ['password'] == ['password']){
                    Flasher::setFlash('Username dan Password Sudah', 'Terdaftar', 'warning');
                    header('Location:' .BASEURL. '/register');
                    exit;                
            }else if($this->model('User_model')->save($_POST) > 0 ){
                Flasher::setFlash('Berhasil', 'Terdaftar Silahkan menunggu konfirmasi dari kami', 'success');
                header('Location:' .BASEURL. '/register');
                exit;
            }
        // }
    }
}