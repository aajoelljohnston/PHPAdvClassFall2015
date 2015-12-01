<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Util
 *
 * @author Ash
 */
class Util {
    //put your code here
    /**
    * A method to check if a Post request has been made.
    *    
    * @return boolean
    */
   public function isPostRequest() {
       return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
   }
   public function getDBConfig() {
       return array(
            'DB_DNS' => 'mysql:host=localhost;port=3306;dbname=phpadvclassfall2015',
            'DB_USER' => 'root',
            'DB_PASSWORD' => ''
        );       
   }
}
