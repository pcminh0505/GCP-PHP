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
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div class="card border-secondary mb-3 text-center">
                    <h5 class="card-header" style="justify-content: center">Top Played Artist</h5>
                    <div class="card-body">
                        <canvas id="topArtist" width="600" height="300" style="display: block; box-sizing: border-box; height: 301px; width: 602px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-secondary mb-3 text-center">
                    <h5 class="card-header">Top Played Album (All time)</h5>
                    <div class="card-body">
                        <canvas id="topAlbum" width="600" height="300" style="display: block; box-sizing: border-box; height: 301px; width: 602px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-secondary mb-3 text-center">
                    <h5 class="card-header">Top Played Song (All time)</h5>
                    <div class="card-body">
                        <canvas id="topSong" width="600" height="300" style="display: block; box-sizing: border-box; height: 301px; width: 602px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card border-secondary mb-3 text-center">
                    <h5 class="card-header">Top 10 Songs By Year (All time)</h5>
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
                            <div class="input-group">
                                <!-- Display text -->
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Search artist: </span>
                                </div>
                                <!-- Input box for project name -->
                                <input class="form-control" name="artist" type="text" value="<?php isset($_GET["artist"]) ? $_GET["artist"] : "Taylor Swift" ?>" placeholder="Taylor Swift" style="max-width: 300px;">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <canvas id="songbyartist" width="600" height="300" style="display: block; box-sizing: border-box; height: 301px; width: 602px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" style="display:flex; justify-content:flex-end">
                <a class="btn btn-success" href="listenbrainz">Go to dataset
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>

    <script>
        var ctx1 = document.getElementById('topArtist').getContext('2d');
        var ctx2 = document.getElementById('topAlbum').getContext('2d');
        var ctx3 = document.getElementById('topSong').getContext('2d');
        var ctx4 = document.getElementById('songbyartist').getContext('2d');
        // Chart.defaults.global.defaultFontStyle = 'Bold'
        var topArtist = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ["Radiohead", "The Beatles", "Pink Floyd", "Daft Punk", "Muse"],
                datasets: [{
                    label: 'Play Count',
                    data: [582658, 559065, 440631, 414091, 335187],
                    backgroundColor: 'rgba(43,48,93, 0.5)',
                    borderColor: 'rgba(43,48,93)',
                }]
            },
            options: {
                // plugins: {
                //     legend: {
                //         display: false
                //     },
                // },
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
                labels: ["Greatest Hits", ["Fate/stay night UNLIMITED BLADE WORKS", "Original Soundtrack"], "Discovery", "Music Of The Spheres", "Random Access Memories"],
                datasets: [{
                    label: 'Play Count',
                    data: [128835, 42716, 36881, 31290, 27073],
                    backgroundColor: 'rgba(219,185,109, 0.5)',
                    borderColor: 'rgba(219,185,109)',
                }]
            },
            options: {
                // plugins: {
                //     legend: {
                //         display: false
                //     },
                // },
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
                labels: [
                    ["Inside the Deku Tree", "(近藤浩治)"],
                    ["Docks Background Ambience", "(Michael Z. Land)"],
                    ["Smells Like Teen Spirit", "(Nirvana)"],
                    ["Karma Police", "(Radiohead)"],
                    ["Teardrop", "(Massive Attack)"]
                ],
                datasets: [{
                    label: 'Play Count',
                    data: [113348, 49199, 15159, 14378, 13346],
                    backgroundColor: 'rgba(255,192,40, 0.25)',
                    borderColor: 'rgba(255,192,40,1)',
                }]
            },
            options: {
                // plugins: {
                //     legend: {
                //         display: false
                //     },
                // },
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
                labels: ["Shake It Off", "Blank Space", "Style", "We Are Never Ever Getting Back Together", "Look What You Made Me Do", "Bad Blood", "Wildest Dreams", "Out of the Woods", "Everything Has Changed (feat. Ed Sheeran)", " I Knew You Were Trouble"],
                datasets: [{
                    label: 'Play Count',
                    backgroundColor: 'rgba(255,99,132, 0.2)',
                    borderColor: 'rgba(255,99,132)',
                    data: [4731, 4216, 3268, 2883, 2686, 2590, 2284, 2223, 2128, 2068]
                }]
            },
            options: {
                // plugins: {
                //     legend: {
                //         display: false
                //     },
                // },
                title: {
                    display: true,
                    text: 'Predicted world population (millions) in 2050'
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.yLabel;
                        }
                    }
                }
            }
        });
    </script>
</body>