<?php

class Database extends PDO {

    protected $db = null;

    function __construct($dbName, $dbUser, $dbPass){
        if(is_null($this->db)){
            try {
              $this->db = new PDO("mysql:dbname=".$dbName,$dbUser,$dbPass);
				      $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
              echo 'Connection failed: ' . $e->getMessage();
            }
        }
        $this->query("SET NAMES UTF8");
    }

    public function query($sql, $params=array()){
        if(!$p=$this->db->prepare($sql)){
            $e=$this->db->errorInfo();
            throw new Exception("<pre>".$e[2]."\n$sql (".implode(", ",$params).")</pre>");
        }
        if (!$p->execute($params)) {
            $e=$this->db->errorInfo();
            throw new Exception("<pre>".$e[2]."\n$sql (".implode(", ",$params).")</pre>");
        }
        return $p;
    }

    public function querykeyvalues($sql, $params=array()){
        $p=$this->query($sql,$params);
        $tmp=array();
        while ($a=$p->fetch(PDO::FETCH_NUM)) {
            $tmp[$a[0]]=$a[1];
        }
        return $tmp;
    }

    public function queryarray($sql, $params=array()){
        $p=$this->query($sql,$params);
        $tmp = array();
        while ($a=$p->fetch(PDO::FETCH_ASSOC)) {
            $tmp[] = $a;
        }
        return $tmp;
    }
    public function querykeyarray($sql, $params=array(), $key){
        $p=$this->query($sql,$params);
        $tmp = array();
        while ($a=$p->fetch(PDO::FETCH_ASSOC)) {
            $tmp[$a[$key]] = $a;
        }
        return $tmp;
    }

    public function queryrow($sql, $params=array()){
        $p=$this->query($sql,$params);
        while ($a=$p->fetch(PDO::FETCH_ASSOC)) {
            return $a;
        }
    }
    public function queryvalue($sql, $params=array()){
        $p=$this->query($sql,$params);
        while ($a=$p->fetch(PDO::FETCH_NUM)) {
            return $a[0];
        }
    }
    private function placeholders($text, $count=0, $separator=","){
        $result = array();
        if($count > 0){
            for($x=0; $x<$count; $x++){
                $result[] = $text;
            }
        }

        return implode($separator, $result);
    }

    public function queryinsert($table,$params){
        $tmp=array();
        $qry="";$commas="";
        foreach ($params as $fn=>$cap) {
            if(is_array($cap)){
                $array=true;
                break;
            }
            $commas.=($commas!="" ? "," : "")."?";
            $tmp[]=$params[$fn];
        }
        if(isset($array)){

            $this->db->beginTransaction();
            $insert_values = array();

            foreach($params as $fn=>$cap){
                $datafields[]=$fn;
                $items=count($cap);
            }


            for($i=0; $i<$items; $i++){
                $question_marks[] = '('  . $this->placeholders('?', count($params)) . ')';
                $val=array();
                foreach($datafields as $d){
                    $val[] = $params[$d][$i];
                }
                $insert_values = array_merge($insert_values, array_values($val));
            }

            $sql = "INSERT INTO $table (" . implode(",", $datafields ) . ") VALUES " . implode(',', $question_marks);
            $stmt = $this->db->prepare ($sql);
            try {
                $stmt->execute($insert_values);
            } catch (PDOException $e){
                echo $e->getMessage();
            }
            $this->db->commit();


        }else{
            $qry="insert into $table (`".implode("`,`",array_keys($params))."`) values ($commas)";
            $values=$tmp;
            $this->query($qry,$values);
        }
        return true;
    }

    public function queryupdate($sql, $params=array()){
        $p=$this->query($sql,$params);
        return true;
    }


    public function num_rows($result){
        $p=$this->query($sql,$params);
        return count($p->fetch(PDO::FETCH_NUM));
    }

    public function insert_id(){
        return $this->db->lastInsertId();
    }

}

?>
