<?php
/**
 * Rsrc.php
 * Handles static resources such as stylesheets and images.
 *
 * @author Connor Gurney <cgurney@aristotle.org>
 */
/**
 * $rsrc_all
 * All static resource.
 */
$rsrc_all = [];

/**
 * rsrc_add()
 * Add a resource to the database and create an initial revision.
 */
function rsrc_add()
{
}

/**
 * rsrc_get_all()
 * Get all resources.
 *
 * @return array $resources All resources.
 */
function rsrc_get_all()
{
	// Write the SQL to get the resources
	$resources_sql = 'SELECT * FROM rsrc';

	// Execute the query
	$resources_query = db_query($resources_sql);

	// Fetch the resources
	$resources = db_rows($resources_query);

	// Return them
	return $resources;
}

/**
 * rsrc_get_all_unbundled()
 * Gets all resources that aren't in any bundles.
 *
 * @return array $resources All unbundled resources.
 */
function rsrc_get_all_unbundled()
{
	// Write the SQL to get the bundle
	$resources_sql = 'SELECT * FROM rsrc WHERE NOT EXISTS(SELECT COUNT(*) FROM rsrc_bundle_item WHERE rsrc_id = rsrc.id LIMIT 1)';

	// Execute the query
	$resources_query = db_query($resources_sql);

	// Fetch the resources
	$resources = db_rows($resources_query);

	// Return them
	return $resources;
}

/**
 * rsrc_get_by_id()
 * Get a resource by its ID.
 *
 * @param  string $id   The ID of the resource to get.
 * @return object $rsrc The resource.
 */
function rsrc_get_by_id($id)
{
	// Get the list of resources
	global $rsrc_all;

	// If it's empty, populate it
	if(empty($rsrc_all))
		$rsrc_all = rsrc_get_all();

	// Return the correct one
	return (isset($rsrc_all[$id]) ? $rsrc_all[$id] : new StdClass);
}

/**
 * rsrc_get_by_name()
 * Get a resource by its name.
 *
 * @param  string $name The name of the resource to get.
 * @return object $rsrc The resource.
 */
function rsrc_get_by_name($name)
{
	// Write the SQL to get the bundle
	$rsrc_sql = 'SELECT * FROM rsrc WHERE name = :name LIMIT 1';

	// Execute the query
	$rsrc_query = db_query($rsrc_sql, [':name' => $name]);

	// Fetch the resource data
	$rsrc = db_row($rsrc_query);

	// Return it
	return $rsrc;
}


/**
 * rsrc_update()
 * Update a resource.
 */
function rsrc_update()
{
}