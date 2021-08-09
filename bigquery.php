<?php 
    include 'search.php';
    require_once "config.php";
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
            <a class="nav-link" href="home.php">Project Management</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="bigquery.php">Project BigQuery<span class="sr-only">(current)</span></a>
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
            <h2 class="text-center text-dark">Mekong Infrastructure Tracker (Search & Filter)</h2>
        </div>
        <!-- Button trigger to add new project -->
        <div class="row">
            <div class="col-md-9 mb-3">
                Displaying projects from
                <select class="custom-select" name=country required style="max-width: 200px">
                    <option value selected>All Countries</option> 
                    <option value="Vietnam">Vietnam</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Laos">Laos</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="China">China</option>
                </select>.
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group" style="justify-content:flex-end">
                    <input class="form-control" name="search" type="text" placeholder="Search Project Name">
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
                </tr>
            </thead>
            <tbody>
                </tr>  
                <?php foreach ($rows as $row)
                {
                    $str .= "<tr>";
                    foreach ($row['f'] as $field)
                    {
                        $str .= "<td>" . $field['v'] . "</td>";
                    }
                    $str .= "</tr>";
                }
                ?>
                <!-- </tr> -->
            </tbody> 
        </table>
        <div class="row">
            <div class="col-sm">
                <div class="input-group" style="max-width: 200px">
                    <input type="number" name="pageSize" class="form-control" value="10" placeholder="Enter page limit (Default: 10)">
                    <button class="btn btn-primary" type="submit" name="pageSize">Set page size</button>
                </div> 
            </div>  
            <div class="col-sm justify-content-center">
                Showing entities 
            </div>  
            <div class="col-sm"> 
                <div class="dataTables_paginate paging_simple_numbers" id="employee-table_paginate">
                    <ul class="pagination">
                        <?php for ($i=1; $i <= $lastPage; $i++) {
                            $class = '';
                            if ($currentPage == $i) { $class = 'active';}
                        ?>
                        <li class="paginate_button page-item <?=$class?>">
                            <a href="?start=<?=$i?>" class="page-link"><?=$i?></a>
                        </li>
                        <?php } ?>    
                    
                        <!-- <li class="paginate_button page-item previous disabled" id="employee-table_previous">
                            <a href="#" aria-controls="employee-table" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                        </li>
                        <li class="paginate_button page-item active">
                            <a href="#" aria-controls="employee-table" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                        </li>
                        <li class="paginate_button page-item next disabled" id="employee-table_next">
                            <a href="#" aria-controls="employee-table" data-dt-idx="2" tabindex="0" class="page-link">Next</a> -->
                        <!-- </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>