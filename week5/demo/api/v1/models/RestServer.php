<?php

/**
 * Description of RestServer
 *
 * @author GFORTI
 */
class RestServer {
    
    private $status = 200;
    private $status_codes = array(
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Access Forbidden',
        404 => 'Not Found',
        409 => 'Conflict',
        500 => 'Internal Server Error',
    );
    // responds with data or called payload

    private $response = array(
        "message" => NULL,
        "errors" => NULL,
        "data" => NULL
    );
     
    private $id; 
    private $resource;
    private $verb;  
    private $serverData;

     
    public function __construct() {
        
        header("Access-Control-Allow-Orgin: *");
        //
        header("Access-Control-Allow-Methods: GET, POST, UPDATE, DELETE");
        // content type goes 
        header("Content-Type: application/json; charset=utf8");

        $this->getRestArgs();
        $this->setVerb();
        $this->setServerData();
        $this->getId();
    }
    
       function getServerData() {
        return $this->serverData;
    }

    private function setServerData() {
        if (strpos(filter_input(INPUT_SERVER, 'CONTENT_TYPE'), "application/json") !== false) {
            $this->serverData = json_decode(trim(file_get_contents('php://input')), true);


            switch (json_last_error()) {
                case JSON_ERROR_NONE: 
                    {
                       //Client Recieves and sends data          
                    }
                    break;
                case JSON_ERROR_SYNTAX:
                case JSON_ERROR_UTF8:
                case JSON_ERROR_DEPTH:
                case JSON_ERROR_STATE_MISMATCH:
                case JSON_ERROR_CTRL_CHAR:
                    throw new Exception(json_last_error_msg());
                    break;
                default:
                    throw new Exception('JSON encode error Unknown error');
                    break;
            }
        }
    }

  
    public function setResponse($response) {
        $this->response = $response;
    }


    public function getId() {
        return $this->id;
    }

    public function getResource() {
        return $this->resource;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setMessage($message) {
        $this->response ["message"] = $message;
    }

    public function setErrors($errors) {
        $this->response ["errors"] = $errors;
    }

    public function setData($data) {
        $this->response ["data"] = $data;
    }

    function setStatus($status) {
        $this->status = $status;


        if (!array_key_exists($status, $this->status_codes)) {
            throw new Exception("Unexpected Header Requested " . $status);
        }
        $this->status;
    }

    public function outputResponse() {

        header("HTTP/1.1 " . $this->getStatus() . " " . $this->status_codes[$this->getStatus()]);
        echo json_encode($this->response, JSON_PRETTY_PRINT);
    }

    public function getRestArgs() {

        $endpoint = filter_input(INPUT_GET, 'endpoint');
        $restArgs = explode('/', rtrim($endpoint, '/'));

        $this->resource = array_shift($restArgs);
        $this->id = NULL;
        
        if (isset($restArgs[0]) && is_numeric($restArgs[0])) {
            $this->id = intval($restArgs[0]);
        }
    }
 
    public function getVerb() {

        return $this->verb;
    }

    function setVerb() {

        $this->verb = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

        $verbs_allowed = array('GET', 'POST', 'PUT', 'DELETE');

        if (!in_array($this->verb, $verbs_allowed)) {
            throw new Exception("Unexpected Header Requested " . $this->verb);
        }
    }

}
