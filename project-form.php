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
    <!-- <div class="row justify-content-center"> -->
    <form method="post" action="project-crud.php">
        <!-- <div class="form-group">
        <h1 class="form-header">Add New Project</h1> -->
        <div class="form-group">
            <label><span>Project Name: </span> </label>
            <input type="text" name="projectName" class="form-control" placeholder="Project Name">
        </div>
        <div class="form-group">
            <label><span>Subtype: </span> </label>
            <input type="text" name="subType" class="form-control" placeholder="Subtype">
        </div>
        <div class="form-group">
            <label><span>Current Status: </span> </label>
            <input type="text" name="currentStatus" class="form-control" placeholder="Current Status">
        </div>
        <div class="form-group">
            <label><span>Capacity (MW): </span> </label>
            <input type="text" name="capacity" class="form-control" placeholder="Capacity (MW)">
        </div>
        <div class="form-group">
            <label><span>Year of Completion: </span> </label>
            <input type="text" name="completionYear" class="form-control" placeholder="Year of Completion">
        </div>
        <div class="form-group">
            <label><span>Country list of Sponsor/Developer: </span> </label>
            <input type="text" name="sponsorCountry" class="form-control" placeholder="Country list of Sponsor/Developer">
        </div>
        <div class="form-group">
            <label><span>Sponsor/Developer Company: </span> </label>
            <input type="text" name="sponsorCompany" class="form-control" placeholder="Sponsor/Developer Company">
        </div>
        <div class="form-group">
            <label><span>Country list of Lender/Financier: </span> </label>
            <input type="text" name="lenderCountry" class="form-control" placeholder="Country list of Lender/Financier">
        </div>
        <div class="form-group">
            <label><span>Lender/Financier Company: </span> </label>
            <input type="text" name="lenderCompany" class="form-control" placeholder="Lender/Financier Company">
        </div>
        <div class="form-group">
            <label><span>Country list of Construction/EPC: </span> </label>
            <input type="text" name="constructionCountry" class="form-control" placeholder="Country list of Construction/EPC">
        </div>
        <div class="form-group">
            <label><span>Construction Company/EPC Participant: </span> </label>
            <input type="text" name="constructionCompany" class="form-control" placeholder="Construction Company/EPC Participant">
        </div>
        <div class="form-group">
            <label><span>Country: </span> </label>
            <input type="text" name="country" class="form-control" placeholder="Country">
        </div>
        <div class="form-group">
            <label><span>Province/State: </span> </label>
            <input type="text" name="provinceState" class="form-control" placeholder="Province/State">
        </div>
        <div class="form-group">
            <label><span>District: </span> </label>
            <input type="text" name="district" class="form-control" placeholder="District">
        </div>
        <div class="form-group">
            <label><span>Tributary: </span> </label>
            <input type="text" name="tributary" class="form-control" placeholder="Tributary">
        </div>
        <div class="form-group">
            <label><span>Latitude: </span> </label>
            <input type="text" name="latitude" class="form-control" placeholder="Latitude">
        </div>
        <div class="form-group">
            <label><span>Longitude: </span> </label>
            <input type="text" name="longitude" class="form-control" placeholder="Longitude">
        </div>
        <div class="form-group">
            <label><span>Proximity: </span> </label>
            <input type="text" name="proximity" class="form-control" placeholder="Proximity">
        </div>
        <div class="form-group">
            <label><span>Avg. Annual Output (MWh): </span> </label>
            <input type="text" name="avgOutput" class="form-control" placeholder="Avg. Annual Output (MWh)">
        </div>
        <div class="form-group">
            <label><span>Data Source: </span> </label>
            <input type="text" name="dataSource" class="form-control" placeholder="Data Source">
        </div>
        <div class="form-group">
            <label><span>Announcement/More Information: </span> </label>
            <input type="text" name="announcement" class="form-control" placeholder="Announcement/More Information">
        </div>
        <div class="form-group">
            <label><span>Link: </span> </label>
            <input type="text" name="link" class="form-control" placeholder="Link">
        </div>
        <div class="form-group">
            <label><span>Latest Update: </span> </label>
            <input type="text" name="latestUpdate" class="form-control" placeholder="Latest Update">
        </div>
        <div class="form-group">
            <!-- <?php if ($update == true) { ?>
                <input type="submit" name="update" class="btn btn-primary btn-block" value="Update record">
            <?php } else { ?>
                
            <?php } ?> -->
            <input type="submit" name="add" class="btn btn-success btn-block" value="Add record">
        </div>
    </form>

</body>
</html>