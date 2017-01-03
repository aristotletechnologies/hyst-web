<?php
// Require shared dependencies
require $_SERVER['DOCUMENT_ROOT'] . '/../init.php';

// Pull the Topic library in
require $_SERVER['DOCUMENT_ROOT'] . '/../libraries/Topic.php';

// Indicate that we're sending JSON
header('Content-Type: text/json');

// Send the topics
echo topic_get_all_json();

// Close the endpoint down
require $_SERVER['DOCUMENT_ROOT'] . '/../end.php';