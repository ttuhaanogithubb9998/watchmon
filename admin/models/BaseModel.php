<?php

class BaseModel extends Database
{
    protected $pdo;
    protected $tableName;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->pdo  = $this->connection();
    }

    /**
     * Lấy tất cả 
     * @param array $selects = [columnName1,columnName2,...] 
     * Lấy các cột tương ứng nếu không truyền lất tất cả. 
     * @param array $oderBy = [columnName => typeOderBy,...] . Sắp xếp theo cột tương ứng nếu không truyền không sắp xếp.
     * @param int $limit = 0. Lấy số hàng tối đa nếu không truyền lấy tất cả.
     */
    function all($selects = ["*"], $oderBy = [], $limit = 20)
    {
        $columns = implode(', ', $selects);
        $oderByString = '';
        if (count($oderBy) > 0) {
            $oderByString = 'ORDER BY';
            $length = strlen($oderByString);

            foreach ($oderBy as $column => $type) {

                if (strlen($oderByString) > $length) {
                    $oderByString .= ", {$column} {$type}";
                } else {
                    $oderByString .= " {$column} {$type}";
                }
            }
        }
        if ($limit != '')   $limit = " Limit " . $limit;
        $sql = "SELECT {$columns} FROM {$this->tableName} {$oderByString} $limit";
        $stm = $this->pdo->query($sql);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Tìm dữ liệu  theo key , value và typeFind (like hoặc = )  trong mảng truyền vào
     * nếu  truyền  sai typeFind  thì mặc định là "="
     
     * @param array $arrParams = [key => [value,typeFind], key => [value,typeFind], ...].
     * Vd :  $arrParams = ["id" => [1,"="], "name" => ["tuan","like"], ...]
     * 
     */
    function search($selects = ["*"], $arrParams)
    {
        $columns = implode(', ', $selects);
        $sql = "SELECT {$columns} FROM {$this->tableName} WHERE ";
        $arr = [];

        foreach ($arrParams as $key => [$value, $typeFind]) {
            if ($key != '' && $value != '') {
                if (count($arr) > 0) {
                    $sql .= " and ";
                }

                if ($typeFind == 'like') {
                    $sql .= " %$key% " . ' like ' . ' ? ';
                    $arr = array_merge($arr, [$value]);
                } else {
                    $sql .= $key . ' =' . ' ?';
                    $arr = array_merge($arr, [$value]);
                }
            }
        }

        $stm = $this->pdo->prepare($sql);
        $stm->execute($arr);

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Update dữ liệu theo id 
     * @param array $columnsUpdate = [column1 => value1, column2 => value2,...] 
     * vd: ["name" => "tuan","phone" => "0123456789"]
     * @param int $id 
     * @return int count update
     */
    function update($columnsUpdate, $id)
    {
        $set = '';
        $first = true;
        $arr = [];

        foreach ($columnsUpdate as $column => $value) {
            if ($first) {
                $set .= " $column = ? ";
                $arr = array_merge($arr, [$value]);
                $first = false;
            } else {
                $set  .= ", $column = ? ";
                $arr = array_merge($arr, [$value]);
            }
        }

        $arr = array_merge($arr, [$id]);
        $sql = "UPDATE $this->tableName 
        SET $set 
        WHERE id = ? ";

        $stm = $this->pdo->prepare($sql);
        $stm->execute($arr);
        return $stm->rowCount();
    }

    /**
     * insert dữ liệu
     * @param array $columnsInsert = [colum1 => value1,colum2 => value2,...]
     * @return int | false số dòng ảnh hưởng
     */
    function insert($columnsInsert)
    {
        $columns = '( ';
        $values = '( ';
        $arr = [];
        $first = true;

        foreach ($columnsInsert as $column => $value) {
            if ($first) {
                
                $columns .= " $column ";
                $values  .= " ? ";
                $arr = array_merge($arr, [$value]);
                $first = false;
            } else {

                $columns .= ", $column ";
                $values  .= ", ? ";
                $arr = array_merge($arr, [$value]);
            }
        }
        $columns .= ' )';
        $values .= ' )';

        $sql = "INSERT INTO $this->tableName 
        $columns
        VALUES
        $values ";


        try{
            $stm = $this->pdo->prepare($sql);
            $stm -> execute($arr);
            return $stm->rowCount();
        }catch(Exception $e) {
            $mes = $e->getMessage();
        }
        return false;
    }
}
