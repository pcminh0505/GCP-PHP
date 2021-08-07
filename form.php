<?php 
    include('bootstrap.php'); 
    include 'action.php';
    require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<header>
    <?php include('navbar.php');?>
    <link rel="stylesheet" href="css/form.css" />
</header>

<body>
    <form method="post" action="action.php">
        
        <?php
            if (isset($_GET['view'])) echo "<h1 class='form-title' style='color:blue'>Project Details</h1>";
            else if (isset($_GET['edit'])) echo "<h1 class='form-title' style='color:blue'>Modify Project</h1>";
            else echo "<h1 class='form-title' style='color:green'>New Project Form</h1>";
        ?>

        <div class="form-group">
            <label class="required"><span>Project Name: </span> </label>
            <input
            type="text"
            name="name"
            class="form-control"
            placeholder="Project Name"
            required
            />
        </div>
        <div class="form-group">
            <label class="required"><span>Subtype: </span> </label>
            <select class="custom-select" name=subtype required>
                <option disable selected value>Subtype</option> 
                <option value="Hydro">Hydro</option>
                <option value="Solar">Solar</option>
                <option value="Coal">Coal</option>
                <option value="Gas">Gas</option>
                <option value="Wind">Wind</option>
                <option value="Waste">Waste</option>
                <option value="Biomass">Biomass</option>
                <option value="Oil">Oil</option>
                <option value="Geothermal">Geothermal</option>
                <option value="Nuclear">Nuclear</option>
                <option value="Mixed Fossil Fuel">Mixed Fossil Fuel</option>
            </select>
        </div>
        <div class="form-group">
            <label class="required"><span>Current Status: </span> </label>
            <select class="custom-select" name=status required>
                <option disable selected value>Current Status</option> 
                <option value="Operational">Operational</option>
                <option value="Planned">Planned</option>
                <option value="Unknown">Unknown</option>
                <option value="Under Construction">Under Construction</option>
                <option value="Cancelled">Cancelled</option>
                <option value="Postponed">Postponed</option>
            </select>
        </div> 
        <div class="form-group">
            <label><span>Capacity (MW): </span> </label>
            <input
            type="number"
            name="capacity"
            class="form-control"
            placeholder="Capacity (MW)"
            />
        </div>
        <div class="form-group">
            <label><span>Year of Completion: </span> </label>
            <input
            type="text"
            name="year"
            class="form-control"
            placeholder="Year of Completion"
            />
        </div>
        <div class="form-group">
            <label><span>Country list of Sponsor/Developer: </span> </label>
            <input
            type="text"
            name="sponsorCountry"
            class="form-control"
            placeholder="Country list of Sponsor/Developer"
            />
        </div>
        <div class="form-group">
            <label><span>Sponsor/Developer Company: </span> </label>
            <input
            type="text"
            name="sponsorCompany"
            class="form-control"
            placeholder="Sponsor/Developer Company"
            />
        </div>
        <div class="form-group">
            <label><span>Country list of Lender/Financier: </span> </label>
            <input
            type="text"
            name="lenderCountry"
            class="form-control"
            placeholder="Country list of Lender/Financier"
            />
        </div>
        <div class="form-group">
            <label><span>Lender/Financier Company: </span> </label>
            <input
            type="text"
            name="lenderCompany"
            class="form-control"
            placeholder="Lender/Financier Company"
            />
        </div>
        <div class="form-group">
            <label><span>Country list of Construction/EPC: </span> </label>
            <input
            type="text"
            name="constructionCountry"
            class="form-control"
            placeholder="Country list of Construction/EPC"
            />
        </div>
        <div class="form-group">
            <label><span>Construction Company/EPC Participant: </span> </label>
            <input
            type="text"
            name="constructionCompany"
            class="form-control"
            placeholder="Construction Company/EPC Participant"
            />
        </div>
        <div class="form-group">
            <label class="required"><span>Country: </span> </label>
            <select class="custom-select" name=country required>
                <option disable selected value>Country</option> 
                <option value="Vietnam">Vietnam</option>
                <option value="Thailand">Thailand</option>
                <option value="Laos">Laos</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Cambodia">Cambodia</option>
                <option value="China">China</option>
            </select>
        </div> 

        <div class="form-group">
            <label class="required"><span>Province/State: </span> </label>
            <input
            type="text"
            name="provinceState"
            class="form-control"
            placeholder="Province/State"
            required
            />
        </div>
        <div class="form-group">
            <label class="required"><span>District: </span> </label>
            <input
            type="text"
            name="district"
            class="form-control"
            placeholder="District"
            required
            />
        </div>
        <div class="form-group">
            <label><span>Tributary: </span> </label>
            <input
            type="text"
            name="tributary"
            class="form-control"
            placeholder="Tributary"
            />
        </div>
        <div class="form-group">
            <label class="required"><span>Latitude: </span> </label>
            <input
            type="text"
            name="latitude"
            class="form-control"
            placeholder="Latitude"
            required
            />
        </div>
        <div class="form-group">
            <label class="required"><span>Longitude: </span> </label>
            <input
            type="text"
            name="longitude"
            class="form-control"
            placeholder="Longitude"
            required
            />
        </div>
        <div class="form-group">
            <label><span>Proximity: </span> </label>
            <input
            type="text"
            name="proximity"
            class="form-control"
            placeholder="Proximity"
            />
        </div>
        <div class="form-group">
            <label><span>Avg. Annual Output (MWh): </span> </label>
            <input
            type="text"
            name="avgOutput"
            class="form-control"
            placeholder="Avg. Annual Output (MWh)"
            />
        </div>
        <div class="form-group">
            <label class="required"><span>Data Source: </span> </label>
            <input
            type="text"
            name="source"
            class="form-control"
            placeholder="Data Source"
            required
            />
        </div>
        <div class="form-group">
            <label><span>Announcement/More Information: </span> </label>
            <input
            type="text"
            name="announcement"
            class="form-control"
            placeholder="Announcement/More Information"
            />
        </div>
        <div class="form-group">
            <label><span>Link: </span> </label>
            <input
            type="text"
            name="link"
            class="form-control"
            placeholder="Link"
            />
        </div>
        <div class="form-group">
            <label><span>Latest Update: </span> </label>
            <input
            type="text"
            name="latestUpdate"
            class="form-control"
            placeholder="Latest Update"
            />
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mx-auto">
                <a href="home.php" class="btn btn-block btn-warning">Back</a>
            </div>
            <div class="col-sm-6 mx-auto">
                <?php 
                    if (isset($_GET['view'])) echo "<a href='form.php?update=$id' name='update' class='btn btn-primary btn-block'> Update </a>";
                    else if (isset($_GET['update'])) echo "<button type='submit' name='update' class='btn btn-primary btn-block'> Confirm </button>";
                    else echo "<button type='submit' name='add' class='btn btn-success btn-block'> Submit </button>";
                ?>
            </div>
        </div>
    </form>
</body>
</html>