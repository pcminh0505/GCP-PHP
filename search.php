<?php
    include 'config.php';

    $client = new Google_Client();
    $client->useApplicationDefaultCredentials();
    $client->addScope(Google_Service_Bigquery::BIGQUERY);
    $bigquery = new Google_Service_Bigquery($client);
    $projectId = 's3818102-asm1';

    $request = new Google_Service_Bigquery_QueryRequest();

    $columns = "ID,Name,Subtype,Status,Country,ProvinceState,District,Latitude,Longitude";
    $DATA_COUNT = 1808;
    $start = 0;
    $currentPage = 1;

    $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $currentPage = $page;
        $start = ($page - 1) * $limit;
    } else {$page = 1;}

    $Previous = $page - 1;
    $Next = $page + 1;

    $lastPage = ceil($DATA_COUNT / $limit);
    $request->setQuery("SELECT $columns FROM [pcminh_asm1.mekongproject] ORDER BY ID LIMIT $limit OFFSET $start");
    
    $response = $bigquery->jobs->query($projectId, $request);
    $rows = $response->getRows();
    
?>