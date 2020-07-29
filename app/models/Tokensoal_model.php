<?php
class Tokensoal_model
{
    private $table = 'tokensoal';
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

    public function getCombinationTree()
    {
        $this->db->query("SELECT tokensoal.id_tokensoal, tokensoal.id_token, dt_token.token, soal.id_soal, soal.id_sub as id_sub, soal.isi as isi, soal.file as file, soal.true as 'true', soal.pil_a as pil_a, soal.pil_b as pil_b, soal.pil_c as pil_c, soal.pil_d as pil_d, soal.pil_e as pil_e, soal.score_a as score_a, soal.score_b as score_b, soal.score_c as score_c, soal.score_d as score_d, soal.score_e as score_e, sub, jenjang, waktu FROM $this->table, dt_token, soal, sub_jenis where soal.id_sub=sub_jenis.id_sub and dt_token.id_token=tokensoal.id_token and tokensoal.id_soal=soal.id_soal");
        return $this->db->resultSet();
    }
    public function getCombinationTreeByJenjang($jenjang)
    {
        $this->db->query("SELECT tokensoal.id_tokensoal, tokensoal.id_token, dt_token.token, soal.id_soal, soal.id_sub as id_sub, soal.isi as isi, soal.file as file, soal.true as 'true', soal.pil_a as pil_a, soal.pil_b as pil_b, soal.pil_c as pil_c, soal.pil_d as pil_d, soal.pil_e as pil_e, soal.score_a as score_a, soal.score_b as score_b, soal.score_c as score_c, soal.score_d as score_d, soal.score_e as score_e, sub, jenjang, waktu FROM $this->table, dt_token, soal, sub_jenis where soal.id_sub=sub_jenis.id_sub and dt_token.id_token=tokensoal.id_token and tokensoal.id_soal=soal.id_soal and sub_jenis.jenjang=:jenjang");
        $this->db->bind('jenjang', $jenjang);
        return $this->db->resultSet();
    }
    public function getByJenjang($jenjang)
    {
        $this->db->query("SELECT tokensoal.id_tokensoal, tokensoal.id_token, dt_token.token,  tokensoal.id_soal, jenjang FROM $this->table, dt_token, soal, sub_jenis where soal.id_sub=sub_jenis.id_sub and dt_token.id_token=tokensoal.id_token and tokensoal.id_soal=soal.id_soal and sub_jenis.jenjang=:jenjang");
        $this->db->bind('jenjang', $jenjang);
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_tokensoal=:id_tokensoal");
        $this->db->bind("id_tokensoal", $id);
        return $this->db->single();
    }

    public function insert($data)
    {
        if (isset($data['id_soal'])) {
            $no = 0;
            while (isset($data['id_soal'][$no])) {
                $query = 'INSERT INTO ' . $this->table . ' (id_token, id_soal) 
                    VALUES (:id_token, :id_soal)';
                $this->db->query($query);
                $this->db->bind("id_token", $data['id_token']);
                $this->db->bind("id_soal", $data['id_soal'][$no++]);
                $this->db->execute();
            }
            return $no;
        }
    }

    public function update($data)
    {
        $query = 'UPDATE ' . $this->table . ' SET id_token=:id_token, id_soal=:id_soal WHERE id_tokensoal=:id_tokensoal';
        $this->db->query($query);
        $this->db->bind("id_token", $data['id_token']);
        $this->db->bind("id_soal", $data['id_soal']);
        $this->db->bind("id_tokensoal", $data['id_tokensoal']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id_tokensoal=:id_tokensoal";
        $this->db->query($query);
        $this->db->bind("id_tokensoal", $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
