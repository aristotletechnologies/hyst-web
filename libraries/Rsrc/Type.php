<?php
/**
 * Type.php
 * Handles CRUD operations on static resource types.
 *
 * @author Connor Gurney <cgurney@aristotle.org>
 */
/**
 * $rsrc_type_all
 * All resource types.
 */
$rsrc_type_all = [];

/**
 * rsrc_type_get_all()
 * Get all resources types.
 *
 * @return object $types The types.
 */
function rsrc_type_get_all()
{
	// Write the SQL to get the types
	$types_sql = 'SELECT * FROM rsrc_type';

	// Execute the query
	$types_query = db_query($types_sql);

	// Fetch the types data
	$types = db_rows($types_query);

	// Return it
	return $types;
}

/**
 * rsrc_type_get_by_id()
 * Get a resource type by its ID.
 *
 * @param  string $id   The ID of the type to get.
 * @return object $type The type.
 */
function rsrc_type_get_by_id($id)
{
	// Get the list of types
	global $rsrc_type_all;

	// If it's empty, populate it
	if(empty($rsrc_type_all))
		$rsrc_type_all = rsrc_type_get_all();

	// Return the correct one
	return (isset($rsrc_type_all[$id]) ? $rsrc_type_all[$id] : new StdClass);
}