<?php
include 'config.php';
require_once('function.php');

$projectId = 's3818102-asm1';
$dataset = 'listenbrainz.listenbrainz.listen';
// Select important columns

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google_Service_Bigquery::BIGQUERY);
$bigquery = new Google_Service_Bigquery($client);
$request = new Google_Service_Bigquery_QueryRequest();

// 1: Get top artist
$request->setQuery("SELECT track_name as song, artist_name as artist, COUNT(track_name) as plays FROM $dataset GROUP BY song, artist ORDER BY plays DESC LIMIT 5");
$response = $bigquery->jobs->query($projectId, $request);
$topArtist = $response->getRows();
$topArtist_data = array();
foreach ($topArtist_data as $row) {
    array_push($topArtist_data, $row);
}

// 2: Get top albums
$request->setQuery("SELECT release_name, COUNT(release_name) as album_occurrences FROM $dataset GROUP BY release_name ORDER BY album_occurrences DESC LIMIT 6");
$response = $bigquery->jobs->query($projectId, $request);
$topAlbums = $response->getRows();
$topAlbums_data = array();
foreach ($topAlbums_data as $row) {
    array_push($topAlbums_data, $row);
}

// 3: Get top songs
$request->setQuery("SELECT artist_name, COUNT(artist_name) as artist_occurrences FROM $dataset GROUP BY artist_name ORDER BY artist_occurrences DESC LIMIT 5");
$response = $bigquery->jobs->query($projectId, $request);
$topSongs = $response->getRows();
$topSongs_data = array();
foreach ($topSongs_data as $row) {
    array_push($topSongs_data, $row);
}
// // 4: Get top songs by year
// $request->setQuery("WITH temp AS (SELECT EXTRACT(YEAR from listened_at) as year, artist_name, track_name, Count(track_name) as num_plays FROM $dataset GROUP BY track_name,artist_name, year ORDER BY year, num_plays DESC), temp2 AS( SELECT year, MAX(num_plays) as max_track FROM temp GROUP BY year) SELECT DISTINCT temp.year, temp.track_name,temp.num_plays FROM temp INNER JOIN temp2 ON temp.year = temp2.year AND temp.num_plays = temp2.max_track ORDER BY temp.year DESC LIMIT 14");
// $response = $bigquery->jobs->query($projectId, $request);
// $topSongsYear = $response->getRows();

// 5: Top 10 songs of artist
$artist = isset($_GET["artist"]) ? $_GET["artist"] : "";
$artist_lowcase = strtolower($artist);
$request->setQuery("SELECT track_name, COUNT(1) as num_of_plays
    FROM $dataset
    WHERE LOWER(artist_name) = '$artist_lowcase'
    GROUP BY track_name
    ORDER BY num_of_plays DESC
    LIMIT 10");
$response = $bigquery->jobs->query($projectId, $request);
$topSongsArtist = $response->getRows();
$topSongsArtist_data = array();
foreach ($topSongsArtist as $row) {
    array_push($topSongsArtist_data, $row);
}
echo implode(",", $topSongsArtist_data);
