<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        echo 'buenos dias mondo!';
        include_once '../bootstrap.php';
        include_once '../jiraUser.php';
        $bootstrap  = new Bootstrap();
        echo 'jaaaaa!';
        $client         = $bootstrap->setup(USER_NAME, PASSWORD, WSDL);
        $jiraUser       = new JiraUser();
        $addJiraUser    = $jiraUser->addUser($client['client'], $client['token'], 'raketen_test', $bootstrap->user_password(), 'Claudia Pfeil', 'claudia.pfeil@rakten-projekte.de');

        foreach($addJiraUser as $message){
            echo $message;
        }

        $removeJiraUser = $jiraUser->deleteUser($client['client'], $client['token'], 'raketen_test');

        foreach($removeJiraUser as $message){
            echo $message;
        }
        ?>

    </body>
</html>

