<?php
/**
 * Database.php
 * Handles working with any PDO-supported database. In practice, this
 * will be MySQL.
 *
 * @author Connor Gurney <cgurney@aristotle.org>
 */
/**
 * $db_connection
 * A database connection, opened using db_open_connection() and
 * closed with db_close_connection().
 */
$db_connection = null;

/**
 * $db_query_count
 * The number of queries executed on the current endpoint.
 */
$db_query_count = 0;

/**
 * db_close_connection()
 * Closes the database connection.
 *
 * @return void
 */
function db_close_connection()
{
	// Get access to the connection
	global $db_connection;

	// Close it
	$db_connection = null;
}

/**
 * db_open_connection()
 * Opens the database connection.
 *
 * @return void
 */
function db_open_connection($dsn, $username = '', $password = null, $settings = [])
{
	// Get access to the holder of the connection
	global $db_connection;
	
	// Try to open a PDO connection
	try {
		$db_connection = new PDO($dsn, $username, $password, $settings);
	}

	// Catch an error
	catch(PDOException $error)
	{
		// TODO: Mail the Hyst.io team.
		exit();
	}
}

/**
 * db_query()
 * Run a SQL query against the database.
 *
 * @param  string       $sql        The SQL to run.
 * @param  array        $parameters Any bound parameters in the SQL and their
 *                                  values.
 * @return PDOStatement $query      The PDO result of the query.
 */
function db_query($sql, $parameters = [])
{
	// Get the database connection and query count objects
	global $db_connection,
	       $db_query_count;

	// Prepare the query
	$query = $db_connection->prepare($sql);

	// Execute it
	$query->execute($parameters);

	// Increment the query count
	$db_query_count++;

	// Return the query result
	return $query;
}

/**
 * db_row()
 * Return a single row from a db_query() call.
 *
 * @param  object $query The result of the db_query() call.
 * @return object $row   The row.
 */
function db_row($query)
{
	// Fetch the row
	$row = $query->fetch(PDO::FETCH_OBJ);

	// Return the row
	return $row;
}

/**
 * db_rows()
 * Returns all rows from a db_query() call.
 *
 * @param  object $query       The result of the db_query() call.
 * @param  string $primary_key The name of the field to use as the output key.
 * @return array  $rows        The rows.
 */
function db_rows($query, $primary_key = 'id')
{
	// Instantiate an empty array to store all the rows
	$rows = [];

	// Fetch the rows
	while($row = $query->fetch(PDO::FETCH_OBJ))
	{
		$rows[$row->{$primary_key}] = $row;
	}

	// Return the rows
	return $rows;
}
