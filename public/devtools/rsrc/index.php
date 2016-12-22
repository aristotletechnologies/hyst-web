<?php
/**
 * index.php
 * Shows a list of static resources and the option to add new ones.
 */
// Run a few tasks, get a database connection and so on...
require __DIR__ . '/../../../init.php';

// Check privileges
/*if(!auth_logged_in())
	auth_redirect_to_login();
elseif(!user_is_dev())
	header('Location: /');*/

// Require the resource bundle for panels
rsrc_require_bundle('panel');

// Get all resources that are unbundled
$unbundled_resources = rsrc_get_all_unbundled();

// Get all bundles
$rsrc_bundles = rsrc_bundle_get_all();

// Get resources in each bundle
foreach($rsrc_bundles as $bundle)
	$bundle->resources = rsrc_bundle_get_resources($bundle->id);

// Loop through the unbundled resources and get a type for each
foreach($unbundled_resources as $rsrc)
	$rsrc->type = rsrc_type_get_by_id($rsrc->type_id);

// Loop through the bundled resources and get a type for each
foreach($rsrc_bundles as $bundle)
	foreach($bundle->resources as $rsrc)
		$rsrc->type = rsrc_type_get_by_id($rsrc->type_id);

// Pass all the resources to the template
tpl_set('unbundled_resources', $unbundled_resources);
tpl_set('rsrc_bundles', $rsrc_bundles);

// Set the endpoint title
tpl_set('endpoint_title', 'Static resources &mdash; Devtools');

// Render the template
tpl_render('devtools/rsrc/index');

// Handle caching and close down the database connection
require __DIR__ . '/../../../end.php';