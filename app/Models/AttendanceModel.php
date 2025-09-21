<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'attendance';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDelete        = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        "id",
        "token_id",
        "user_id",
        "status",
        "created_at"
    ];
    protected $allowedStrFields        = 'id,token_id,user_id,status,created_at';

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'created_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function get_all_data()
    {
        $query = $this->db->query('select ' . $this->allowedStrFields . ' from ' . $this->table);
        return $query->getResult();
    }

    public function get_user_data($user_id)
    {
        $query = $this->db->query('select id,token_id,created_at from ' . $this->table. ' where user_id="' . $user_id . '" ');
        return $query->getResult();
    }

    public function checkToken($data)
    {
        $query = $this->db->query('select id from ' . $this->table . ' where token_id="' . $data . '" ');
        return $query->getResult();
    }

    public function checkQRVerification($data)
    {
        $query = $this->db->query('select id from generate_qr where token="' . $data . '" ');
        return $query->getResult();
    }

    public function insert_data($data = array())
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function update_data($id, $data = array())
    {
        $this->db->table($this->table)->update($data, array(
            "id" => $id,
        ));
        return $this->db->affectedRows();
    }

    public function delete_data($id)
    {
        return $this->db->table($this->table)->delete(array(
            "id" => $id,
        ));
    }
}
