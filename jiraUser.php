<?php

/**
 * Description of AddJiraUser
 *
 * @author Claudia Pfeil
 */
class JiraUser {

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

    function deleteUser($client, $token, $username){
        try {
            $result =   $client->deleteUser();
            $out[]  =   'Deleted user ' . $user_name;
            $out[]  =   'Result:    ';
            $out[]  =   print_r($result, true);
        }  catch (SoapFault $fault){
            $out[]  =   'Error deleting user ' . $user_name;
            $out[]  =   $fault;
        }
    }

}
