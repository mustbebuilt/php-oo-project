<?php
session_start();
Class Database
{
    public $connect ;
    public function __construct($hostname,$username,$password,$dbname){
		echo $hostname;
		echo $username;
		echo $password;
		echo $dbname;
        $this->connect = @mysqli_connect($hostname,$username,$password,$dbname) or die('xConnection Error');
    }

//INSERT QUERY
    public function insert($table,$data){
        $insert_values = "";
        foreach($data as $key => $val){
            $val = mysqli_real_escape_string($this->connect,$val);
            $insert_values .= "`".$key."`='".$val."', ";
        }
        $insert_values = substr($insert_values,0,-2);
        $query = mysqli_query($this->connect,"INSERT INTO `".$table."` SET ".$insert_values);
        if($query){
            return true;
        }else{
            return false;
        }
    }


//SELECT QUERY
    private $select ;
    public function select($table,$data = "*"){
        if($data != "*"){
            $keys = "";
            foreach($data as $key){
                $keys .= "`".$key."`,";
            }
            $keys = substr($keys,0,-1);
            $this->select = "SELECT ".$keys." FROM `".$table."`";
        }else{
            $this->select = "SELECT ".$data." FROM `".$table."`";
        }
    }


//FETCH DATA
    public function fetchData($fetch_type = "assoc"){
        switch($fetch_type){
            case "assoc":
                $fetch = "mysqli_fetch_assoc";
                break;
            case "row":
                $fetch = "mysqli_fetch_row";
                break;
            default:
                $fetch = "mysqli_fetch_array";
                break;
        }
        $query = mysqli_query($this->connect,$this->select.$this->where.$this->orderBy.$this->limit.$this->offset);
        if($query){
            $result = "";
            while($data = $fetch($query)){
                $result[] = $data;
            }
            $this->select = $this->where = $this->orderBy = $this->limit = $this->orderBy = $this->limit = $this->offset =  null;
            return $result;
        }else{
            return null;
        }
    }


//AND WHERE
    private $where;
    public function where($data){
        foreach($data as $key => $val){
            if($this->where == ""){
                $this->where = " WHERE `" . $key . "`='".$val."'";
            }else{
                $this->where .= " AND `" . $key . "`='".$val."'";
            }
        }
    }


//OR WHERE
    public function or_where($data){
        foreach($data as $key => $val){
            if($this->where == ""){
                $this->where = " WHERE `" . $key . "`='".$val."'";
            }else{
                $this->where .= " OR `" . $key . "`='".$val."'";
            }
        }
    }


//like WHERE
    public function likeWhere($key,$val){
                $this->where = " WHERE `" . $key . "`LIKE'%".$val."%'";
    }

//UPDATE QUERY
    public function update($table,$data){
        $update_values = "";
        foreach($data as $key => $val){
            $val = mysqli_real_escape_string($this->connect,$val);
            $update_values .= "`".$key."`='".$val."', ";
        }
        $update_values = substr($update_values,0,-2);
        $query = mysqli_query($this->connect,"UPDATE `".$table."` SET ".$update_values.$this->where);
        if($query){
            $this->where=null;
            return true;
        }else{
            return false;
        }
    }


//DELETE QUERY
    public function delete($table){
        $query = mysqli_query($this->connect,"DELETE FROM `".$table."`".$this->where);
        if($query){
            $this->where=null;
            return true;
        }else{
            return false;
        }
    }


//TRUNCATE QUERY
    public function truncate($table){
        $query = mysqli_query($this->connect,"TRUNCATE TABLE`".$table);
        if($query){
            return true;
        }else{
            return false;
        }
    }



//ORDER BY
    private $orderBy;
    public function orderBy($field_name,$order){
        $this->orderBy = "ORDER BY `".$field_name."` ".$order;
    }


//LIMIT
    private $limit;
    public function limit($value){
        $this->limit = "LIMIT ".$value;
    }
//OFFSET
    private $offset;
    public function offset($value){
        $this->offset = " OFFSET ".$value;
    }

//INSERTED ID
    public function inserted_id(){
        return mysqli_insert_id($this->connect);
    }

//LOGIN
    public function login($user_info,$user_pass){
        $this->select("user",array('user_id',"user_name","user_email","user_role"));
        $this->where(array("user_name"=>$user_info,"user_password"=>$user_pass));
        $this->or_where(array("user_email"=>$user_info));
        $this->where(array("user_password"=>$user_pass));
        $result = $this->fetchData();
        if($result != ""){
            $_SESSION['artist'] = $result;
            return true;
        }else{
            return false;
        }
    }

}
//require_once('connection.php');
require_once('../../../includes/pdo.class.inc.php');