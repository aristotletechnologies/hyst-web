<?php
/**
 * index.php
 * Redirects to the feed or the homepage depending on whether there's an
 * end-user logged in to the site.
 */
// Run a few tasks, get a database connection and so on...
require __DIR__ . '/../init.php';

// Render the template
tpl_render('index');

// Handle caching and close down the database connection
require __DIR__ . '/../end.php';