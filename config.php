<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Google\Cloud\BigQuery\BigQueryClient;
use Google\Cloud\Storage\StorageClient;

# Your Google Cloud Platform project ID
$projectId = 's3818102-asm1';

# Instantiates a client
$storage = new StorageClient([
    'projectId' => $projectId
]);

$storage->registerStreamWrapper();

$FILE_PATH = "gs://pcminh-asm1/project.csv";
    // $FILE_PATH = "project.csv";
