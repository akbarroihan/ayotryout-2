<?php
class Jenis_soal_model
{
    private $table = 'jenis_soal';
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
        $this->db->query("SELECT * FROM $this->table WHERE id_jenis=:id_jenis");
        $this->db->bind("id_jenis", $id);
        return $this->db->single();
    }
    public function getByName($nama)
    {
        $this->db->query("SELECT * FROM $this->table WHERE nm_jenis LIKE :nm_jenis");
        $this->db->bind("nm_jenis", "$nama");
        return $this->db->single();
    }

    public function save($data)
    {
        $query = "INSERT INTO $this->table (nama_jenis) VALUES (:nama_jenis)";
        $this->db->query($query);
        $this->db->bind("nama_jenis", $data['nama_jenis']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update($data)
    {
        $query = "UPDATE $this->table SET nama_jenis=:nama_jenis WHERE id_jenis=:id_jenis";
        $this->db->query($query);
        $this->db->bind("nama_jenis", $data['nama_jenis']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id_jenis=:id_jenis";
        $this->db->query($query);
        $this->db->bind("id_jenis", $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
