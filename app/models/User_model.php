<?php
class User_model
{
    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll($level = null)
    {
        if(strtolower($level) == 'user'){
            $this->db->query("SELECT * FROM ".$this->table." WHERE level='user'");
            return $this->db->resultSet();
            
        } else if(strtolower($level) == 'admin'){
            $this->db->query("SELECT * FROM ".$this->table." WHERE level='admin'");
            return $this->db->resultSet();

        } else {
            $this->db->query("SELECT * FROM $this->table");
            return $this->db->resultSet();
        }
    }

    public function getById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_user=:id_user");
        $this->db->bind("id_user", $id);
        return $this->db->single();
    }
    public function login_search($data)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE BINARY username=:username AND password=:password ');
        $this->db->bind("username", $data['username']);
        $this->db->bind("password", $data['password']);
        return $this->db->single();
    }
    public function search($data)
    {
        $this->db->query("SELECT * FROM ".$this->table." WHERE level='user' and (username LIKE :username OR telepon LIKE :telepon OR email LIKE :email)");
        $this->db->bind("username", "%".$data['cari_akun']."%");
        $this->db->bind("telepon", "%".$data['cari_akun']."%");
        $this->db->bind("email", "%".$data['cari_akun']."%");
        return $this->db->resultSet();
    }

    public function save($data)
    {
        $query = 'INSERT INTO '.$this->table.' (email, telepon, username, password, level, konfirmasi) 
        VALUES (:email, :telepon, :username, :password, "user", 0)';
        $this->db->query($query);
        $this->db->bind("email", $data['email']);
        $this->db->bind("telepon", $data['telepon']);
        $this->db->bind("username", $data['username']);
        $this->db->bind("password", $data['password']);
        // $this->db->bind("level", $data['level']);
        // $this->db->bind("konfirmasi", $data['konfirmasi']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update($data)
    {
        $query = 'UPDATE '.$this->table.' SET email=:email, telepon=:telepon, username=:username, password=:password, konfirmasi=:konfirmasi WHERE id_user=:id_user';
        $this->db->query($query);
        $this->db->bind("email", $data['email']);
        $this->db->bind("telepon", $data['telepon']);
        $this->db->bind("username", $data['username']);
        $this->db->bind("password", $data['password']);
        // $this->db->bind("level", $data['level']);
        $this->db->bind("konfirmasi", $data['konfirmasi']);
        $this->db->bind("id_user", $data['id_user']);
        $this->db->execute();

        echo $data['email'];
        echo $data['telepon'];
        echo $data['username'];
        echo $data['password'];
        echo $data['konfirmasi'];
        echo "id_user";
        echo $data['id_user'];
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id_user=:id_user";
        $this->db->query($query);
        $this->db->bind("id_user", $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function token_search($data)
    {
        $this->db->query('SELECT * FROM dt_token WHERE BINARY token=:token');
        $this->db->bind("token", $data['token']);
        return $this->db->single();
    }
    public function token_search_jenjang($data)
    {
        $query = "SELECT tokensoal.id_tokensoal, tokensoal.id_token, dt_token.token, soal.id_soal, soal.id_sub as id_sub, 
            soal.isi as isi, soal.file as file, soal.true as 'true', soal.pil_a as pil_a, soal.pil_b as pil_b, soal.pil_c as 
            pil_c, soal.pil_d as pil_d, soal.pil_e as pil_e, soal.score_a as score_a, soal.score_b as score_b, soal.score_c as 
            score_c, soal.score_d as score_d, soal.score_e as score_e, sub, jenjang, waktu FROM tokensoal, dt_token, soal, 
            sub_jenis WHERE soal.id_sub=sub_jenis.id_sub and dt_token.id_token=tokensoal.id_token and 
            tokensoal.id_soal=soal.id_soal and dt_token.token=:token";
            $this->db->query($query);
            $this->db->bind("token", $data['token']);
            // $this->db->bind("jenjang", $data['jenjang']);
            $this->db->execute();
            // return $this->db->resultSet();
            return $this->db->single();
    }
}
