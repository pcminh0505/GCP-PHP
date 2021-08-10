<?php
    require_once('config.php');

    
    // Some shortcut functions
    // Get whole data to an array
    function getData($filename) {
        $data = array();

        $fp = fopen($filename, "r");
        while ($line = fgetcsv($fp)) {
            $records[] = $line;
        }
        
        fclose($fp);
        return $records;
    }

    // Get the latest ID, +1 to assign to new record
    function getLastestId($filename){
        $data = getData($filename);
        if (count($data) > 0){
            $id = $data[count($data) - 1][0];
        } else {
            $id = 1;
        }
        return $id;
    }

    //Clean the input text
    function cleanInput($string)
    {
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }


    $id = $name = $subtype = $status = $source = $capacity = $year = "";
    $sponsorCountry = $sponsorCompany = $lenderCountry = $lenderCompany = $constructionCountry = $constructionCompany = "";
    $country = $provinceState = $district = $latitude = $longitude = "" ;
    $tributary = $proximity = $avgOutput = $announcement = $link = $latestUpdate = "";

    // Add data to the csv file
    if (isset($_POST['add'])) {

        // Open csv file:
        $file = fopen($FILE_PATH, "a");

        // Collect input data from $_POST
        $id = (int) getLastestId($FILE_PATH) + 1;
        $name = cleanInput($_POST['name']);
        $subtype = $_POST['subtype'];
        $status = $_POST['status'];
        $capacity = (empty($_POST['capacity']))? "N/A" : $_POST['capacity']; 
        $year = (empty($_POST['year']))? "N/A" : $_POST['year'];
        $sponsorCountry = (empty($_POST['sponsorCountry']))? "N/A" : cleanInput($_POST['sponsorCountry']);
        $sponsorCompany = (empty($_POST['sponsorCompany']))? "N/A" : cleanInput($_POST['sponsorCompany']);
        $lenderCountry = (empty($_POST['lenderCountry']))? "N/A" : cleanInput($_POST['lenderCountry']);
        $lenderCompany = (empty($_POST['lenderCompany']))? "N/A" : cleanInput($_POST['lenderCompany']);
        $constructionCountry = (empty($_POST['constructionCountry']))? "N/A" : cleanInput($_POST['constructionCountry']);
        $constructionCompany = (empty($_POST['constructionCompany']))? "N/A" : cleanInput($_POST['constructionCompany']);
        $country = $_POST['country'];
        $provinceState = cleanInput($_POST['provinceState']);
        $district = cleanInput($_POST['district']);
        $tributary = (empty($_POST['tributary']))? "N/A" : cleanInput($_POST['tributary']);
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $proximity = (empty($_POST['proximity']))? "N/A" : cleanInput($_POST['proximity']);
        $avgOutput = (empty($_POST['source']))? "N/A" : $_POST['avgOutput'];
        $source = cleanInput($_POST['source']);
        $announcement = (empty($_POST['announcement']))? "N/A" : cleanInput($_POST['announcement']);
        $link = (empty($_POST['capacity']))? "N/A" : cleanInput($_POST['link']);
        $latestUpdate = (empty($_POST['latestUpdate']))? "N/A" : cleanInput($_POST['latestUpdate']);


        $data = array($id,$name,$subtype,$status,$capacity,$year,
                        $sponsorCountry,$sponsorCompany,$lenderCountry,$lenderCompany,$constructionCountry,$constructionCompany,
                        $country,$provinceState,$district,$tributary,$latitude,$longitude,$proximity,$avgOutput,$source,$announcement,$link,$latestUpdate);
        fputcsv($file, $data);
        
        // // Save session status 
        // $_SESSION['response']="Successfully inserted record with id ".$id." to database";
        // $_SESSION['res_type']="success";
        
        fclose($file);
        // Redirect to index page
        echo "<script>alert('Create new employee with $id successfully');</script>";
        echo "<script>window.location.href='home';</script>";
        // header('location:home.php');
    }

    // Delete record
    if (isset($_GET['delete'])) {
        // Get the request delete ID
        $id = $_GET['delete'];

        // Open the file
        $infile = fopen($FILE_PATH, "r");
        $data = array(); // Initialize data array

        // Loop through the file, push every line except the match ID line
        while (($line = fgetcsv($infile)) !== FALSE) {
            if ($line[0] != $id) {array_push($data,$line);}
        }

        // Close the file
        fclose($infile);

        // Reopen the file to write back in
        $outfile = fopen($FILE_PATH, "w");
        foreach($data as $row) {
            fputcsv($outfile,$row);
        }
        fclose($outfile);

        // // Save session status
        // $_SESSION['response']="Successfully deleted record with id ".$id." from database";
        // $_SESSION['res_type']="danger";

        // Redirect to index page
        echo "<script>alert('Delete employee with $id successfully!');</script>";
        echo "<script>window.location.href='home';</script>";
    }

    // View or Ask for updating information
    if (isset($_GET['view']) or isset($_GET['update'])) {
        // Get the request update ID
        $id = isset($_GET['view']) ? $_GET['view'] : $_GET['update'];

        // Open the file 
        $file = fopen($FILE_PATH, "r");

        // Loop through file, get the information to display to webpage
        while (($line = fgetcsv($file)) !== FALSE) {
            if ($line[0] == $id) {
                $name = $line[1];
                $subtype = $line[2];
                $status = $line[3];
                $capacity =$line[4]; 
                $year = $line[5];
                $sponsorCountry = $line[6];
                $sponsorCompany = $line[7];
                $lenderCountry = $line[8];
                $lenderCompany = $line[9];
                $constructionCountry = $line[10];
                $constructionCompany = $line[11];
                $country = $line[12];
                $provinceState = $line[13];
                $district = $line[14];
                $tributary = $line[15];
                $latitude = $line[16];
                $longitude = $line[17];
                $proximity = $line[18];
                $avgOutput = $line[19];
                $source = $line[20];
                $announcement = $line[21];
                $link = $line[22];
                $latestUpdate = $line[23];
            }
        }
    }

    // Submit updated information
    if (isset($_POST['update'])) {
        // Save the new information and put into an array
        // Collect input data from $_POST
        $id = $_POST['id'];
        $name = cleanInput($_POST['name']);
        $subtype = $_POST['subtype'];
        $status = $_POST['status'];
        $capacity = (empty($_POST['capacity']))? "N/A" : $_POST['capacity']; 
        $year = (empty($_POST['year']))? "N/A" : $_POST['year'];
        $sponsorCountry = (empty($_POST['sponsorCountry']))? "N/A" : cleanInput($_POST['sponsorCountry']);
        $sponsorCompany = (empty($_POST['sponsorCompany']))? "N/A" : cleanInput($_POST['sponsorCompany']);
        $lenderCountry = (empty($_POST['lenderCountry']))? "N/A" : cleanInput($_POST['lenderCountry']);
        $lenderCompany = (empty($_POST['lenderCompany']))? "N/A" : cleanInput($_POST['lenderCompany']);
        $constructionCountry = (empty($_POST['constructionCountry']))? "N/A" : cleanInput($_POST['constructionCountry']);
        $constructionCompany = (empty($_POST['constructionCompany']))? "N/A" : cleanInput($_POST['constructionCompany']);
        $country = $_POST['country'];
        $provinceState = cleanInput($_POST['provinceState']);
        $district = cleanInput($_POST['district']);
        $tributary = (empty($_POST['tributary']))? "N/A" : cleanInput($_POST['tributary']);
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $proximity = (empty($_POST['proximity']))? "N/A" : cleanInput($_POST['proximity']);
        $avgOutput = (empty($_POST['source']))? "N/A" : $_POST['avgOutput'];
        $source = cleanInput($_POST['source']);
        $announcement = (empty($_POST['announcement']))? "N/A" : cleanInput($_POST['announcement']);
        $link = (empty($_POST['capacity']))? "N/A" : cleanInput($_POST['link']);
        $latestUpdate = (empty($_POST['latestUpdate']))? "N/A" : cleanInput($_POST['latestUpdate']);


        $new_data = array($id,$name,$subtype,$status,$capacity,$year,
                        $sponsorCountry,$sponsorCompany,$lenderCountry,$lenderCompany,$constructionCountry,$constructionCompany,
                        $country,$provinceState,$district,$latitude,$longitude,$tributary,$proximity,$avgOutput,$source,$announcement,$link,$latestUpdate);
        // echo $id;
        // Get original data
        $data = getData($FILE_PATH);
        // Change the new data
        $data[$id - 1] = $new_data;

        // Reopen the file and write back the data
        $outfile = fopen($FILE_PATH, "w");
        foreach($data as $row) {
            fputcsv($outfile,$row);
        }
        fclose($outfile);

        // // Save session status
        // $_SESSION['response']="Successfully updated record with id ".$id." to database";
        // $_SESSION['res_type']="success";

        echo "<script>alert('Edit employee with $id successfully');</script>";
        echo "<script>window.location.href='home';</script>";
    }
?>
