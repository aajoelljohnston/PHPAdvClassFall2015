<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of File_upload
 *
 * @author Ash
 */
class File_upload {
    //put your code here
    //Confirms that the upfile is not set to true and give appropriate errors according

    public function File_Parameters($upfile) {

        if (!isset($_FILES[$upfile]['error']) || is_array($_FILES[$upfile]['error'])) {
            throw new RuntimeException('Invalid parameters.');
        }
        // $_FILES['upfile']['error'] get checked for the value.
        switch ($_FILES[$upfile]['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('The File has not been sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Exceeded filesize limit.');
            default:
                throw new RuntimeException('Unknown errors.');
        }
    }

    //Confirms that upload does not exceed the max file size
    public function IsSizeValid($upfile) {

        if ($_FILES[$upfile]['size'] > 1000000) {
            throw new RuntimeException('Exceeded filesize limit.');
        }
    }

    /*
     * File_TypeValid function that give info on files and returns MIME type 
     */

    public function File_TypeValid($upfile) {

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $validExts = array(
            'txt' => 'text/plain',
            'html' => 'text/html',
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif'
        );


        $file_Type = pathinfo($upfile, PATHINFO_EXTENSION);
        $ext = array_search($finfo->file($_FILES[$upfile]['tmp_name']), $validExts, true);


        if (false === $ext) {
            throw new RuntimeException("Invalid file format,$file_Type");
        } else {
            $this->isFileUploaded($ext, $upfile);
        }
    }

    // Give file a unique name
    public function isFileUploaded($ext, $upfile) {
        $fileName = sha1_file($_FILES[$upfile]['tmp_name']);
        $location = sprintf('./pic_upload/%s.%s', $fileName, $ext);
        $this->moveFile($location, $upfile);
    }

    //If functions pass test files are added to the folder directory
    public function addFile($upfile) {

        $this->File_Parameters($upfile);
        $this->IsSizeValid($upfile);
        $this->File_TypeValid($upfile);
    }

// Creates new folder and moves pics to this directory
    public function moveFile($location, $upfile) {
        if (!is_dir('./pic_upload')) {
            //mkdir — Makes directory
            mkdir('./pic_upload');
        }
        if (!move_uploaded_file($_FILES[$upfile]['tmp_name'], $location)) {
            throw new RuntimeException('The uploaded File has Failed to Move.');
        }
        echo 'The File has been uploaded successfully.';
    }
}
