<?php

namespace App;

use App\Database;

class Model
{

    protected string $table;

    protected $primaryKey = 'id';

    protected array $attributes;

    private static Database $DB;

    function __construct($param = null)
    {
        if ($param) $this->create($param);

        self::$DB = new Database;
    }


    public function all(): array
    {
        return self::$DB->read($this->table);
    }

    public function getItemById(int $id)
    {
        return self::$DB->readOne($this->table, $id);
    }

    public function create($attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function save()
    {
        try {
            $data = $this->attributes;
            self::$DB->insert($this->table, $data);
        } catch (\Exception $ex) {
            echo 'hiba a mentésnél: <br> ' . $ex->getMessage();
            return false;
        }
        return true;
    }

    public function update()
    {
        return true;
    }

    public function get()
    {
        return $this->attributes;
    }

    public function set($attribute, $data)
    {
        if (!$this->attributes[$attribute]) {
            array_push($this->attributes, $attribute);
        }
        $this->attributes[$attribute] = $data;
        return true;
    }
    public function search($data,$attribute){
        return self::$DB->read_filter($this->table,$attribute,$data);

    }
}
