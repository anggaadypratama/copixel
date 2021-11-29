<?php 
    class DB{
        public $que;
        private $servername='localhost';
        private $username='root';
        private $password='root';
        private $dbname='db_copixel';
        private $result=array();
        private $mysqli='';


        public function __construct(){
            $this->mysqli = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
            if($this -> mysqli -> connect_errno){
                echo "Failed to connect to MySQL: " . $this -> mysqli -> connect_error. "<br>";
                echo 'Errno: '.$this -> mysqli ->connect_errno;
                echo '<br>';
                echo 'Error: '.$this -> mysqli -> connect_error;
                exit();
            }
        }

        public function insert($table,$para=array()){

            $table_columns = implode(',', array_keys($para));
            $table_value = implode("','", $para);

            $sql="INSERT INTO $table($table_columns) VALUES('$table_value')";

            $result = $this->mysqli->query($sql);

                if(!$result){
                    echo("Error description: " . $this -> mysqli -> error);
                }else{
                    return $result;
                }
        }

        public function update($table,$para=array(),$id){
            $args = array();

            foreach ($para as $key => $value) {
                $args[] = "$key = '$value'"; 
            }

            $sql="UPDATE  $table SET " . implode(',', $args);

            $sql .=" WHERE $id";

            $result = $this->mysqli->query($sql);
            isError($result, $this->mysqli);
        }

        public function delete($table,$id){
            $sql="DELETE FROM $table";
            $sql .=" WHERE $id ";
            $sql;
            $result = $this->mysqli->query($sql);

            if(!$result){
                echo("Error description: " . $this -> mysqli -> error);
            }else{
                echo "<br> Dihapus";
            }
        }

        public $sql;

        public function select($table,$rows="*",$where = null){
            if ($where != null) {
                $sql="SELECT $rows FROM $table WHERE $where";
            }else{
                $sql="SELECT $rows FROM $table";
            }

            $result = $this->mysqli->query($sql);

            if(!$result){
                echo("Error description: " . $this -> mysqli -> error);
            }
            
            $this->sql = $result;
        }

        public function __destruct(){
            $this->mysqli->close();
        }
    }