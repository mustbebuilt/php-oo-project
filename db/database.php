<?php
session_start();
//http://culttt.com/2012/10/01/roll-your-own-pdo-php-class/
Class Database
{
    public $pdo ;
	private $dsn ;
    public function __construct($hostname,$username,$password,$dbname){
        $this->dsn = 'mysql:host='.$hostname.';dbname='.$dbname;
		$this->pdo = new PDO($this->dsn, $username, $password);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->pdo->exec("SET CHARACTER SET utf8");
    }
		
	//SELECT QUERY
    private $select ;
    public function select($table,$data = "*"){
        if($data != "*"){
            $keys = "";
            foreach($data as $key){
                $keys .= $key.",";
            }
			// take off the last comma
            $keys = substr($keys,0,-1);
            $this->select = "SELECT ".$keys." FROM ".$table;
        }else{
            $this->select = "SELECT ".$data." FROM ".$table;
        }
    }


//FETCH DATA
	private $stmt;
	private $data;
    public function fetchData(){
		$this->stmt = $this->pdo->prepare($this->select.$this->whereLike.$this->whereEq.$this->andEq.$this->andLike.$this->orEq.$this->orLike.$this->whereBetween.$this->orderBy);
		//print_r($this->select.$this->whereLike.$this->whereEq.$this->andEq.$this->andLike.$this->orEq.$this->orLike.$this->whereBetween.$this->orderBy);
		if($this->orderBy){
			//$this->stmt = $this->pdo->prepare($this->select.$this->whereLike.$this->whereEq.$this->orderBy);
		}
		if($this->whereLike){
			$this->stmt->bindParam($this->bindVal, $this->searchVal, $this->dataType);	
		}
		if($this->whereEq){
			$this->stmt->bindParam($this->eqBindVal, $this->eqSearchVal, $this->eqDataType);	
		}
		if($this->andEq){
			$this->stmt->bindParam($this->andEqBindVal, $this->andEqSearchVal, $this->andEqDataType);	
		}
		if($this->andLike){
			$this->stmt->bindParam($this->andLikeBindVal, $this->andLikeSearchVal, $this->andLikeDataType);	
		}
		if($this->orEq){
			$this->stmt->bindParam($this->orEqBindVal, $this->orEqSearchVal, $this->orEqDataType);	
		}
		if($this->orLike){
			$this->stmt->bindParam($this->orLikeBindVal, $this->orLikeSearchVal, $this->orLikeDataType);	
		}
		if($this->whereBetween){
			$this->stmt->bindParam($this->whereBetweenBindVal1, $this->whereBetweenVal1, $this->whereBetweenDataType1);	
			$this->stmt->bindParam($this->whereBetweenBindVal2, $this->whereBetweenVal2, $this->whereBetweenDataType2);	
		}
		//print_r($this->stmt);
		
		$this->stmt->execute();
		$data = $this->stmt->fetchAll();
		foreach($data as $row){
			$result[] = $row;
		}
		
		return $result;
        
    }
	
	//ORDER BY
    private $orderBy;
    public function orderBy($field_name,$order){
        $this->orderBy = " ORDER BY ".$field_name." ".$order;
    }
	
	
	//like WHERE
	private $whereLike;
	private $bindVal;
	private $searchVal;
	private $dataType;
    public function whereLike($key,$val,$dType = 's'){
                $this->whereLike = " WHERE " . $key . " LIKE :".$key;
				$this->bindVal = ":".$key;
				$this->searchVal = '%'.$val.'%';
				$this->dataType = $this->getDataType($dType);
    }
	
	//eq WHERE
	private $whereEq;
	private $eqBindVal;
	private $eqSearchVal;
	private $eqDataType;
    public function whereEq($key,$val,$dType = 's'){
                $this->whereEq = " WHERE " . $key . " = :".$key;
				$this->eqBindVal = ":".$key;
				$this->eqSearchVal = $val;
				$this->eqDataType = $this->getDataType($dType);
    }
	
	
	//AND WHERE EQUAL
    private $andEq;
	private $andEqBindVal;
	private $andEqSearchVal;
	private $andEqDataType;
    public function andEq($key,$val,$dType = 's'){
        	$this->andEq = " AND " . $key . " = :".$key;
			$this->andEqBindVal = ":".$key;
			$this->andEqSearchVal = $val;
			$this->andEqDataType .= $this->getDataType($dType);
    }
	
	//AND WHERE LIKE
    private $andLike;
	private $andLikeBindVal;
	private $andLikeSearchVal;
	private $andLikeDataType;
    public function andLike($key,$val,$dType = 's'){
        	$this->andLike = " AND " . $key . " LIKE :".$key;
			$this->andLikeBindVal = ":".$key;
			$this->andLikeSearchVal = '%'.$val.'%';
			$this->andLikeDataType .= $this->getDataType($dType);
    }
	
	//OR WHERE EQUAL
    private $orEq;
	private $orEqBindVal;
	private $orEqSearchVal;
	private $orEqDataType;
    public function orEq($key,$val,$dType = 's'){
        	$this->orEq = " OR " . $key . " = :".$key;
			$this->orEqBindVal = ":".$key;
			$this->orEqSearchVal = $val;
			$this->orEqDataType .= $this->getDataType($dType);
    }
	
	//OR WHERE LIKE
    private $orLike;
	private $orLikeBindVal;
	private $orLikeSearchVal;
	private $orLikeDataType;
    public function orLike($key,$val,$dType = 's'){
        	$this->orLike = " OR " . $key . " LIKE :".$key;
			$this->orLikeBindVal = ":".$key;
			$this->orLikeSearchVal = '%'.$val.'%';
			$this->orLikeDataType .= $this->getDataType($dType);
    }
	
	//WHERE BETWEEN
    private $whereBetween;
	private $whereBetweenBindVal1;
	private $whereBetweenBindVal2;
	private $whereBetweenVal1;
	private $whereBetweenVal2;
	private $whereBetweenDataType1;
	private $whereBetweenDataType2;
    public function whereBetween($key,$val1,$dType1 = 's',$val2,$dType2 = 's'){
        	$this->whereBetween = " WHERE " . $key . " BETWEEN :".$key. " AND :". $key."2";
			$this->whereBetweenBindVal1 = ":".$key;
			$this->whereBetweenBindVal2 = ":".$key."2";
			$this->whereBetweenVal1 = $val1;
			$this->whereBetweenVal2 = $val2;
			$this->whereBetweenDataType1 .= $this->getDataType($dType1);
			$this->whereBetweenDataType2 .= $this->getDataType($dType2);
    }
	
	/////////////// CRUDING /////////////////
	
	
	// UPDATE QUERY
	private $update;
    public function update($table,$upFields,$upValues,$upDataTypes){
		$updateBuildFields = "";
		foreach($upFields as $key){
                $keys .= $key.",";
				$updateBuildFields .= $key."=:".$key.", ";
        }
		// take off the last comma
		$updateBuildFields = substr($updateBuildFields,0,-2);
		// no where update
		$this->update = "UPDATE ".$table." SET ".$updateBuildFields;
		$this->stmt = $this->pdo->prepare($this->update);
		// overwrite for whereEq
		if($this->whereEq){
			$this->update = "UPDATE ".$table." SET ".$updateBuildFields.$this->whereEq;
			$this->stmt = $this->pdo->prepare($this->update);
			$this->stmt->bindParam($this->eqBindVal, $this->eqSearchVal, $this->eqDataType);
		}
		for($i=0;$i<count($upValues);$i++){
			$this->stmt->bindParam($upFields[$i], $upValues[$i], $this->getDataType($upDataTypes[$i]));
		}
		if($this->stmt->execute()){
			return 1;
		}else{
			return 0;	
		}
    }
	
	// INSERT QUERY
	private $insert;
    public function insert($table,$insFields,$insValues,$insDataTypes){
		$insertBuildFields = "(";
		$insertBuildVals = "(";
		foreach($insFields as $key){
                $keys .= $key.",";
				$insertBuildFields .= $key.", ";
				$insertBuildVals .= ":".$key.", ";
        }
		// take off the last comma
		$insertBuildFields = substr($insertBuildFields,0,-2);
		$insertBuildVals = substr($insertBuildVals,0,-2);
		$insertBuildFields .= ")";
		$insertBuildVals .= ")";
		$insertBuild = $insertBuildFields . " VALUES " . $insertBuildVals;
		// no where update
		$this->insert = "INSERT INTO ".$table.$insertBuild;
		$this->stmt = $this->pdo->prepare($this->insert);
		for($i=0;$i<count($insFields);$i++){
			$this->stmt->bindParam($insFields[$i], $insValues[$i], $this->getDataType($insDataTypes[$i]));
		}
		if($this->stmt->execute()){
			return 1;
		}else{
			return 0;	
		}
    }
	
	// DELETE QUERY
	private $delete;
    public function delete($table){
		// no where DELETE
		$this->delete = "DELETE ".$table;
		$this->stmt = $this->pdo->prepare($this->delete);
		// overwrite for whereEq
		if($this->whereEq){
			$this->delete = "DELETE FROM ".$table.$this->whereEq;
			$this->stmt = $this->pdo->prepare($this->delete);
			$this->stmt->bindParam($this->eqBindVal, $this->eqSearchVal, $this->eqDataType);
		}
		//print_r($this->stmt);
		if($this->stmt->execute()){
			return 1;
		}else{
			return 0;	
		}
    }
	
		
		
		
	private function getDataType($dType){
				switch ($dType) {
					case is_int('s'):
                	$returnDtype = PDO::PARAM_STR;
                	break;
            		case is_int('i'):
                	$returnDtype = PDO::PARAM_INT;
                	break;
            		case is_bool('b'):
                	$returnDtype = PDO::PARAM_BOOL;
                	break;
            		case is_null('n'):
                	$returnDtype = PDO::PARAM_NULL;
                	break;
            		default:
                	$returnDtype = PDO::PARAM_STR;
        		}	
			return $returnDtype;
	}
}
require_once('../../../includes/pdo.class.inc.php');
	
/*
/

//TRUNCATE QUERY
    public function truncate($table){
        $query = mysqli_query($this->connect,"TRUNCATE TABLE`".$table);
        if($query){
            return true;
        }else{
            return false;
        }
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
*/
