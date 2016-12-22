<?php
/**
 * Revision.php
 * Handles revisions of static resources.
 *
 * @author Connor Gurney <cgurney@aristotle.org>
 */
/**
 * $rsrc_revision_all
 * All resource revisions.
 */
$rsrc_revision_all = [];

/**
 * rsrc_revision_add()
 * Adds a revision for a resource.
 *
 * @param  string $rsrc_id     The ID of the resource.
 * @param  string $author_id   The user ID of the revision's author.
 * @param  string $body        The body of the resource.
 * @return string $revision_id The ID of the new revision.
 */
function rsrc_revision_add($rsrc_id, $author_id, $body)
{
	// INSERT INTO rsrc_revision SET id = LEFT(UUID(), 7)
}

/**
 * rsrc_revision_get_all()
 * Gets all resource revisions.
 *
 * @return array $revisions All resource revisions.
 */
function rsrc_revision_get_all()
{
	// Write the SQL to get the bundle
	$revisions_sql = 'SELECT * FROM rsrc_revision';

	// Execute the query
	$revisions_query = db_query($revisions_sql);

	// Fetch the revisions
	$revisions = db_rows($revisions_query);

	// Return them
	return $revisions;
}

/**
 * rsrc_revision_get_by_id()
 * Gets a revision of a resource by its ID.
 *
 * @param  string $id       The ID of the revision.
 * @return object $revision The revision.
 */
function rsrc_revision_get_by_id($id)
{
	// Get the list of revisions
	global $rsrc_revision_all;

	// If it's empty, populate it
	if(empty($rsrc_revision_all))
		$rsrc_revision_all = rsrc_revision_get_all();

	// Return the correct one
	return (isset($rsrc_revision_all[$id]) ? $rsrc_revision_all[$id] : new StdClass);
}

/**
 * rsrc_revision_get_first()
 * Gets the first revision of a resource.
 *
 * @param  string $rsrc_id  The ID of the resource.
 * @return object $revision The first revision.
 */
function rsrc_revision_get_first($rsrc_id)
{
	// Write the SQL to get the revision
	$revision_sql = 'SELECT * FROM rsrc_revision WHERE rsrc_id = :id ORDER BY timestamp ASC LIMIT 1';

	// Execute the query
	$revision_query = db_query($revision_sql, [':id' => $rsrc_id]);

	// Fetch the revision data
	$revision = db_row($revision_query);

	// Return it
	return $revision;
}

/**
 * rsrc_revision_get_latest()
 * Gets the latest revision of a resource.
 *
 * @param  string $rsrc_id  The ID of the resource.
 * @return object $revision The latest revision.
 */
function rsrc_revision_get_latest($rsrc_id)
{
	// Write the SQL to get the revision
	$revision_sql = 'SELECT * FROM rsrc_revision WHERE rsrc_id = :id ORDER BY timestamp DESC LIMIT 1';

	// Execute the query
	$revision_query = db_query($revision_sql, [':id' => $rsrc_id]);

	// Fetch the revision data
	$revision = db_row($revision_query);

	// Return it
	return $revision;
}

/**
 * rsrc_revision_rollback()
 * Roll a resource back to a specific revision.
 *
 * @param  string $rsrc_id     The ID of the resource.
 * @param  string $revision_id The ID of the revision to roll back
 *                             to.
 * @return string $revision_id The ID of the revision that was
 *                             rolled back to.
 */
function rsrc_revision_rollback($rsrc_id, $revision_id)
{
}