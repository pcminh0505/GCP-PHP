<?php
    // Initialize session
    session_start();
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
    
    $update = false;
    $id = $name = $subtype = $status = $source = $capacity = $year = "";
    $sponsorCountry = $sponsorCompany = $lenderCountry = $lenderCompany = $constructionCountry = $constructionCompany = "";
    $country = $provinceState = $district = $latitude = $longitude = "" ;
    $tributary = $proximity = $avgOutput = $announcement = $link = $latestUpdate = "";

    // Add data to the csv file
    if (isset($_POST['add'])) {

        // Open csv file:
        $file = fopen($FILE_PATH, "r+");
        $existed = FALSE; // Variable to check the existence of the employee

        // Collect input data from $_POST
        $id = (int) getLastestId($FILE_PATH) + 1;
        $name = cleanInput($_POST['name']);
        $subtype = $_POST['subtype'];
        $status = $_POST['status'];
        $capacity = $_POST['capacity'];
        $year = $_POST['year'];
        $sponsorCountry = cleanInput($_POST['sponsorCountry']);
        $sponsorCompany = cleanInput($_POST['sponsorCompany']);
        $lenderCountry = cleanInput($_POST['lenderCountry']);
        $lenderCompany = cleanInput($_POST['lenderCompany']);
        $constructionCountry = cleanInput($_POST['constructionCountry']);
        $constructionCompany = cleanInput($_POST['constructionCompany']);
        $country = $_POST['country'];
        $provinceState = cleanInput($_POST['provinceState']);
        $district = cleanInput($_POST['district']);
        $tributary = cleanInput($_POST['tributary']);
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $proximity = cleanInput($_POST['proximity']);
        $avgOutput = $_POST['avgOutput'];
        $source = cleanInput($_POST['source']);
        $announcement = cleanInput($_POST['announcement']);
        $link = cleanInput($_POST['link']);
        $latestUpdate = cleanInput($_POST['latestUpdate']);

        // Check the existence, if yes set $existed = TRUE
        while (($data = fgetcsv($file)) !== FALSE) {
            $tmp_id = $data[0];
            if ($id == $tmp_id) {
                $existed = TRUE;
            }
        }
        
        // If failed return alert to web page
        if ($existed) {
            $_SESSION['response']="Failed to insert: Employee with id ".$id." is already existed";
            $_SESSION['res_type']="danger";
        }
        else {
            $line = array($id,$name,$subtype,$status,$capacity,$year,
                            $sponsorCountry,$sponsorCompany,$lenderCountry,$lenderCompany,$constructionCountry,$constructionCompany,
                            $country,$provinceState,$district,$latitude,$longitude,$tributary,$proximity,$avgOutput,$source,$announcement,$link,$latestUpdate);
            fputcsv($file,$line);

            // Save session status 
            $_SESSION['response']="Successfully inserted record with id ".$id." to database";
            $_SESSION['res_type']="success";
        }
        
        fclose($file);
        // Redirect to index page
        header('location:home.php');

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

        // Save session status
        $_SESSION['response']="Successfully deleted record with id ".$id." from database";
        $_SESSION['res_type']="danger";

        // Redirect to index page
        header('location:home.php');
    }

    // View project detail
    if (isset($_GET['view'])) {
        $id = $_GET['view'];
        
    }

    // // Ask for updating information
    // if (isset($_GET['update'])) {
    //     // Get the request update ID
    //     $id = $_GET['update'];

    //     // Open the file 
    //     $file = fopen($FILE_PATH, "r");

    //     // Loop through file, get the information to display to webpage
    //     while (($line = fgetcsv($file)) !== FALSE) {
    //         if ($line[0] == $id) {
    //             $fname = $line[1];
    //             $lname = $line[2];
    //             $gender = $line[3];
    //             $age = $line[4]; 
    //             $address = $line[5];
    //             $phone = $line[6];
    //         }
    //     }
    //     $update = true; // Set status to control display (create a button with type='update')
    // }

    // // Submit updated information
    // if (isset($_POST['update'])) {
    //     // Save the new information and put into an array
    //     $id = $_POST['id'];
    //     $fname = $_POST['fname'];
    //     $lname = $_POST['lname'];
    //     $gender = $_POST['gender'];
    //     $age = $_POST['age'];
    //     $address = $_POST['address'];
    //     $phone = $_POST['phone'];
        
    //     $new_data = array($id,$fname,$lname,$gender,$age,$address,$phone);
        
    //     // Open csv file:        
    //     $infile = fopen($FILE_PATH, "r");
    //     $data = array();
        
    //     // Loop through file
    //     while (($line = fgetcsv($infile)) !== FALSE) {
    //         // If the ID not match the current line, push to data array. Else push the new_data to array
    //         if ($line[0] != $id) {array_push($data,$line);}
    //         else {array_push($data,$new_data);}
            
    //     }
    //     fclose($infile); // Close the file

    //     // Reopen the file and write back the data
    //     $outfile = fopen($FILE_PATH, "w");
    //     foreach($data as $row) {
    //         fputcsv($outfile,$row);
    //     }
    //     fclose($outfile);

    //     // Save session status
    //     $_SESSION['response']="Successfully updated record with id ".$id." to database";
    //     $_SESSION['res_type']="success";

    //     header('location:index.php');
    // }
?>
