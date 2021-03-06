<?php

use Google\Cloud\BigQuery\BigQueryClient;
// FOR CRUD PROBLEM
// Get whole data to an array
function getData($filename)
{
    $data = array();

    $fp = fopen($filename, "r");
    while ($line = fgetcsv($fp)) {
        $records[] = $line;
    }

    fclose($fp);
    return $records;
}

// Get the latest ID, +1 to assign to new record
function getLastestId($filename)
{
    $data = getData($filename);
    if (count($data) > 0) {
        $id = $data[count($data) - 1][0];
    } else {
        $id = 1;
    }
    return $id;
}

//Clean the input text
function cleanInput($string)
{
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

// ----------------------------------------------------------------
// FOR BIGQUERY PROBLEM
// Get total number of rows from query with condition
function getTotalRows($condition, $table)
{
    $pid = 's3818102-asm1';
    $bigQuery = new BigQueryClient([
        'projectId' => $pid,
    ]);
    $jobConfig = $bigQuery->query("SELECT COUNT(*) total_result FROM $table $condition");
    $job = $bigQuery->startQuery($jobConfig);
    $queryResults = $job->queryResults();

    foreach ($queryResults as $row) {
        return $row['total_result'];
    }
    return 0;
}

function queryDetails($i)
{
    $c = new Google_Client();
    $c->useApplicationDefaultCredentials();
    $c->addScope(Google_Service_Bigquery::BIGQUERY);
    $bq = new Google_Service_Bigquery($c);
    $pid = 's3818102-asm1';
    $rq = new Google_Service_Bigquery_QueryRequest();
    $rq->setQuery("SELECT * FROM [pcminh_asm1.mekongproject] WHERE ID = $i");

    $rp = $bq->jobs->query($pid, $rq);
    $data = array();
    foreach ($rp as $row) {
        foreach ($row['f'] as $field) {
            array_push($data, $field['v']);
        }
    }
    return $data;
}
