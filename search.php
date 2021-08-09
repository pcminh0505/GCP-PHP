<?php
    include 'config.php';

    $client = new Google_Client();
    $client->useApplicationDefaultCredentials();
    $client->addScope(Google_Service_Bigquery::BIGQUERY);
    $bigquery = new Google_Service_Bigquery($client);
    $projectId = 's3818102-asm1';

    $request = new Google_Service_Bigquery_QueryRequest();
    $str = '';
    
    $request->setQuery("SELECT ID,Name,Subtype,Status,Country,ProvinceState,District,Latitude,Longitude FROM [pcminh_asm1.mekongproject] LIMIT 10");
    
    $response = $bigquery->jobs->query($projectId, $request);
    $rows = $response->getRows();

    foreach ($rows as $row) {
        print_r($row);
    }
?>