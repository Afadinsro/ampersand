<?php

if(isset($_POST['getEmail'])){
    validate();
}


function validate(){
    $email = $_POST['email'];
    $emailPattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    
        echo '<script language="javascript">';
        echo 'alert("Your email address is not valid.Try again")';
        echo '</script>';
    
    }
    else{
        echo '<script language="javascript">';
        echo 'alert("Your email has successfully been submitted")';
        echo '</script>';
        
        $url = "https://test.doseyapp.com/api/early_access";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array("email" => "$email")));
        curl_exec($curl); 
        $response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        
        echo '<script language="javascript">';
        echo "alert('Response code: $response')";
        echo '</script>';
        
    }
}

?>
