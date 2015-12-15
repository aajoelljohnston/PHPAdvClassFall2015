<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Delete
 *
 * @author Ash
 */
class Delete {
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

    public function deleteFile($file){
        unlink('./uploads/'.$file);
    }
    
    public function deleteUserPhotos($filename) {
    $stmt = $this->getDb()->prepare("DELETE FROM photos WHERE filename = :filename");
    $binds = array(
        ":filename" => $filename
    );
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
       return true;
    }
    return false;

    }
}
