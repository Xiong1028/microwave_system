/*
*   Purpose: this class is used to handle the mysql databases
*   Authors:  X.Li
*   Date: Feb 7, 2019
*
*/

<?php
class DB{
    private $db_conn;
    private $config = array(
        'DB_HOST'=>'localhost',
        'DB_USER'=>'lamp2user',
        'DB_PASSWD' =>'Test123!',
        'DB_NAME'=>''
    );
    

    function __constructor($hostname,$username,$pwd,$dbname){
        $this->db_conn = new mysqli($hostname,$username,$pwd,$dbname);
        if($this->db_conn->connect_errno){
            die("Could not connect to database server" . $hostname . "\n Error: " . $this->db_conn->connect_errno . "\n Report: " . $this->db_conn->connect_error . "\n");
        }
    }


    //define a method to disconnect database
    public function disconnectDB(){
        $this->$db_conn->close();
    }






}
?>
