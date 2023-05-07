<?php
    
    class Qna{
        public $db;
        function __construct()
        {
            $this->db = new Database();
        }

        function get_qna(){
            try{
                $query =  $this->db->conn->query("SELECT * FROM qna");
                $qna = $query->fetchAll(PDO::FETCH_OBJ);
                return $qna;
              }catch(PDOException $e){
                print_r($e->getMessage());
            }   
        }
    }
    $Qna = new Qna();
    
?>