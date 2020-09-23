<?php

use BatchRecord\Dao\Connection;

require __DIR__ . "/../AutoloaderSourceCode.php";


$connection = Connection::getInstance()->getConnection();
$smmt = $connection->prepare("SELECT * FROM producto");
$smmt->execute();
$smmt->fetchAll(PDO::FETCH_ASSOC);

