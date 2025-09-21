<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;



class ExpenseModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'expense';
    protected $table_category                = 'expense_category';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDelete        = false;
    protected $protectFields        = true;

    protected $allowedFields        = [
        "id", "category_id", "expense_date", "reference_no", "expense_for", "expense_amt", "note", "created_by", "created_at", "updated_at", "updated_by", "status"
    ];
    protected $allowedStrFields        = 'id,category_id,expense_date,reference_no,expense_for,expense_amt,note,created_by,created_at,updated_at,updated_by,status';

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
        $this->join($this->table_category, $this->table_category . '.id = ' . $this->table . '.category_id');
        $this->select($this->table . '.*');
        $this->select($this->table_category . '.category_name');
        $this->orderBy($this->table . '.id DESC');
        $result = $this->findAll();
        $data = [];
        foreach ($result as $key => $value) {
            $data[$key]['id'] = $value['id'];

            $expense_date = Time::parse($value['expense_date']);
            $data[$key]['expense_date'] = $expense_date->toLocalizedString('dd-MM-yyyy');
            $data[$key]['reference_no'] = $value['reference_no'];
            $data[$key]['expense_for'] = $value['expense_for'];
            $data[$key]['expense_amt'] = $value['expense_amt'];
            $data[$key]['note'] = $value['note'];
            $data[$key]['category_name'] = $value['category_name'];
            $data[$key]['category_id'] = $value['category_id'];
            $data[$key]['status'] = $value['status'];
        }
        return $data;
    }

    public function get_data_by_id($id)
    {
        // $query = $this->db->query('select ' . $this->allowedStrFields . ' from ' . $this->table . ' where id="' . $id . '" ');

        // $data = [];
        // foreach ($query->getResult() as $key => $value) {
        //     $data[$key]['id'] = $value->id;

        //     $expense_date = Time::parse($value->expense_date);
        //     $data[$key]['expense_date'] = $expense_date->toLocalizedString('dd-MM-yyyy');
        //     $data[$key]['reference_no'] = $value->reference_no;
        //     $data[$key]['expense_for'] = $value->expense_for;
        //     $data[$key]['expense_amt'] = $value->expense_amt;
        //     $data[$key]['note'] = $value->note;
        //     $data[$key]['category_id'] = $value->category_id;
        //     $data[$key]['status'] = $value->status;
        //     $data[$key]['created_at'] = $value->created_at;
        // }
        // return $data;

        $this->join($this->table_category, $this->table_category . '.id = ' . $this->table . '.category_id');
        $this->select($this->table . '.*');
        $this->select($this->table_category . '.category_name');
        $this->where($this->table . '.id',$id);
        $this->orderBy($this->table . '.id DESC');
        $result = $this->findAll();
        $data = [];
        foreach ($result as $key => $value) {
            $data[$key]['id'] = $value['id'];

            $expense_date = Time::parse($value['expense_date']);
            $data[$key]['expense_date'] = $expense_date->toLocalizedString('dd-MM-yyyy');
            $data[$key]['reference_no'] = $value['reference_no'];
            $data[$key]['expense_for'] = $value['expense_for'];
            $data[$key]['expense_amt'] = $value['expense_amt'];
            $data[$key]['note'] = $value['note'];
            $data[$key]['category_name'] = $value['category_name'];
            $data[$key]['category_id'] = $value['category_id'];
            $data[$key]['status'] = $value['status'];

            $created_at = Time::parse($value['created_at']);
            $data[$key]['created_at'] = $created_at->toLocalizedString('dd-MM-yyyy h:m a');
        }
        return $data;
    }

    public function get_expenses_by_cat_id($cat_id)
    {
        $query = $this->db->query('select expense_date,SUM(expense_amt) as expense_amt from ' . $this->table . ' where category_id='.$cat_id.' GROUP BY expense_date');
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

    public function get_category_list()
    {
        $query = $this->db->query('select * from ' . $this->table_category . ' order by id ASC');
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
