<?php
include "query.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creative Dashboard</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
</head>

<header>
    <!-- <link rel="stylesheet" href="css/table.css"/> -->
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
                <a class="nav-link" href="home">Project Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="bigquery">Project BigQuery</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="dashboard">Additional App<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>
<br><br><br>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h2 class="text-center text-dark">ListenBrainz Visualization</h2>
        </div>
        <div class="row justify-content-center">
            <small class="text-info fst-italic">Last update: <?= $last ?></small>
        </div>
        <div class="row">
            <div class="col-md" style="display:flex; justify-content:flex-start">
                <a class="btn btn-primary" href="https://console.cloud.google.com/marketplace/product/metabrainz/listenbrainz">Original Description</a>
                <a class="btn btn-success" href="https://www.kaggle.com/yasmeenhany/listenbrainz-visualization/notebook">Query Reference</a>
            </div>
            <div class="col-md" style="display:flex; justify-content:flex-end">
                <a class="btn btn-success" href="listenbrainz">Go to dataset
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div class="card border-secondary mb-3 text-center">
                    <h5 class="card-header" style="justify-content: center">Top Played Artist (All time)</h5>
                    <div class="card-body">
                        <canvas id="topArtist" width="600" height="330" style="display: block; box-sizing: border-box; height: 301px; width: 602px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-secondary mb-3 text-center">
                    <h5 class="card-header">Top Played Album (All time)</h5>
                    <div class="card-body">
                        <canvas id="topAlbum" width="600" height="330" style="display: block; box-sizing: border-box; height: 301px; width: 602px;"></canvas>
                        <div class="row">
                            <small class="text-dark fst-italic">*2nd: Fate/stay night UNLIMITED BLADE WORKS Original Soundtrack</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-secondary mb-3 text-center">
                    <h5 class="card-header">Top Played Song (All time)</h5>
                    <div class="card-body">
                        <canvas id="topSong" width="600" height="330" style="display: block; box-sizing: border-box; height: 301px; width: 602px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card border-secondary mb-3 text-center">
                    <h5 class="card-header">Top 10 Songs By Year</h5>
                    <div class="card-body">
                        <!-- Table -->
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-info">
                                <tr>
                                    <th>Year</th>
                                    <th>Song</th>
                                    <th>Number of Plays</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($topSongsYear as $row) :
                                    echo "<tr>";
                                    foreach (["year", "track_name", "num_plays"] as $field) {
                                        echo "<td>" . $row[$field] . "</td>";
                                    } ?>
                                <?php endforeach;
                                echo "<tr>"; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-secondary mb-3 text-center">
                    <h5 class="card-header">Top 10 Songs by Artist</h5>
                    <div class="card-body">
                        <div class="col-sm-4">
                            <form method="GET">
                                <div class="input-group">
                                    <!-- Display text -->
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Search artist: </span>
                                    </div>
                                    <!-- Input box for project name -->
                                    <input class="form-control" name="artist" type="text" value="<?= $artist ?>" style="max-width: 400px;">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Search
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        <canvas id="songbyartist" width="600" height="330" style="display: block; box-sizing: border-box; height: 301px; width: 602px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var ctx1 = document.getElementById('topArtist').getContext('2d');
        var ctx2 = document.getElementById('topAlbum').getContext('2d');
        var ctx3 = document.getElementById('topSong').getContext('2d');
        var ctx4 = document.getElementById('songbyartist').getContext('2d');

        var artist = <?php echo json_encode($topArtist, JSON_HEX_TAG); ?>;
        var artistCount = <?php echo json_encode($topArtistCount, JSON_HEX_TAG); ?>;
        var album = <?php echo json_encode($topAlbums, JSON_HEX_TAG); ?>;
        var albumCount = <?php echo json_encode($topAlbumsCount, JSON_HEX_TAG); ?>;
        var song = <?php echo json_encode($topSong, JSON_HEX_TAG); ?>;
        var songCount = <?php echo json_encode($topSongCount, JSON_HEX_TAG); ?>;
        var songArtist = <?php echo json_encode($topSongsArtist, JSON_HEX_TAG); ?>;
        var songArtistCount = <?php echo json_encode($topSongsArtistCount, JSON_HEX_TAG); ?>;

        // Chart.defaults.global.defaultFontStyle = 'Bold'
        var topArtist = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: artist,
                datasets: [{
                    label: 'Play Count',
                    data: artistCount,
                    backgroundColor: 'rgba(43,48,93, 0.5)',
                    borderColor: 'rgba(43,48,93)',
                }]
            },
            options: {
                indexAxis: 'y',
                elements: {
                    bar: {
                        borderWidth: 2,
                    }
                },
                responsive: true,
            }
        });
        var topAlbum = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: album,
                datasets: [{
                    label: 'Play Count',
                    data: albumCount,
                    backgroundColor: 'rgba(219,185,109, 0.5)',
                    borderColor: 'rgba(219,185,109)',
                }]
            },
            options: {
                indexAxis: 'y',
                elements: {
                    bar: {
                        borderWidth: 2,
                    }
                },
                responsive: true,
            }
        });
        var topSong = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: song,
                datasets: [{
                    label: 'Play Count',
                    data: songCount,
                    backgroundColor: 'rgba(255,192,40, 0.25)',
                    borderColor: 'rgba(255,192,40,1)',
                }]
            },
            options: {
                indexAxis: 'y',
                elements: {
                    bar: {
                        borderWidth: 2,
                    }
                },
                responsive: true,
            }
        });
        var dailyListen = new Chart(document.getElementById("songbyartist"), {
            type: 'bar',
            data: {
                labels: songArtist,
                datasets: [{
                    label: 'Play Count',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255,99,132)',
                    data: songArtistCount
                }]
            },
            options: {
                elements: {
                    bar: {
                        borderWidth: 2,
                    }
                },
                responsive: true,
            }
        });
    </script>
</body>