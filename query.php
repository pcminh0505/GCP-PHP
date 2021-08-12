<?php

use Google\Cloud\BigQuery\BigQueryClient;

include 'config.php';

require_once('function.php');

$projectId = 's3818102-asm1';
$dataset = 'listenbrainz.listenbrainz.listen';


$bigQuery = new BigQueryClient([
    'projectId' => $projectId,
]);
$jobConfig = $bigQuery->query("SELECT MIN(listened_at) as first_date, MAX(listened_at) as last_date FROM $dataset");
$job = $bigQuery->startQuery($jobConfig);
$queryResults = $job->queryResults();
$last = "";
foreach ($queryResults as $row) {
    $last = $row['last_date'];
}

// 1: Get top artist
$jobConfig = $bigQuery->query("SELECT artist_name, COUNT(artist_name) as artist_occurrences FROM $dataset GROUP BY artist_name ORDER BY artist_occurrences DESC LIMIT 5");
$job = $bigQuery->startQuery($jobConfig);
$queryResults = $job->queryResults();

$topArtist = array();
$topArtistCount = array();
foreach ($queryResults as $row) {
    array_push($topArtist, $row['artist_name']);
    array_push($topArtistCount, $row['artist_occurrences']);
}

// // 2: Get top albums
// $request->setQuery("SELECT release_name, COUNT(release_name) as album_occurrences FROM $dataset GROUP BY release_name ORDER BY album_occurrences DESC LIMIT 6");
// $response = $bigquery->jobs->query($projectId, $request);
// $topAlbums = $response->getRows();
$jobConfig = $bigQuery->query("SELECT release_name, COUNT(release_name) as album_occurrences FROM $dataset GROUP BY release_name ORDER BY album_occurrences DESC LIMIT 6");
$job = $bigQuery->startQuery($jobConfig);
$queryResults = $job->queryResults();
$topAlbums = array();
$topAlbumsCount = array();
$i = 0;
foreach ($queryResults as $row) {
    if ($i == 0) {
        $i++;
    } else {
        array_push($topAlbums, $row['release_name']);
        array_push($topAlbumsCount, $row['album_occurrences']);
    }
}

// // 3: Get top songs
$jobConfig = $bigQuery->query("SELECT track_name as song, artist_name as artist, COUNT(track_name) as plays FROM $dataset GROUP BY song, artist ORDER BY plays DESC LIMIT 5");
$job = $bigQuery->startQuery($jobConfig);
$queryResults = $job->queryResults();
$topSong = array();
$topSongCount = array();
foreach ($queryResults as $row) {
    array_push($topSong, $row['song']);
    array_push($topSongCount, $row['plays']);
}


// 4: Get top songs by year
$jobConfig = $bigQuery->query("WITH temp AS (SELECT EXTRACT(YEAR from listened_at) as year, artist_name, track_name, Count(track_name) as num_plays FROM listenbrainz.listenbrainz.listen GROUP BY track_name,artist_name, year ORDER BY year, num_plays DESC), temp2 AS( SELECT year, MAX(num_plays) as max_track FROM temp GROUP BY year) SELECT DISTINCT temp.year, temp.track_name,temp.num_plays FROM temp INNER JOIN temp2 ON temp.year = temp2.year AND temp.num_plays = temp2.max_track ORDER BY temp.year DESC LIMIT 14");
$job = $bigQuery->startQuery($jobConfig);
$queryResults = $job->queryResults();
$topSongsYear = array();
foreach ($queryResults as $row) {
    array_push($topSongsYear, $row);
}
// 5: Top 10 songs of artist
$artist = isset($_GET["artist"]) ? $_GET["artist"] : "Taylor Swift";
$artist_lowcase = strtolower($artist);
$jobConfig = $bigQuery->query("SELECT track_name, COUNT(1) as num_of_plays
FROM $dataset
WHERE LOWER(artist_name) = '$artist_lowcase'
GROUP BY track_name
ORDER BY num_of_plays DESC
LIMIT 10");
$job = $bigQuery->startQuery($jobConfig);
$queryResults = $job->queryResults();
// $topSongsArtist 
$topSongsArtist = array();
$topSongsArtistCount = array();
foreach ($queryResults as $row) {
    array_push($topSongsArtist, $row['track_name']);
    array_push($topSongsArtistCount, $row['num_of_plays']);
}
