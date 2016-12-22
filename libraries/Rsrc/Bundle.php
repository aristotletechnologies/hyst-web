<?php
/**
 * Bundle.php
 * Handles CRUD operations on static resource bundles.
 *
 * @author Connor Gurney <cgurney@aristotle.org>
 */
/**
 * $rsrc_bundle_all
 * All resource bundles.
 */
$rsrc_bundle_all = [];

/**
 * rsrc_bundle_add()
 * Add a resource bundle to the database.
 *
 * @param  string $author_id The user ID of the bundle's author.
 * @param  string $name      The name of the bundle.
 * @return string $id        The ID of the new bundle.
 */
function rsrc_bundle_add($author_id, $name)
{
}

/**
 * rsrc_bundle_delete()
 * Delete a resource bundle from the database.
 *
 * @param  string $id     The ID of the bundle to delete.
 * @return bool   $delete Whether deletion was successful.
 */
function rsrc_bundle_delete($id)
{
}

/**
 * rsrc_bundle_get_all()
 * Get all resource bundles.
 *
 * @return array $bundles All bundles.
 */
function rsrc_bundle_get_all()
{
	// Write the SQL to get the bundles
	$bundles_sql = 'SELECT * FROM rsrc_bundle';

	// Execute the query
	$bundles_query = db_query($bundles_sql);

	// Fetch the bundles
	$bundles = db_rows($bundles_query);

	// Return them
	return $bundles;
}

/**
 * rsrc_bundle_get_by_id()
 * Get a resource bundle by its ID.
 *
 * @param  string $id     The ID of the bundle to get.
 * @return object $bundle The bundle.
 */
function rsrc_bundle_get_by_id($id)
{
	// Get the list of bundles
	global $rsrc_bundle_all;

	// If it's empty, populate it
	if(empty($rsrc_bundle_all))
		$rsrc_bundle_all = rsrc_bundle_get_all();

	// Return the correct one
	return (isset($rsrc_bundle_all[$id]) ? $rsrc_bundle_all[$id] : new StdClass);
}

/**
 * rsrc_bundle_get_by_name()
 * Get a resource bundle by its name.
 *
 * @param  string $id     The name of the bundle to get.
 * @return object $bundle The bundle.
 */
function rsrc_bundle_get_by_name($name)
{
	// Get the list of bundles
	global $rsrc_bundle_all;

	// If it's empty, populate it
	if(empty($rsrc_bundle_all))
		$rsrc_bundle_all = rsrc_bundle_get_all();

	// Find a match
	foreach($rsrc_bundle_all as $bundle)
		if($bundle->name === $name)
		{
			$output = $bundle;
			break;
		}
	
	// Return the match if any was found
	return (isset($output) ? $output : new StdClass);
}

/**
 * rsrc_bundle_get_resources()
 * Gets resources within a bundle.
 *
 * @param  string $id        The ID of the bundle.
 * @return object $resources Resources within the bundle.
 */
function rsrc_bundle_get_resources($id)
{
	// Write the SQL to get the resources
	$resources_sql = 'SELECT rsrc_bundle_item.rsrc_id AS id FROM rsrc_bundle_item JOIN rsrc_bundle ON rsrc_bundle.id = rsrc_bundle_item.bundle_id WHERE rsrc_bundle.id = :id ORDER BY rsrc_bundle_item.order ASC';

	// Execute the query
	$resources_query = db_query($resources_sql, [':id' => $id]);

	// Fetch a list of resources
	$resources = db_rows($resources_query);

	// Loop through and get the information for each
	foreach($resources as $rsrc)
		$resources[$rsrc->id] = rsrc_get_by_id($rsrc->id);

	// Return it
	return $resources;
}

/**
 * rsrc_bundle_update()
 * Update a resource bundle within the database.
 *
 * @param  string $id   The ID of the bundle to update.
 * @param  string $name The new name of the bundle.
 * @return string $id   The ID of the bundle.
 */
function rsrc_bundle_update($id, $name)
{
}