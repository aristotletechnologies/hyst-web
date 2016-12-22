<?php
/**
 * end.php
 * Handles caching and shuts down the database connection.
 *
 * @author Connor Gurney <cgurney@aristotle.org>
 */
// Close the database connection
db_close_connection();