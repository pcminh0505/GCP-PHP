<?php 
    include('bootstrap.php'); 
    include 'action.php';
    require_once "config.php";

    if (!isset($_SESSION)) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<header>
    <?php include('navbar.php');?>
    <link rel="stylesheet" href="css/table.css" />
</header>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h2 class="text-center text-dark">Mekong Infrastructure Tracker (Original Data)</h2>
        </div>
        <div class="row justify-content-center">
            <?php if (isset($_SESSION['response'])) { ?>
            <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <b><?= $_SESSION['response']; ?></b>
            </div>
            <?php } unset($_SESSION['response']); ?>
        </div>
        <!-- Button trigger to add new project -->
        <a class="btn btn-success" href="form.php">Add New Project</a>
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
                    // Country, Province/State, District, Latitude, Longitude, and Data Source 
                    $mainInfoCol = array(0,1,2,3,12,13,14,16,17);
                    $file = fopen($FILE_PATH, 'r');
                    while (($line = fgetcsv($file)) !== FALSE):
                        echo "<tr>";
                        foreach($mainInfoCol as $col) {
                            echo "<td>$line[$col]</td>";
                        } ?>
                        <td>
                            <a href="form.php?view=<?=$line[0];?>" class="btn btn-primary btn-sm">Details/Update</a>
                            <a href="action.php?delete=<?=$line[0];?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Do you want to delete this record?');">Delete</a>
                        </td>
                        <?php  endwhile; fclose($file); ?>
                </tr>
            </tbody> 
        </table>
        <label id="bottom">End of page</label>
        <a class="btn btn-secondary" href="#top">Jump to top</a>        
    </div>
</body>

</html>