<?php 
    class DbConnection{
    // data member or member variable
    private $conn;
    // constructor
    function __construct()
    {
        require_once('config.php');
        $this->connect();
    }
    // destructor
    function __destruct()
    {
        $this->close();
    }
    //method
    public function connect() {
        $this->conn = mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME);
        if($this->conn){
            return $this->conn;
        }else{
            return die("Cannot Connect to Database\n". mysqli_error($this->connect()));
        }
    }
    
    public function close(){
            mysqli_close($this->connect());
    }

}
?>