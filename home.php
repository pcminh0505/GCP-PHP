<?php 
    include('bootstrap.php'); 
    // include('header/header-employee.php');
?>
<!DOCTYPE html>
<html lang="en">
<header>
    <?php include('navbar.php');?>
    <link rel="stylesheet" href="table.css" />
</header>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <h2 class="text-dark">Mekong Infrastructure Tracker (Original Data)</h2>
            </div>
            <div class="col-md-10">
                <!-- Button trigger to add new project -->
                <a class="btn btn-success" href="form.php">Add New Project</a>
            </div>
            <!-- <?php if (isset($_SESSION['response'])) { ?>
            <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <b><?= $_SESSION['response']; ?></b>
            </div>
            <?php } unset($_SESSION['response']); ?> -->
        </div>
        <hr>
        
        
        <!-- <div style="overflow-x:auto;"> -->
        <table class="table table-bordered" id="header-fixed">
            <thead class="table-danger">
                <tr>
                    <th>ID</th>
                    <th>Project Name</th>
                    <th>Subtype</th>
                    <th>Current Status</th>
                    <th>Capacity (MW)</th>
                    <th>Year of Completion</th>
                    <th>Country list of Sponsor/Developer</th>
                    <th>Sponsor/Developer Company</th>
                    <th>Country list of Lender/Financier</th>
                    <th>Lender/Financier Company</th>
                    <th>Country list of Construction/EPC</th>
                    <th>Construction Company/EPC Participant</th>
                    <th>Country</th>
                    <th>Province/State</th>
                    <th>District</th>
                    <th>Tributary</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Proximity</th>
                    <th>Avg. Annual Output (MWh)</th>
                    <th>Data Source</th>
                    <th>Announcement/More Information</th>
                    <th>Link</th>
                    <th>Latest Update</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>  
                <?php $file = fopen('project.csv', 'r');
                    while (($line = fgetcsv($file)) !== FALSE): 
                        echo "<tr>";
                        foreach($line as $column) {
                            echo "<td>$column</td>";
                        } ?>
                    <td>
                        <a href="home.php?update=<?= $line[0];?>" class="badge badge-primary">
                        Update</a>
                        <a href="action.php?delete=<?= $line[0];?>" class="badge badge-danger"
                        onclick="return confirm('Do you want to delete this record?');">Delete</a>
                    </td>
                    <?php endwhile; fclose($file); ?>
                </tr>
            </tbody> 
        </table>
    </div>

</body>

</html>