<?php
include 'action.php';
require_once "config.php";
// session_start();
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
            <li class="nav-item active">
                <a class="nav-link" href="home">Project Management<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="bigquery">Project BigQuery</a>
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
        <div class="row justify-content-center">
            <h2 class="text-center text-dark">Mekong Infrastructure Tracker (Original Data)</h2>
        </div>
        <!-- Button trigger to add new project -->
        <a class="btn btn-success" href="form">Add New Project
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>

        <a class="btn btn-secondary" href="#bottom">Jump to bottom</a>

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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                </tr>
                <?php //  Only show the required information which are: ID, Project Name, Subtype, Current Status,
                // Country, Province/State, District, Latitude, Longitude
                $mainInfoCol = array(0, 1, 2, 3, 12, 13, 14, 16, 17);
                $file = fopen($FILE_PATH, 'r');
                while (($line = fgetcsv($file)) !== FALSE) :
                    echo "<tr>";
                    foreach ($mainInfoCol as $col) {
                        echo "<td>$line[$col]</td>";
                    } ?>
                    <td>
                        <a href="form?view=<?= $line[0]; ?>" class="btn btn-primary btn-sm">Details/Update
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <a href="action.php?delete=<?= $line[0]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this record?');">Delete
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                <?php endwhile;
                fclose($file); ?>
                </tr>
            </tbody>
        </table>
        <label id="bottom">End of page</label>
        <a class="btn btn-secondary" href="#top">Jump to top</a>
    </div>
</body>

</html>