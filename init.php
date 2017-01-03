<?php
// Pull in Composer dependencies
require $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';

// Set up the database
require $_SERVER['DOCUMENT_ROOT'] . '/../libraries/Database.php';
db_open_connection('mysql:host=localhost;dbname=hystio;charset=utf8mb4', 'root', 'root');