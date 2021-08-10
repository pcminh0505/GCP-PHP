<?php
include 'config.php';

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google_Service_Bigquery::BIGQUERY);
$bigquery = new Google_Service_Bigquery($client);
$projectId = 's3818102-asm1';

$request = new Google_Service_Bigquery_QueryRequest();
$columns = "ID,Name,Subtype,Status,Country,ProvinceState,District,Latitude,Longitude";
$start = 0;
$currentPage = 1;

$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $currentPage = $page;
    $start = ($page - 1) * $limit;
} else {
    $page = 1;
}
$where = "";
$countrybq = isset($_GET['countrybq']) ? $_GET['countrybq'] : '';
$namebq = isset($_GET['namebq']) ? $_GET['namebq'] : '';

if (!empty($countrybq) and !empty($namebq)) {
    $where = "WHERE Name LIKE '%$namebq%' AND Country = '$countrybq'";
} elseif (!empty($_GET['countrybq']) and empty($_GET['namebq'])) {
    $where = "WHERE Country = '$countrybq'";
} elseif (!empty($_GET['namebq']) and empty($_GET['countrybq'])) {
    $where = "WHERE Name LIKE '%$namebq%'";
}
function getTotalRows($condition)
{
    $c = new Google_Client();
    $c->useApplicationDefaultCredentials();
    $c->addScope(Google_Service_Bigquery::BIGQUERY);
    $bq = new Google_Service_Bigquery($c);
    $pid = 's3818102-asm1';
    $rq = new Google_Service_Bigquery_QueryRequest();
    $rq->setQuery("SELECT * FROM [pcminh_asm1.mekongproject] $condition");
    $rp = $bq->jobs->query($pid, $rq);
    $count = 0;
    foreach ($rp as $row) {
        $count++;
    }
    return $count;
}

$Previous = $page - 1;
$Next = $page + 1;

$DATA_COUNT = getTotalRows($where);
$lastPage = ceil($DATA_COUNT / $limit);
$request->setQuery("SELECT $columns FROM [pcminh_asm1.mekongproject] $where ORDER BY ID LIMIT $limit OFFSET $start");

$response = $bigquery->jobs->query($projectId, $request);
$rows = $response->getRows();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mekong Project Management</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<header>
    <link rel="stylesheet" href="css/table.css" />
</header>

<!-- NAVAGATION -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top ">
    <a class="navbar-brand" href="#">COSC2638 - Assignment 1</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="home">Project Management</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="bigquery">Project BigQuery<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Additional App</a>
            </li>
        </ul>
    </div>
</nav>
<br><br><br>

<body>
    <div class="container-fluid">
        <form class="form-horizontal" method="GET" action="#">
            <div class="row justify-content-center">
                <h2 class="text-center text-dark">Mekong Infrastructure Tracker (Search & Filter)</h2>
            </div>
            <!-- Button trigger to add new project -->
            <div class="row">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Displaying projects from</span>
                    </div>
                    <div class="input-group-prepend">
                        <select class="custom-select" name="countrybq" style="max-width: 200px">
                            <option value selected>All Countries</option>
                            <?php foreach (["Vietnam", "Thailand", "Laos", "Myanmar", "Cambodia", "China"] as $country) : ?>
                                <option <?php if (isset($_GET["countrybq"]) && $_GET["countrybq"] == $country) echo "selected" ?> value="<?= $country; ?>"><?= $country; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input class="form-control" name="namebq" type="text" value="<?= $namebq ?>" placeholder="Search Project Name">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <table class="table table-bordered" id="header-fixed">
                <thead class="table-info">
                    <tr>
                        <th>ID</th>
                        <th>Project Name</th>
                        <th>Subtype</th>
                        <th>Current Status</th>
                        <th>Country</th>
                        <th>Province/State</th>
                        <th>District</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <!-- <th>More Details</th> -->
                    </tr>
                </thead>
                <tbody>
                    </tr>
                    <?php foreach ($rows as $row) {
                        echo "<tr>";
                        foreach ($row['f'] as $field) {
                            echo "<td>" . $field['v'] . "</td>";
                        } ?>
                    <?php }
                    echo "<tr>"; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm">
                    <div class="input-group">
                        <input id="limit-records" type="number" min="10" name="limit" class="form-control" value="<?= $limit ?>" placeholder="Default: 10" style="max-width:150px">
                        <button button class="btn btn-primary" type="submit">Set page size</button>
                    </div>
                </div>
                <div class="col-sm">
                    <ul class="pagination">
                        <li class="page-item <?= $page == 1 ? 'disabled' : ''; ?>"><a class="page-link" href="?countrybq=<?= $countrybq ?>&namebq=<?= $namebq ?>&page=<?= $Previous ?>&limit=<?= $limit ?>">Previous</a></li>
                        <?php if ($page >= 3) { ?>
                            <li class="page-item">
                                <a class="page-link" href="??countrybq=<?= $countrybq ?>&namebq=<?= $namebq ?>&page=1&limit=<?= $limit ?>">1</a>
                            </li>
                        <? } ?>
                        <?php
                        $superset_range = range(1, $lastPage - 1);
                        $subset_range = range($page - 1, $page + 1);
                        // adjust the range(if required)
                        foreach ($subset_range as $p) {
                            if ($p < 1) {
                                array_shift($subset_range);
                                if (in_array($subset_range[count($subset_range) - 1] + 1, $superset_range)) {
                                    $subset_range[] = $subset_range[count($subset_range) - 1] + 1;
                                }
                            } elseif ($p > $lastPage - 1) {
                                array_pop($subset_range);
                                if (in_array($subset_range[0] - 1, $superset_range)) {
                                    array_unshift($subset_range, $subset_range[0] - 1);
                                }
                            }
                        }
                        // display intermediate pagination links
                        if ($subset_range[0] > $superset_range[0]) {
                            echo " ... &nbsp;";
                        }
                        foreach ($subset_range as $p) {
                            $class = '';
                            if ($currentPage == $p) {
                                $class = 'active';
                            }
                            echo "<li class='paginate_button page-item $class'><a href='?countrybq=$countrybq&namebq=$namebq&page=$p&limit=$limit' class='page-link'>$p</a></li>";
                        }
                        if ($subset_range[count($subset_range) - 1] < $superset_range[count($superset_range) - 1]) {
                            echo "&nbsp; ... ";
                        }
                        ?>
                        <li class="paginate_button page-item <?= $page == $lastPage ? 'active' : ''; ?>">
                            <a class="page-link" href="?countrybq=<?= $countrybq ?>&namebq=<?= $namebq ?>&page=<?= $lastPage ?>&limit=<?= $limit ?>"><?= $lastPage ?></a>
                        </li>
                        <li class="page-item <?= $page == $lastPage ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?countrybq=<?= $countrybq ?>&namebq=<?= $namebq ?>&page=<?= $Next ?>&limit=<?= $limit ?>">Next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</body>

</html>