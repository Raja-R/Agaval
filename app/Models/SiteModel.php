<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'config';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDelete        = false;
    protected $protectFields        = true;

    protected $allowedFields        = [
        "id","site_name","support_no","support_email","copy_right","prefix_category","prefix_product","prefix_sale","prefix_purchase","prefix_brand","prefix_supplier","prefix_invoice","prefix_expense","created_at","updated_at"
    ];
    protected $allowedStrFields        = 'id,site_name,support_no,support_email,copy_right,prefix_category,prefix_product,prefix_sale,prefix_purchase,prefix_brand,prefix_supplier,prefix_invoice,prefix_expense,created_at,updated_at';

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
        $query = $this->db->query('select ' . $this->allowedStrFields . ' from ' . $this->table.' order by id ASC');
        return $query->getResult();
    }

    public function get_data_by_id($id)
    {
        $query = $this->db->query('select ' . $this->allowedStrFields . ' from ' . $this->table . ' where id="'.$id.'" ');
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
