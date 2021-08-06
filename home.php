<?php 
    include('bootstrap.php'); 
    // include('header/header-employee.php');
?>
<!DOCTYPE html>
<html lang="en">
<header>
    <?php 
        include('navbar.php');
        // include('header/header-employee.php');
    ?>
</header>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="text-center text-dark">Project Management</h2>
                <hr>
                <!-- <?php if (isset($_SESSION['response'])) { ?>
                <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <b><?= $_SESSION['response']; ?></b>
                </div>
                <?php } unset($_SESSION['response']); ?> -->
            </div>
        </div>

    <!-- <div class="row justified-content-center">
        <form method="post" action="project-crud.php">
            <h1 class="form-header">Add New Project</h1> -->
            <!-- <div class="form-group">
                <label><span>Project Name: </span> </label>
                <input type="text" name="pname" class="form-control" placeholder="Project Name">
            </div>
        </form> -->
        <table class="table table-hover">
            <thead>
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

                </tr>
            </thead>
            <!-- <tbody> 
                <?php $file = fopen('Employee.csv', 'r');
                    while (($line = fgetcsv($file)) !== FALSE): ?>
                <tr>
                    <td><?= $line[0]?></td>
                    <td><?= $line[1]?></td>
                    <td><?= $line[2]?></td>
                    <td><?= $line[3]?></td>
                    <td><?= $line[4]?></td>
                    <td><?= $line[5]?></td>
                    <td><?= $line[6]?></td>
                    <td>
                        <a href="home.php?update=<?= $line[0];?>" class="badge badge-primary">
                        Update</a>
                        <a href="action.php?delete=<?= $line[0];?>" class="badge badge-danger"
                        onclick="return confirm('Do you want to delete this record?');">Delete</a>
                    </td>
                    <?php endwhile; fclose($file); ?>
                </tr>
            </tbody> -->
        </table>

    </div>

</body>

</html>