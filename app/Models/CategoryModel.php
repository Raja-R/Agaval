<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;



class CategoryModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'product_category';
    protected $table_product        = 'product';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDelete        = false;
    protected $protectFields        = true;

    protected $allowedFields        = [
        "id", "name", "description",  "status", "created_by", "created_at", "updated_by", "updated_at"
    ];
    protected $allowedStrFields        = 'id,name,description,status,created_by,created_at,updated_by,updated_at';

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

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
        $this->db->query('select ' . $this->allowedStrFields . ' from ' . $this->table . ' order by id DESC');
        $result = $this->findAll();
        $data = [];
        foreach ($result as $key => $value) {
            $data[$key]['id'] = $value['id'];

            $data[$key]['name'] = $value['name'];
            $data[$key]['description'] = $value['description'];
            $data[$key]['status'] = $value['status'];

            $created_at = Time::parse($value['created_at']);
            $data[$key]['created_at'] = $created_at->toLocalizedString('dd-MM-yyyy h:m a');
        }
        return $data;
    }

    public function get_data_by_id($id)
    {
        $this->db->query('select ' . $this->allowedStrFields . ' from ' . $this->table . ' where id="'.$id.'" ');
        $result = $this->findAll();
        $data = [];
        foreach ($result as $key => $value) {
            $data[$key]['id'] = $value['id'];

            $data[$key]['name'] = $value['name'];
            $data[$key]['description'] = $value['description'];
            $data[$key]['status'] = $value['status'];

            $created_at = Time::parse($value['created_at']);
            $data[$key]['created_at'] = $created_at->toLocalizedString('dd-MM-yyyy h:m a');
        }
        return $data;
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
