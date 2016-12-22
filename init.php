<?php
/**
 * init.php
 * Handles common tasks for all endpoints.
 *
 * @author Connor Gurney <cgurney@aristotle.org>
 */
// Get all configuration for the site
$config = json_decode(file_get_contents(__DIR__ . '/config.json'));

// Require the Database library
require __DIR__ . '/libraries/Database.php';

/**
 * Get the database credentials.
 * Doing it this way prevents anyone else from getting the live ones.
 */
$db_credentials = $config->database;

// Connect to the database
db_open_connection(
	$db_credentials->dsn,
	$db_credentials->username,
	$db_credentials->password,
	$db_credentials->settings
);

// Fetch and setup other vital libraries
require __DIR__ . '/libraries/Rsrc.php';
require __DIR__ . '/libraries/Rsrc/Bundle.php';
require __DIR__ . '/libraries/Rsrc/Output.php';
require __DIR__ . '/libraries/Rsrc/Process.php';
require __DIR__ . '/libraries/Rsrc/Require.php';
require __DIR__ . '/libraries/Rsrc/Revision.php';
require __DIR__ . '/libraries/Rsrc/Type.php';
require __DIR__ . '/libraries/Template.php';
require __DIR__ . '/libraries/Url.php';

// Require some basic static resources
rsrc_require_bundle('base');