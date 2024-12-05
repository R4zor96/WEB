<?php
    require_once(__DIR__.'/../config/Connect.php');

    class Tabla_roles {
        private $connect;
        private $table = 'roles';
        private $primary_key = 'id_rol';

        public function __construct() {
            $db = new Connect();
            $this->connect = $db->connect;
        }//end __construct


        public function readAllRoles(){
            /**
                QUERY - SELECT
                SELECT * FROM roles ;
             */
            $sql = "SELECT * FROM ".$this->table." ORDER BY rol ASC;" ;
            try{
                //PREPARE THE STATEMENT
                $stmt = $this->connect->prepare($sql);
                //SPECIFIC FECTH MODE BEFORE CALLING FETCH
                $stmt->setFetchMode(PDO::FETCH_OBJ);
                //EXECUTE THE QUERY
                $stmt->execute();
                //RETURN THE FETCHED RESULT
                $rols = $stmt->fetchAll();
                return (!empty($rols)) ? $rols : array();
            }//end try
            catch(PDOException $e){
                echo "Error in query: ". $e->getMessage();
            }//end catch
        }//end readAllRoles

    }//end roles