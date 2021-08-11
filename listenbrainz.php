<?php
include 'config.php';
require_once('function.php');

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
$LBtype = isset($_GET['LBtype']) ? $_GET['LBtype'] : '';
$LBname = isset($_GET['LBname']) ? $_GET['LBname'] : '';

$dict = array("Artist" => "artist_name", "Album" => "release_name", "Song" => "track_name", "Tags" => "tags");
// Set the condition based on value input from "type" and "name"
if (!empty($LBtype) and !empty($LBname)) {
    $where = "WHERE $dict[$LBtype] LIKE '%$LBname%' ";
}

// Get total number of rows 
$DATA_COUNT = 146914257;

// Calculate the last page value
$lastPage = ceil($DATA_COUNT / $limit);

/** Uncomment and populate these variables in your code */
$projectId = 's3818102-asm1';
$dataset = 'listenbrainz.listenbrainz.listen';
// Select important columns
$columns = "listened_at,user_name,artist_name,release_name,track_name,tags";

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google_Service_Bigquery::BIGQUERY);
$bigquery = new Google_Service_Bigquery($client);
$request = new Google_Service_Bigquery_QueryRequest();

// Send query request to Google BigQuery and store API response in $rows
$request->setQuery("SELECT $columns FROM $dataset $where LIMIT $limit OFFSET $start");

$response = $bigquery->jobs->query($projectId, $request);
$rows = $response->getRows();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ListenBrainz Dataset</title>

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
    <!-- <link rel="stylesheet" href="css/table.css"/> -->
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
            <li class="nav-item">
                <a class="nav-link" href="bigquery">Project BigQuery</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="dashboard">Additional App<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>
<br><br><br>

<body>
    <div class="container-fluid">
        <form method="GET" action="#">
            <div class="row justify-content-center">
                <h2 class="text-center text-dark">ListenBrainz Data (Search & Filter)</h2>
            </div>
            <div class="row">
                <div class="col-sm">
                    <a href="javascript:history.go(-1)" class="btn btn-warning">Back
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="col-sm" style="justify-content:flex-end">
                    <!-- Button trigger to add new project -->
                    <div class="input-group">
                        <!-- Display text -->
                        <div class="input-group-prepend">
                            <span class="input-group-text">Search</span>
                        </div>
                        <!-- Dropdown box for selecting country -->
                        <div class="input-group-prepend">
                            <select class="custom-select" name="LBtype" required>
                                <option value selected>All</option>
                                <?php foreach (["Artist", "Album", "Song", "Tags"] as $value) : ?>
                                    <option <?php if (isset($_GET["type"]) && $_GET["type"] == $value) echo "selected" ?> value="<?= $value; ?>"><?= $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Input box for project name -->
                        <input class="form-control" name="LBname" type="text" value="<?= $LBname ?>" placeholder="Enter name: " style="max-width: 300px;">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Search
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <table class="table table-bordered table-striped table-hover" id="header-fixed">
                <thead class="table-info">
                    <tr>
                        <th>Time</th>
                        <th>User Name</th>
                        <th>Artist</th>
                        <th>Album</th>
                        <th>Song</th>
                        <th>Tags</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) :
                        echo "<tr>";
                        $isDate = true;
                        foreach ($row['f'] as $field) {
                            if ($isDate) {
                                echo "<td>" . date("Y-m-d H:i:s", $field['v']) . "</td>";
                                $isDate = false;
                            } else if (empty($field['v'])) {
                                echo "<td>" . " " . "</td>";
                            } else {
                                echo "<td>" . $field['v'] . "</td>";
                            }
                        } ?>
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