<?php
class Dt_token_model
{
    private $table = 'dt_token';
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
        $this->db->query("SELECT * FROM $this->table WHERE id_token=:id_token");
        $this->db->bind("id_token", $id);
        return $this->db->single();
    }
    public function getId($token)
    {
        $this->db->query("SELECT * FROM $this->table WHERE token=:token");
        $this->db->bind("token", $token);
        return $this->db->single();
    }

    public function getByJenjang($jenjang)
    {
        $this->db->query("SELECT * FROM $this->table where token LIKE :jenjang ");
        $this->db->bind('jenjang', $jenjang."%");
        return $this->db->resultSet();
    }

    public function insert($data)
    {
        $query = "INSERT INTO $this->table (token) VALUES (:token)";
        $this->db->query($query);
        $this->db->bind("token", $data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update($data)
    {
        $query = "UPDATE $this->table SET token=:token WHERE id_token=:id_token";
        $this->db->query($query);
        $this->db->bind("token", $data['token']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id_token=:id_token";
        $this->db->query($query);
        $this->db->bind("id_token", $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

}
