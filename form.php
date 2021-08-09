<?php 
    include 'action.php';
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
    <link rel="stylesheet" href="css/form.css"/>
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
            <a class="nav-link" href="home.php">Project Management<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="bigquery.php">Project BigQuery</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Additional App</a>
        </li>
        </ul>
    </div>
</nav>
<br><br><br>

<body>
    <form method="post" action="action.php">
        
        <?php
            if (isset($_GET['view'])) {
                echo "<h1 class='form-title' style='color:blue'>Project Details</h1>";
            }
            else if (isset($_GET['update'])) echo "<h1 class='form-title' style='color:blue'>Modify Project</h1>";
            else echo "<h1 class='form-title' style='color:green'>New Project Form</h1>";
        ?>

        <?php if (isset($_GET['view']) or isset($_GET['update'])) { ?>
            <div class="form-group">
                <label class="required"><span>ID: </span> </label>
                <input type="number" name="id" class="form-control" value= "<?=$id;?>" readonly>
            </div>
        <?php } ?>
        
        <div class="form-group">
            <label class="required"><span>Project Name: </span> </label>
            <input type="text" name="name" class="form-control" placeholder="Project Name" 
            value= "<?=$name;?>" required <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label class="required"><span>Subtype: </span> </label>
            <?php if (isset($_GET['view'])) { ?>
                <input class="form-control" value= "<?=$subtype;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>>
            <?php } else { ?>
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
            <?php } ?>
        </div>
        <div class="form-group">
            <label class="required"><span>Current Status: </span> </label>
            <?php if (isset($_GET['view'])) { ?>
                <input class="form-control" value= "<?=$status;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>>
            <?php } else { ?>
            <select class="custom-select" name=status required>
                <option disable selected value>Current Status</option> 
                <option value="Operational">Operational</option>
                <option value="Planned">Planned</option>
                <option value="Unknown">Unknown</option>
                <option value="Under Construction">Under Construction</option>
                <option value="Cancelled">Cancelled</option>
                <option value="Postponed">Postponed</option>
            </select>
            <?php } ?>
        </div> 
        <div class="form-group">
            <label><span>Capacity (MW): </span> </label>
            <input type="number" step=0.00001 name="capacity" class="form-control" placeholder="Capacity (MW)" 
            value= "<?=$capacity;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label><span>Year of Completion: </span> </label>
            <input type="number" name="year" class="form-control" placeholder="Year of Completion" 
            value= "<?=$year;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label><span>Country list of Sponsor/Developer: </span> </label>
            <input type="text" name="sponsorCountry" class="form-control" placeholder="Country list of Sponsor/Developer" 
            value= "<?=$sponsorCountry;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label><span>Sponsor/Developer Company: </span> </label>
            <input type="text" name="sponsorCompany" class="form-control" placeholder="Sponsor/Developer Company"
            value= "<?=$sponsorCompany;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label><span>Country list of Lender/Financier: </span> </label>
            <input type="text" name="lenderCountry" class="form-control" placeholder="Country list of Lender/Financier"
            value= "<?=$lenderCountry;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label><span>Lender/Financier Company: </span> </label>
            <input type="text" name="lenderCompany" class="form-control" placeholder="Lender/Financier Company"
            value= "<?=$lenderCompany;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label><span>Country list of Construction/EPC: </span> </label>
            <input type="text" name="constructionCountry" class="form-control" placeholder="Country list of Construction/EPC"
            value= "<?=$constructionCountry;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label><span>Construction Company/EPC Participant: </span> </label>
            <input type="text" name="constructionCompany" class="form-control" placeholder="Construction Company/EPC Participant"
            value= "<?=$constructionCompany;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label class="required"><span>Country: </span> </label>
            <?php if (isset($_GET['view'])) { ?>
                <input class="form-control" value= "<?=$country;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>>
            <?php } else { ?>
            <select class="custom-select" name=country required>
                <option disable selected value>Country</option> 
                <option value="Vietnam">Vietnam</option>
                <option value="Thailand">Thailand</option>
                <option value="Laos">Laos</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Cambodia">Cambodia</option>
                <option value="China">China</option>
            </select>
            <?php } ?>
        </div> 

        <div class="form-group">
            <label class="required"><span>Province/State: </span> </label>
            <input type="text" name="provinceState" class="form-control" placeholder="Province/State" required
            value= "<?=$provinceState;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label class="required"><span>District: </span> </label>
            <input type="text" name="district" class="form-control" placeholder="District" required
            value= "<?=$district;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label><span>Tributary: </span> </label>
            <input type="text" name="tributary" class="form-control" placeholder="Tributary"
            value= "<?=$tributary;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label class="required"><span>Latitude: </span> </label>
            <input type="number" step=0.00001 name="latitude" class="form-control" placeholder="Latitude" required
            value= "<?=$latitude;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label class="required"><span>Longitude: </span> </label>
            <input type="number" step=0.00001 name="longitude" class="form-control" placeholder="Longitude" required
            value= "<?=$longitude;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label><span>Proximity: </span> </label>
            <input type="text" name="proximity" class="form-control" placeholder="Proximity"
            value= "<?=$proximity;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label><span>Avg. Annual Output (MWh): </span> </label>
            <input type="text" name="avgOutput" class="form-control" placeholder="Avg. Annual Output (MWh)"
            value= "<?=$avgOutput;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label><span>Data Source: </span> </label>
            <input type="text" name="source" class="form-control" placeholder="Data Source" 
            value= "<?=$source;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label><span>Announcement/More Information: </span> </label>
            <input type="text" name="announcement" class="form-control" placeholder="Announcement/More Information"
            value= "<?=$announcement;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label><span>Link: </span> </label>
            <input type="text" name="link" class="form-control" placeholder="Link"
            value= "<?=$link;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group">
            <label><span>Latest Update: </span> </label>
            <input type="text" name="latestUpdate" class="form-control" placeholder="Latest Update"
            value= "<?=$latestUpdate;?>" <?= isset($_GET['view']) ? "readonly" : ""; ?>/>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mx-auto">
                <a href="home.php" class="btn btn-block btn-warning">Cancel</a>
            </div>
            <div class="col-sm-6 mx-auto">
                <?php if (isset($_GET['update'])) { ?>
                    <button type='submit' name='update' class='btn btn-primary btn-block'>Confirm</button>
                <?php } else if (isset($_GET['view'])) { ?>
                    <a href='form.php?update=<?=$id;?>' class='btn btn-primary btn-block'>Update</a>
                <?php } else echo "<button type='submit' name='add' class='btn btn-success btn-block'> Submit </button>"; ?>
                
            </div>
        </div>
    </form>
</body>
</html>