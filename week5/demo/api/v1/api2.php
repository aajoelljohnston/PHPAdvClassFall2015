<?php require_once './autoload.php'; ?>
<?php

try {
    // Rest Server Class New Instance
    $restServer = new RestServer ();
    //Rest Server starts with a 200 message 
    $restServer->setStatus(200);


    //Rest Server Variables
    $resource = $restServer->getResource(); //Get the Resources
    $verb = $restServer->getVerb(); //Get the Verb
    $getData = $restServer->getServerData(); //Get Data
    $id = $restServer->getId(); //Get ID
 
    //Get, Put, Post, Delete
 
    if ($resource === 'corps') {
        $resourceCorps = new Corporations(); //Corporations New Instance
        $dataResults = null;


        if ($verb === 'GET') {
            if ($id === NULL) {
                $dataResults = $resourceCorps->getAll();
            } else {
                $dataResults = $resourceCorps->get($id);
            }
        }

        if ($verb === 'PUT') {

            if ($id === NULL) {
                throw new InvalidArgumentException('Corporation ID ' . $id . ' was not found');
            } else {
                $dataResults = $resourceCorps->put($getData, $id);
            }
        }
 
        if ($verb === 'POST') {


            if ($resourceCorps->post($getData)) {
                $restServer->setMessage('New Corporation Information Added');
                $restServer->setStatus(201);

            } else {
                throw new Exception('Corporation could not be added');
            }
        }

        if ($verb === 'DELETE') {

            if ($id === NULL) {
                throw new InvalidArgumentException('Id required');
           
            } else {
                if ($resourceCorps->delete($id)) {
                    $restServer->setMessage($id . ' Has been deleted');
                }
            }
        }
        
        $restServer->setData($dataResults);
    }
} catch (Exception $ex) {
    $restServer->setErrors($ex->getMessage());
    $restServer->setStatus(500);
}

$restServer->outputResponse();