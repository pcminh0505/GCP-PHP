<?php

    require_once(__DIR__ . '/vendor/autoload.php');

    use Google\Cloud\Storage\StorageClient;

    # Your Google Cloud Platform project ID
    $projectId = 's3818102-asm1';

    # Instantiates a client
    $storage = new StorageClient([
    'projectId' => $projectId
    ]);

    $storage->registerStreamWrapper();

    $FILE_PATH = "project.csv";
    
?>