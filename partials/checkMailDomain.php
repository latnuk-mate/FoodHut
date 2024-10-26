
<?php 

function checkMail($email){
    $domain = substr(strrchr($email, "@"), 1); // Get domain part of the email.
    
    if (checkMailDomainExists($domain)) {
        return true;
    } else {
        return false;
    }
}


function checkMailDomainExists($domain) {
    return checkdnsrr($domain, "MX");
}


?>

