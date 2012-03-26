<?php

/*author:    Clauida Pfeil
*date:   To change this template, choose Tools | Templates
*date:   and open the template in the editor.
*description:     */

include_once 'bootstrap.php';

$bootstrap  = new Bootstrap();
#echo 'jaaaaa!';

$client     = $bootstrap->setup(USER_NAME, PASSWORD, WSDL);
#echo 'siiiii!';

// General server info
$server = $client['client']->getServerInfo($client['token']);

// Get statuses
$result = $client['client']->getStatuses($client['token']);
$statuses = array();

foreach ($result as $status) {
    $statuses[$status->id] = $status->name;
}

// Get projects
$projects = $client['client']->getProjectsNoSchemes($client['token']);
foreach ($projects as $project) {
    #var_dump($project);
    $projects[$project->key] = $project;
}

// Get favorite filters
$filters = $client['client']->getFavouriteFilters($client['token']);
var_dump($filters);

/**
 * Construct the org file
 */
$out = array();

// Header

$out[] = "[[BASE_URL][JIRA $server->edition ($server->version)]] (USER_NAME)";
$out[] = '';

foreach ($filters as $filter) {
    // Get issues from a filter
    $out[] = "* Projects ($filter->name)";
    $issues = $client['client']->getIssuesFromFilter($token, $filter->id);
    $projectIssues = array();
    foreach ($issues as $issue) {
        // rearrange issues by project
        $projectIssues[$issue->project][] = $issue;
    }
    // Generate the list of issues, grouped by project
    foreach (array_keys($projectIssues) as $projectKey) {
        $out[] = "** ". $projects[$projectKey]->name;
        foreach ($projectIssues[$projectKey] as $issue) {
            $out[] = "*** [[$base_url/browse/$issue->key][$issue->key]] $issue->summary";
            if ($issue->duedate) {
                $date = date('Y-m-d D', strtotime($issue->duedate));
                $out[] = "    DEADLINE: <$date>";
            }

            $out[] = "    :PROPERTIES:";
            $out[] = "    :status: " . $statuses[$issue->status];
            $out[] = "    :reporter: $issue->reporter";
            $out[] = "    :assignee: $issue->assignee";
            $out[] = "    :END:";
            if ($issue->description) {
                $out[] = '';
                $out[] = $issue->description;
            }
        }
    }
}

// Output
#bootstrap->dump();

