<?php 
    
    class functions {
        // data member or member variable
        private $db;
        private $result;
        private $fnum;
        private $sql;
        //constructor
        function __construct()
        {
           require_once('DbConnection.php');
           // create an object of class Dbconnection
           $this->db = new DbConnection();
           // call the method of class Dbconnection
           $this->db->connect();
        }
        //destructor
        function __destruct()
        {
            $this->db->close();
        }
        // member methods
        public function insert_data($tablename, $fields, $values)
        {
           // count field in arrya
           $this->fnum = count($fields);
           // generat query string
           $this->sql =  "INSERT INTO $tablename(";
           for($i=0 ; $i < $this->fnum ; $i++){
            $this->sql .= $fields[$i];
            if($i  < $this->fnum - 1){
                $this->sql .= ',';
            }else {
                $this->sql .= ') VALUES(';
            }
            
           }
           for($i = 0; $i < $this->fnum ; $i++){
            $this->sql .= "'".$values[$i]."'";
            if($i<$this->fnum - 1){
                $this-> sql .= ",";
            }else{
                $this->sql .= ");";
            }
           }
           // execute query string
           $this->result = mysqli_query($this->db->connect(),$this->sql);
           if($this->result){
            return true;
           }else {
                return false;
           }
        }

        public function login_user($username, $userpassword){
            $user = mysqli_real_escape_string($this->db->connect(), $username);
            $pwd = mysqli_real_escape_string($this->db->connect(),$userpassword);
            $this->sql = "SELECT * FROM tblusers WHERE UserName='".$username."' AND UserPassword='".$userpassword."'";
            $this->result = mysqli_query($this->db->connect(),$this->sql);
            if(mysqli_num_rows($this->result)==1){
                return $this->result;
            }else {
                return false;
            }
        }

        public function update_data($tablename, $fields, $values, $fid, $vid){
            $this->fnum = count($fields); // Count all elements of Array
            // generate string query
            $this->sql = "UPDATE $tablename SET "; // UPDATE tblusers SET UserName= 'bbu', UserPass= '123
            for( $i=0 ; $i < $this-> fnum ; $i++ ){
                $this-> sql .= $fields[$i]."='".$values[$i]."'";
                if($i < $this -> fnum - 1 ){
                    $this -> sql .= ",";
                }else {
                    $this -> sql .= " WHERE $fid='$vid'";
                }
            }
            // execute string query 
            $this -> result = mysqli_query($this->db->connect(), $this->sql);
            if($this->result){
                return true;
            }else{
                return false;
            }
        }
        
        public function show_data_by_condition($tablename, $fid, $vid)
        {
            // string query
            $this->sql = "SELECT * FROM $tablename WHERE $fid = '$vid';";
            // execute string query
            $this->result = mysqli_query($this->db->connect(), $this->sql); // Procedural
            // $this->result = $this->db->connect()->query($this->sql);// OOP
            # code...
            if($this->result){
                return mysqli_fetch_assoc($this->result);
            }else {
                return false;
            }

        }
    }
?>