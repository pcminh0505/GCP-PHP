<?php
include 'config.php';
require_once('function.php');

// Initialize Google Client & Google BigQuery
$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google_Service_Bigquery::BIGQUERY);
$bigquery = new Google_Service_Bigquery($client);
$projectId = 's3818102-asm1';
$dataset = "[pcminh_asm1.mekongproject]";
$tbname = "s3818102-asm1.pcminh_asm1.mekongproject";
$request = new Google_Service_Bigquery_QueryRequest();

// Only select the required fields
$columns = "ID,Name,Subtype,Status,Country,ProvinceState,District,Latitude,Longitude";
$start = 0; // Initialize variable for OFFSET while querying
$currentPage = 1; // Variable to keep track of current page (for 'active' displaying)

// Get the page limit
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10;

// Get the page index
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $currentPage = $page;
    $start = ($page - 1) * $limit; // Calculate the OFFSET
} else {
    $page = 1;
}

// Set value for previous and next page
$Previous = $page - 1;
$Next = $page + 1;

$where = ""; // Initialize the condition while query
// Get the filter variable for "country" and "name"
$countrybq = isset($_GET['countrybq']) ? $_GET['countrybq'] : '';
$namebq = isset($_GET['namebq']) ? $_GET['namebq'] : '';
$namelower = strtolower($namebq);
// Set the condition based on value input from "country" and "name"
if (!empty($countrybq) and !empty($namebq)) {
    $where = "WHERE LOWER(Name) LIKE '%$namelower%' AND Country = '$countrybq'";
} elseif (!empty($_GET['countrybq']) and empty($_GET['namebq'])) {
    $where = "WHERE Country = '$countrybq'";
} elseif (!empty($_GET['namebq']) and empty($_GET['countrybq'])) {
    $where = "WHERE LOWER(Name) LIKE '%$namelower%'";
}

// Get total number of rows from query with condition
$DATA_COUNT = getTotalRows($where, $tbname);

// Calculate the last page value
$lastPage = ceil($DATA_COUNT / $limit);

// Send query request to Google BigQuery and store API response in $rows
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
    <title>BigQuery Mekong Project</title>

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
                <a class="nav-link" href="dashboard">Additional App</a>
            </li>
        </ul>
    </div>
</nav>
<br><br><br>

<body>
    <div class="container-fluid">
        <form method="GET" action="#">
            <div class="row justify-content-center">
                <h2 class="text-center text-dark">Mekong Infrastructure Tracker (Search & Filter)</h2>
            </div>
            <!-- Button trigger to add new project -->
            <div class="input-group">
                <!-- Display text -->
                <div class="input-group-prepend">
                    <span class="input-group-text">Displaying projects from</span>
                </div>
                <!-- Dropdown box for selecting country -->
                <div class="input-group-prepend">
                    <select class="custom-select" name="countrybq" style="max-width: 200px">
                        <option value selected>All Countries</option>
                        <?php foreach (["Vietnam", "Thailand", "Laos", "Myanmar", "Cambodia", "China"] as $country) : ?>
                            <option <?php if (isset($_GET["countrybq"]) && $_GET["countrybq"] == $country) echo "selected" ?> value="<?= $country; ?>"><?= $country; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Input box for project name -->
                <input class="form-control" name="namebq" type="text" value="<?= $namebq ?>" placeholder="Search Project Name" style="max-width:3800px;">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
            <!-- Table -->
            <table class="table table-bordered table-striped table-hover" id="header-fixed">
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
                        <th>More Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($lastPage == 0) echo "<span class='badge badge-pill badge-danger'>No data found</span>" ?>
                    <?php foreach ($rows as $row) :
                        echo "<tr>";
                        $tmp = 0;
                        $id = 0;
                        foreach ($row['f'] as $field) {
                            echo "<td>" . $field['v'] . "</td>";
                            if ($tmp == 0) {
                                $id = $field['v'];
                            }
                            $tmp++;
                        } ?>
                        <td>
                            <a href="form?viewbq=<?= $id; ?>" class="btn btn-warning btn-sm">Details
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                            </a>
                        </td>
                    <?php endforeach;
                    echo "<tr>"; ?>
                </tbody>
            </table>
            <!-- Bottom navigation -->
            <div class="row">
                <!-- Page size setting -->
                <div class="col-sm">
                    <div class="input-group">
                        <input id="limit-records" type="number" min="10" name="limit" class="form-control" value="<?= $limit ?>" placeholder="Default: 10" style="max-width:150px">
                        <button button class="btn btn-primary" type="submit">Set page size</button>
                    </div>
                </div>
                <!-- Pagination  -->
                <div class="col-sm" , style="display: flex; justify-content:flex-end">
                    <ul class="pagination">
                        <!-- If current page is 1 -> Disable "Previous" button -->
                        <li class="page-item <?= $page == 1 ? 'disabled' : ''; ?>"><a class="page-link" href="?countrybq=<?= $countrybq ?>&namebq=<?= $namebq ?>&page=<?= $Previous ?>&limit=<?= $limit ?>">Previous</a></li>
                        <!-- If current page exceed the given range (+-1) -> Show the first page 1 -->
                        <?php if ($page >= 3) { ?>
                            <li class="page-item">
                                <a class="page-link" href="?countrybq=<?= $countrybq ?>&namebq=<?= $namebq ?>&page=1&limit=<?= $limit ?>">1</a>
                            </li>
                        <? } ?>
                        <?php
                        // Define the range to control display of pages
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
                        <!-- Show the last page with active stage -->
                        <li class="paginate_button page-item <?= $page == $lastPage ? 'active' : ''; ?>">
                            <a class="page-link" href="?countrybq=<?= $countrybq ?>&namebq=<?= $namebq ?>&page=<?= $lastPage ?>&limit=<?= $limit ?>"><?= $lastPage ?></a>
                        </li>
                        <!-- If current page is the last page -> Disable "Next" button -->
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