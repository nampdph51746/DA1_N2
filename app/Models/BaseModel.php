<?php

namespace App\Models;

use PDO;

class BaseModel
{
    protected $conn = null;
    protected $tableName = null;
    protected $primaryKey = 'id';
    protected $sqlBuilder = null;
    protected $params = [];
    public function __construct()
    {
        $host = HOST;
        $dbname = DBNAME;
        $username = USERNAME;
        $password = PASSWORD;
        $port = PORT;
        try {
            $this->conn = new \PDO("mysql:host=$host; dbname=$dbname; charset=utf8; port=$port", $username, $password);
        } catch (\PDOException $e) {
            echo "Lỗi kết nối CSDL: " . $e->getMessage();
        }
    }
    //Lấy toàn bộ
    public static function all()
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM $model->tableName";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * create: thêm mới dữ liệu từ 1 bảng
     * $data: dữ liệu mảng có key và value trong key là tên cột còn value là giá trị tương ứng
     */
    public static function create($data)
    {
        $model = new static;
        $sql = "INSERT INTO $model->tableName(";
        $values = "VALUES(";
        foreach ($data as $column => $val) {
            $sql .= "`$column`, ";
            $values .= ":$column, ";
        }
        $sql = rtrim($sql, ', ') . ") " . rtrim($values, ', ') . ")";
        $stmt = $model->conn->prepare($sql);
        $stmt->execute($data);
    }

    /**
     * delete: là phương thức xóa dữ liệu theo id
     */
    public static function delete($id)
    {
        $model = new static;
        $sql = "DELETE FROM $model->tableName WHERE $model->primaryKey=:$model->primaryKey";
        // dd($sql);
        $stmt = $model->conn->prepare($sql);
        $stmt->execute(["$model->primaryKey" => $id]);
    }

    /**
     * update: phương thức cập nhật
     * @data: là mảng dữ liệu dùng để cập nhật có key là tên cột và value tương ứng
     * @id: là giá trị của khóa chính
     */
    public static function update($data, $id)
    {
        $model = new static;
        $sql = "UPDATE $model->tableName SET ";

        foreach ($data as $column => $val) {
            $sql .= "`$column` = :$column, ";
        }
        //Loại bỏ dấu ", " và thêm điều kiện
        $sql = rtrim($sql, ", ") . " WHERE $model->primaryKey=:$model->primaryKey";

        $stmt = $model->conn->prepare($sql);

        //Thêm $id vào trong mảng $data
        $data["$model->primaryKey"] = $id;

        return $stmt->execute($data);
    }

    /**
     * @find: phương thức Lấy 1 dữ liệu theo id
     */
    public static function find($id)
    {
        $model = new static;
        $sql = "SELECT * FROM $model->tableName WHERE $model->primaryKey=:$model->primaryKey";

        $stmt = $model->conn->prepare($sql);
        $stmt->execute(["$model->primaryKey" => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result[0] ?? [];
    }

    /**
     * @where: phương thức lấy dữ liệu theo điều kiện
     * @param $column: tên cột làm điều kiện
     * @param $operator: biểu thức điều kiện
     * @param $value: giá trị
     */
    public static function where($column, $operator, $value)
    {
        $model = new static;
    
        // Kiểm tra nếu chưa có sqlBuilder thì khởi tạo
        if ($model->sqlBuilder == null) {
            $model->sqlBuilder = "SELECT * FROM $model->tableName WHERE `$column` $operator :$column";
        } else {
            $model->sqlBuilder .= " AND `$column` $operator :$column";
        }
    
        // Bind tham số
        $model->params[":$column"] = $value;  // Sử dụng :$column để bind tham số đúng cách
        return $model;
    }

    /**
     * @method get: lấy dữ liệu
     */
    public function get()
    {
        $stmt = $this->conn->prepare($this->sqlBuilder);
        $stmt->execute($this->params);
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * @method first: lấy ra phần tử đầu tiên
     */
    public function first()
    {
        $stmt = $this->conn->prepare($this->sqlBuilder);
        $stmt->execute($this->params);
        return $stmt->fetchAll(PDO::FETCH_CLASS)[0] ?? [];
    }

    /**
     * @method andWhere: Phương kết hợp với where thêm điều AND
     * @param $column: tên cột làm điều kiện
     * @param $operator: biểu thức điều kiện
     * @param $value: giá trị
     */
    public function andWhere($column, $operator, $value)
    {
        $this->sqlBuilder .= " AND `$column` $operator :$column";
        $this->params["$column"] = $value;
        return $this;
    }
    /**
     * @method orWhere: Phương kết hợp với where thêm điều OR
     * @param $column: tên cột làm điều kiện
     * @param $operator: biểu thức điều kiện
     * @param $value: giá trị
     */
    public function orWhere($column, $operator, $value)
    {
        $this->sqlBuilder .= " OR `$column` $operator :$column";
        $this->params["$column"] = $value;
        return $this;
    }

    /**
     * @method select: phương thức lấy dữ liệu theo lựa chọn cột cần lấy
     */
    public static function select($columns = ['*'])
    {
        $model = new static;
        $model->sqlBuilder = "SELECT ";
        foreach ($columns as $col) {
            $model->sqlBuilder .= " $col, ";
        }
        $model->sqlBuilder = rtrim($model->sqlBuilder, ", ") . " FROM $model->tableName ";
        return $model;
    }

    /**
     * @method join: phương thức dùng để nối 2 bảng
     * @param $table: Bảng để nối với bảng hiện tại
     * @param $first: Tham số điều kiện thứ nhất
     * @param $second: Tham số điều kiện thứ 2
     */
    public function join($table, $first, $second)
    {
        $this->sqlBuilder .= " JOIN $table ON $first = $second ";
        // dd($this->sqlBuilder);
        return $this;
    }
    /**
 * @method limit: giới hạn số lượng kết quả trả về
 * @param $number: số lượng kết quả cần lấy
 */
public function limit($number)
{
    $this->sqlBuilder .= " LIMIT $number";
    return $this;
}

/**
 * @method orderBy: sắp xếp kết quả theo cột chỉ định
 * @param $column: tên cột để sắp xếp
 * @param $direction: hướng sắp xếp (ASC hoặc DESC)
 */
public function orderBy($column, $direction = "ASC")
{
    $this->sqlBuilder .= " ORDER BY `$column` $direction";
    return $this;
}

public function groupBy($columns)
{
    if (is_array($columns)) {
        $columns = implode(", ", $columns);
    }
    $this->sqlBuilder .= " GROUP BY $columns";
    return $this;
}

public function getSql()
{
    $sql = $this->sqlBuilder;
    $params = $this->params;

    if (!$sql) return null;

    foreach ($params as $key => $value) {
        $quoted = $this->conn->quote($value); // xử lý giá trị an toàn
        $key = ltrim($key, ':'); // loại bỏ dấu : nếu có
        $sql = preg_replace('/:'.preg_quote($key, '/').'(?=\W|$)/', $quoted, $sql);
    }

    return $sql;
}

}


