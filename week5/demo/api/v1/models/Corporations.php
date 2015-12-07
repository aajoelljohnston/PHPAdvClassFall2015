<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Corporations
 *
 * @author Ash
 */
class Corporations implements iRestModel {
    //put your code here
    private $db;

    function __construct() {

        $util = new Util();
        $dbo = new DB($util->getDBConfig());
        $this->setDb($dbo->getDB());
    }

    private function getDb() {
        return $this->db;
    }

    private function setDb($db) {
        $this->db = $db;
    }

    public function getAll() {

        $stmt = $this->getDb()->prepare("SELECT * FROM corps");
        //An Array Of Results Is Created
        $results = array();
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $results;
    }

    public function get($id) {

        $dataResults = array();

        $stmt = $this->getDb()->prepare("SELECT * FROM corps WHERE id = :id");
        $binds = array(
            ":id" => $id
        );

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
          
            $dataResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $dataResults;
    }
    public function post($getData) {
        $stmt = $this->getDb()->prepare("INSERT INTO corps SET corp = :corp, incorp_dt = :incorp_dt, email = :email, owner = :owner, phone = :phone, location = :location");
        $binds = array(
            ":corp" => $getData['corp'],
            ":incorp_dt" => date("F j, Y, g:i a"),
            ":email" => $getData['email'],
            ":owner" => $getData['owner'],
            ":phone" => $getData['phone'],
            ":location" => $getData['location']
        );

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function put($getData, $id) {
        $dataResults = array();           
        $stmt = $this->getDb()->prepare("UPDATE corps SET corp = :corp, incorp_dt = :incorp_dt, email = :email, owner = :owner, phone = :phone, location = :location WHERE id= :id  ");
        $binds = array(
            ":id" => $id,
            ":corp" => $getData['corp'],
             ":incorp_dt" => $getData ['incorp_dt'],
            ":email" => $getData['email'],
            ":owner" => $getData['owner'],
            ":phone" => $getData['phone'],
            ":location" => $getData['location']
        );
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $dataResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "Record updated sucessfully" . $id;
        }
        return $dataResults;
    }

    public function delete($id) {
            $results = false;
        $stmt = $this->getDb()->prepare("DELETE FROM corps Where id = :id");
        $binds = array(":id" => $id);

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = true;
        }

        return $results;
    }

}
