<?php
  include_once("Database.php");
    class MyPortfolio
    {
        public $db;

        function get_portfolio()
        {
            $this->db = new Database();
            try {
                $query = $this->db->conn->query("SELECT * FROM portfolio");
                $portfolio = $query->fetchAll(PDO::FETCH_OBJ);
                return $portfolio;
            } catch (PDOException $e) {
                    print_r($e->getMessage());
            } 
        }
    }
   $Portfolio = new MyPortfolio();
?>