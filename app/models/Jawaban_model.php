<?php
class Jawaban_model
{
    private $table = 'jawaban';
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
        $this->db->query("SELECT * FROM $this->table WHERE id_jawaban=:id_jawaban");
        $this->db->bind("id_jawaban", $id);
        return $this->db->single();
    }

    public function save($data)
    {
        $query = "INSERT INTO $this->table (id_user, id_tokensoal, nosoal, jawab, tanggal) 
        VALUES (:id_user, :id_tokensoal, :nosoal, :jawab, :tanggal)";
        $this->db->query($query);
        $this->db->bind("id_user", $data['id_user']);
        $this->db->bind("id_tokensoal", $data['id_tokensoal']);
        $this->db->bind("nosoal", $data['nosoal']);
        $this->db->bind("jawab", $data['jawab']);
        $this->db->bind("tanggal", $data['tanggal']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update($data)
    {
        $query = "UPDATE $this->table SET id_user=:id_user, id_tokensoal=:id_tokensoal, nosoal=:nosoal, jawab=:jawab, tanggal=:tanggal WHERE id_jawaban=:id_jawaban";
        $this->db->query($query);
        $this->db->bind("id_user", $data['id_user']);
        $this->db->bind("id_tokensoal", $data['id_tokensoal']);
        $this->db->bind("nosoal", $data['nosoal']);
        $this->db->bind("jawab", $data['jawab']);
        $this->db->bind("tanggal", $data['tanggal']);
        $this->db->bind("id_jawaban", $data['id_jawaban']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id_jawaban=:id_jawaban";
        $this->db->query($query);
        $this->db->bind("id_jawaban", $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getByEmail($email){
        $query = "SELECT id_jawaban, user.id_user, id_tokensoal, nosoal, jawab, tanggal, email, telepon, username, password, level, konfirmasi FROM `jawaban`, user where jawaban.id_user=user.id_user and user.email=:email";
        $this->db->query($query);
        $this->db->bind("email", $email);
        return $this->db->resultSet();
    }
}
