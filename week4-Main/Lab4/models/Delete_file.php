<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Delete_file
 *
 * @author Ash
 */
class Delete_file {
    //put your code here
    // IF File Exist by File Name Delete
    public function f_Delete($file) {

        if (unlink('./pic_upload/' . $file)) {
            throw new RuntimeException('File has not been Deleted' . $file);
        } else {
            echo 'File Has been Deleted' . '' . $file;
        }
    }
}
