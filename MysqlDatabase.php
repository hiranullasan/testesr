<?php
/**
 * Created by PhpStorm.
 * User: sysadmin
 * Date: 2/3/19
 * Time: 5:02 PM
 */

class MysqlDatabase{
    private $conn;
    private $debug;

    function __construct(){
        $this->connect();
    }

    /**
     *
     */
    private function connect() : void {
        $this->conn = new mysqli(
            "localhost",
            "test_usr",
            "root@V1nam",
            "student"
            
        );
        if(!$this->conn)
            die($this->conn->connect_error);

    }

    /**
     * @param integer $debug
     */
    public function setDebug($debug): void {
        $this->debug = $debug;
    }

  

    /**
     * @param string $sql
     * @param string $type
     * @return integer/array
     */
    public function select($id=0,$limit=5) {
      $a1=array_keys(get_class_vars(get_called_class()));
        $a2=array_keys(get_class_vars(get_class()));
        $fields=array_diff($a1, $a2);
        $table_fields  = implode(",",$fields);
        $sql = "select ".$table_fields . " from " . get_called_class();
        $sql = $id > 0 ? $sql . " where id=" . $id . " limit 1" : $sql . " limit $limit";
        if($this->debug==1)
        $resultSet = $this->conn->query($sql);
        return $resultSet->fetch_all(1);
     
    }

    public function insertData($data): int{

        $a1=get_class_vars(get_called_class());
        $a2=get_class_vars(get_class());
        foreach ($a2 as $key => $value) {
          unset($a1[$key]);
        }
        $sql = "insert into ". get_called_class(). " SET ";
        foreach ($data as $key => $value){
            if(array_key_exists($key,$a1)){

                $sql.= $key. "='" . $value ."',";
               

            }
        }
        $sql =rtrim($sql,',');
        if($this->debug==1){
        $resultSet = $this->conn->query($sql);
        return $resultSet;
         }
      }

     public function deleteData($delete_id): int{

        $sql = "delete from ". get_called_class().
        $sql .=" where id=".$delete_id;
        if($this->debug==1)
        //    echo "\n Query : ". $sql ."\n";

        $resultSet = $this->conn->query($sql);
        return $resultSet;
      }

            public function updateData($data): int{

        $a1=get_class_vars(get_called_class());
        $a2=get_class_vars(get_class());
        foreach ($a2 as $key => $value) {
          unset($a1[$key]);
        }
        //$fields=array_diff($a1, $a2);
        $sql = "update ". get_called_class() . " SET ";
        foreach ($data as $key => $value){
            if(array_key_exists($key,$a1)){
                $sql.= $key. "='" . $value ."',";
            }
        }
        $sql =rtrim($sql,',');
        $sql .=" where id=".$data['id'];
        if($this->debug==1)
        $resultSet = $this->conn->query($sql);
        return $resultSet;
    }

}

