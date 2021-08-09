<?php
    include 'config.php';

    $client = new Google_Client();
    $client->useApplicationDefaultCredentials();
    $client->addScope(Google_Service_Bigquery::BIGQUERY);
    $bigquery = new Google_Service_Bigquery($client);
    $projectId = 's3818102-asm1';

    $request = new Google_Service_Bigquery_QueryRequest();
    $str = '';
    $sql = "";

    $pageSize = isset($_POST['pageSize']) ? $_POST['pageSize'] : 10;
    $DATA_COUNT = 1808;
    $lastPage = ceil($DATA_COUNT / $pageSize);

    $start = 0;
    $currentPage = 1;
    if (isset($_GET['start'])) {
        $start = $_GET['start'];
        $currentPage = $start;
        $start--;
        $start *= $pageSize;
    }

    $columns = "ID,Name,Subtype,Status,Country,ProvinceState,District,Latitude,Longitude";
    $where = "";


    $request->setQuery("SELECT $columns FROM [pcminh_asm1.mekongproject] LIMIT $pageSize OFFSET $start");
    
    $response = $bigquery->jobs->query($projectId, $request);
    $rows = $response->getRows();


?>