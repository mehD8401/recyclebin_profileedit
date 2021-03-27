<?php

    class model_edit_profile{
        private $conn;
        private $table = 'user_info';
        private $id_table = 'user_id';


        public function __construct($db){
            $this->conn = $db;
        }

        //get post
        private function xcute($query){

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        
        private function update_name($email, $name){

            $query = "UPDATE `user_id` SET `name` = '$name' WHERE `user_id`.`email` = '$email';"; //"UPDATE user_id SET `name` = ".$name." WHERE `user_id`.`email` = '".$email."';";
            $stmt = $this->conn->prepare($query);

            if( $stmt->execute() ){
                return true;
            }else{
                return false;
            }

        }

        private function insert_info($email, $address, $description, $phone, $profile_pht){

            $query = "INSERT INTO "
                        .$this->table." (email, address, description, phone_no, total_given_ad, profile_photo)"
                        ." VALUES ('$email', '$address', '$description', '$phone', '0', '$profile_pht');";
            $stmt = $this->conn->prepare($query);

            if( $stmt->execute() ){
                return true;
            }else{
                return false;
            }

        }

        private function update_info($email, $address, $description, $phone, $profile_pht){

            $query = "UPDATE ".$this->table
                    ." SET address = '$address', description = '$description', phone_no = '$phone', profile_photo = '$profile_pht' WHERE ".$this->table.".email = '$email';";
            $stmt = $this->conn->prepare($query);
            
            if( $stmt->execute() ){
                return true;
            }else{
                return false;
            }

        }

        public function edit($email, $name, $address, $description, $phone, $profile_pht){

            $query = "SELECT email FROM ".$this->table." WHERE ".$this->table.".email = '$email';";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            if($stmt->rowCount()>0){
                if(!$this->update_info($email, $address, $description, $phone, $profile_pht) || !$this->update_name($email, $name)){
                    return false;
                }
                
            }else {
                if(!$this->insert_info($email, $address, $description, $phone, $profile_pht) || !$this->update_name($email, $name)){
                    return false;
                }
            }
            return true;
        }

    }

    


?>
