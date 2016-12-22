<?php
/**
 * rsrc.php
 * Outputs a static resource.
 */
// Run a few tasks, get a database connection and so on...
require __DIR__ . '/../init.php';

// Define a function in case the resource isn't found
function rsrc_not_found()
{
	http_response_code(404);
	header('Content-Type: text/plain');

	exit('404 NOT FOUND');
}

// Split PATH_INFO down
$path_info = explode('/', ltrim($_SERVER['PATH_INFO'], '/'));

// Validate the split PATH_INFO
if(empty($path_info) || count($path_info) !== 2)
	rsrc_not_found();

// Get the revision ID and resource name
list($revision_id, $name) = $path_info;

// Attempt to get the revision
$revision = rsrc_revision_get_by_id($revision_id);

// If the revision doesn't exist, send a 404
if(empty($revision))
	rsrc_not_found();

// Get the resource linked to the revision
$rsrc = rsrc_get_by_id($revision->rsrc_id);

// Check whether the resource exists and is the one referenced in the URL
if(empty($rsrc) || $rsrc->name !== $name)
	rsrc_not_found();

// Get the type of the resource
$type = rsrc_type_get_by_id($rsrc->type_id);

// Process the body if there's a function to do it with
if($type->processing_function && !isset($_GET['noprocess']))
	$revision->body = call_user_func($type->processing_function, $revision->body);

// Send the MIME type header
header('Content-Type: ' . $type->mime_type);

// Send the output
echo $revision->body;

// Echo how many database queries have occurred as a comment
if(isset($_GET['noprocess']))
	echo "\n\n" . $type->comment_prepend . ' ' . $db_query_count . ' ' . $type->comment_append;

// Handle caching and close down the database connection
require __DIR__ . '/../end.php';