<?php
class Sub_jenis_model
{
    private $table = 'sub_jenis';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll($jenjang = null)
    {
        if ($jenjang != null) {
            $this->db->query("SELECT * FROM $this->table Where  ");
            return $this->db->resultSet();

        } else {
            $this->db->query("SELECT * FROM $this->table");
            return $this->db->resultSet();
        }
    }

    public function getById($id)
    {
        $this->db->query("SELECT sub_jenis.id_sub as id_sub, sub_jenis.id_jenis as id_jenis, sub, jenjang, waktu, nm_jenis FROM $this->table, jenis_soal WHERE sub_jenis.id_jenis=jenis_soal.id_jenis AND id_sub=:id_sub");
        $this->db->bind("id_sub", $id);
        return $this->db->single();
    }

    public function save($data)
    {
        $query = 'INSERT INTO ' . $this->table . ' (id_jenis, sub, jenjang, waktu) 
        VALUES (:id_jenis, :sub, :jenjang, :waktu)';
        $this->db->query($query);
        $this->db->bind("id_jenis", $data['id_jenis']);
        $this->db->bind("sub", $data['sub']);
        $this->db->bind("jenjang", $data['jenjang']);
        $this->db->bind("waktu", $data['waktu']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update($data)
    {
        $query = 'UPDATE ' . $this->table . ' SET id_jenis=:id_jenis, sub=:sub, jenjang=:jenjang, waktu=:waktu WHERE id_sub=:id_sub';
        $this->db->query($query);
        $this->db->bind("id_jenis", $data['id_jenis']);
        $this->db->bind("sub", $data['sub']);
        $this->db->bind("jenjang", $data['jenjang']);
        $this->db->bind("waktu", $data['waktu']);
        $this->db->bind("id_sub", $data['id_sub']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id_sub=:id_sub";
        $this->db->query($query);
        $this->db->bind("id_sub", $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getJenjang()
    {
        $query = "SELECT DISTINCT(jenjang) FROM sub_jenis";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getSubJenisLengkapByJenjang($jenjang){
        $query = "SELECT sub_jenis.id_sub as id_sub, jenis_soal.id_jenis as id_jenis, sub, jenjang, waktu, nm_jenis FROM sub_jenis, jenis_soal WHERE sub_jenis.jenjang=:jenjang and sub_jenis.id_jenis=jenis_soal.id_jenis ORDER BY jenis_soal.nm_jenis DESC";
        $this->db->query($query);
        $this->db->bind('jenjang', $jenjang);
        $this->db->execute();
        return $this->db->resultSet();
    }
}
