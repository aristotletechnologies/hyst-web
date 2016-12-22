<?php
/**
 * Require.php
 * Allows resources and bundles to be required in an endpoint.
 *
 * @author Connor Gurney <cgurney@aristotle.org>
 */
/**
 * $rsrc_stack
 * An array of resources required by the current endpoint.
 */
/**
 * rsrc_require()
 * Require a single resource.
 *
 * @param  object/string $rsrc The resource or the name of it.
 * @return void
 */
function rsrc_require($rsrc)
{
	// Get access to the resource stack
	global $rsrc_stack;

	// If only the name is passed, get the resource
	if(is_string($rsrc))
		$rsrc = rsrc_get_by_name($rsrc);

	// Only continue if the resource isn't already required
	if(isset($rsrc_stack[$rsrc->name]))
		return;

	// Get information on the type of the resource
	$type = rsrc_type_get_by_id($rsrc->type_id);

	// Get the active revision for the resource
	$revision = rsrc_revision_get_by_id($rsrc->active_revision_id);

	// Add the revision to a list of resources
	$rsrc_stack[$rsrc->name] = $type->output_prepend . url_endpoint('rsrc') . '/' . $revision->id . '/' . $rsrc->name . $type->output_append;
}

/**
 * rsrc_require_bundle()
 * Require a resource bundle.
 *
 * @param  string $name The name of the bundle.
 * @return void
 */
function rsrc_require_bundle($name)
{
	// Get the bundle
	$bundle = rsrc_bundle_get_by_name($name);

	// Get resources within it
	$bundle_resources = rsrc_bundle_get_resources($bundle->id);

	// Require each of those
	foreach($bundle_resources as $resource)
		rsrc_require($resource);
}