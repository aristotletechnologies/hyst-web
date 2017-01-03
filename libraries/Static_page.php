<?php
/**
 * Static_page.php
 * Handles working with static pages from the database.
 *
 * @author Connor Gurney <cgurney@aristotle.org>
 */
// Use the Markdown library for page bodies
use \Michelf\Markdown;

/**
 * static_page_get_json()
 * Returns a JSON list of static pages for the API.
 *
 * @return string $json_output The JSON output for the API.
 */
function static_page_get_json()
{
	// Define $raw_output to avoid undefined errors
	$raw_output = [
		'response' => 200,
		'count'    => 0,
		'data'     => []
	];

	// Get all the static pages
	$static_pages_query = db_query("SELECT slug, name, body FROM static_page ORDER BY name ASC");

	// Collect the static pages into an array
	$static_pages = db_rows($static_pages_query, 'slug');

	// Loop through the static_pages and create the output
	foreach($static_pages as $static_page)
		$raw_output['data'][$static_page->slug] = [
			'name' => $static_page->name,
			'body' => Markdown::defaultTransform($static_page->body)
		];

	// Add a count of static pages to the output
	$raw_output['count'] = count($static_pages);

	// Build the JSON output - don't escape foreign characters
	$json_output = json_encode(
		$raw_output,
		JSON_UNESCAPED_UNICODE
	);

	// Return it to the endpoint
	return $json_output;
}