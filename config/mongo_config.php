<?php
require '../vendor/autoload.php';

try {
    
    $client = new MongoDB\Client("mongodb://localhost:27017");
    
    $collection = $client->factory_db->support_tickets;
} catch (Exception $e) {
    die("MongoDB Bağlantı Hatası: " . $e->getMessage());
}
?>