<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <a href="../index.php">Main Page</a></br><a href="../views/view-address.php">View Addresses</a>
    </head>
    <body>
        <?php
        // put your code here
        
        require_once '../functions/dbconnect.php';
        require_once '../functions/until.php';
        
        $fullName = filter_input(INPUT_POST, 'fullname');
        $email = filter_input(INPUT_POST, 'email');
        $addressLine1 = filter_input(INPUT_POST, 'addressline1');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $zip = filter_input(INPUT_POST, 'zip');
        $birthday = filter_input(INPUT_POST, 'birthday');
        
        $zipRegex = "/^([0-9]{5})(-[0-9]{4})?$/i";
        
        
        $addresses = getAllAddress();
        $errors = array();
        
        if ( isPostRequest() ) {
            
            
            if ( empty($fullName) ) {
                $errors[] = 'Your Name Must be Filled In';
            }  
            if ( empty($email) ) {
                $errors[] = 'Email is Empty';
            }  
            if ( empty($addressLine1) ) {
                $errors[] = 'Your Address is Empty';
            }  
            if ( empty($city) ) {
                $errors[] = 'City Must be Filled In';
            }  
            if ( empty($state) ) {
                $errors[] = 'State is Empty';
            }  
            if ( empty($zip) || !preg_match($zipRegex, $zip) ) {
                $errors[] = 'Zip is Empty or Not in the Correct Format';
            }  
            if ( empty($birthday) ) {
                $errors[] = 'Birthday Cannot be Empty'; 
            }  
            if (count($errors)== 0 && addAddress($fullName, $email, $addressLine1, $city, $state, $zip, $birthday ) ) {
                $message = 'Address Added';
                $fullName = '';
                $email = '';
                $addressLine1 = '';
                $city = '';
                $state = '';
                $zip = '';
                $birthday = '';
            }
            
            
        }
                
        include '../views/messages.php';  
        include '../views/errors.php';  
        
        include '../views/add-address.php';
        ?>
        
        
        
    </body>
</html>

