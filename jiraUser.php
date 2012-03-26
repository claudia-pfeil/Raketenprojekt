<?php

/**
 * Description of AddJiraUser
 *
 * @author Claudia Pfeil
 */
class AddJiraUser {

    function addUser($client, $token, $new_username, $new_password, $new_fullname, $new_email){
        try {
            $result = $client->createUser($token, $new_username, $new_password, $new_fullname, $new_email);
            $out[] = "Created user $new_username";
            $out[] = "Result:";
            $out[] = print_r($result, true);
        }
        catch (SoapFault $fault) {
            $out[] = "Error creating user $username";
            $out[] = $fault;
        }

        return $out;
    }

}
