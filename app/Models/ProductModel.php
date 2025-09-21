<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;



class ProductModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'product';
    protected $table_category       = 'product_category';
    protected $table_brand          = 'product_brand';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDelete        = false;
    protected $protectFields        = true;

    protected $allowedFields        = [
        "id", "category_id", "name", "code", "upc_code", "hsn_sac_code", "purchase_price", "sales_price", "description", "short_desc", "stock", "tax_id", "unit_id", "quantity", "image", "image_status", "min_order_qty", "product_type", "status", "sorting", "created_by", "created_at", "updated_by", "updated_at"
    ];
    protected $allowedStrFields        = 'id,category_id,name,code,upc_code,hsn_sac_code,purchase_price,sales_price,description,short_desc,stock,tax_id,unit_id,quantity,image,image_status,min_order_qty,product_type,status,sorting,created_by,created_at,updated_by,updated_at';

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
        $query = $this->db->query('select ' . $this->allowedStrFields . ' from ' . $this->table . ' order by id ASC');
        return $query->getResult();
    }

    public function get_list()
    {
        $builder = $this->db->table($this->table);
        $builder->select($this->table . '.*, ' . $this->table_category . '.name as category_name');
        $builder->select($this->table . '.*, ' . $this->table_brand . '.name as brand_name');
        $builder->join($this->table_category, $this->table_category . '.id = ' . $this->table . '.category_id', 'left');
        $builder->join($this->table_brand, $this->table_brand . '.id = ' . $this->table . '.brand_id', 'left');
        $builder->orderBy($this->table . '.id', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_data_by_id($id)
    {
        $this->join($this->table_category, $this->table_category . '.id = ' . $this->table . '.category_id', 'left');
        $this->select($this->table . '.*');
        $this->select($this->table_category . '.name as category_name');
        $this->where($this->table . '.id', $id);
        $result = $this->first();

        if ($result) {
            $created_at = Time::parse($result['created_at']);
            $result['created_at_formatted'] = $created_at->toLocalizedString('dd-MM-yyyy h:m a');
        }

        return $result;
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

    public function get_category_list()
    {
        $query = $this->db->query('select * from ' . $this->table_category . ' order by id ASC');
        return $query->getResult();
    }

    public function get_brand_list()
    {
        $query = $this->db->query('select * from ' . $this->table_brand . ' order by id ASC');
        return $query->getResult();
    }

    public function get_cat_data_by_id($id)
    {
        $query = $this->db->query('select * from ' . $this->table_category . ' where id="' . $id . '" ');
        return $query->getResult();
    }

    public function insert_category_data($data = array())
    {
        $this->db->table($this->table_category)->insert($data);
        return $this->db->insertID();
    }

    public function update_category_data($id, $data = array())
    {
        $this->db->table($this->table_category)->update($data, array(
            "id" => $id,
        ));
        return $this->db->affectedRows();
    }

    public function delete_category_data($id)
    {
        return $this->db->table($this->table_category)->delete(array(
            "id" => $id,
        ));
    }
}
