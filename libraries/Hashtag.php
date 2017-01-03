<?php
/**
 * Hashtag.php
 * Handles working with hashtags from the database.
 *
 * @author Connor Gurney <cgurney@aristotle.org>
 */
/**
 * hashtag_get_trending_json()
 * Returns a JSON list of trending hashtags for the API.
 *
 * @return string $json_output The JSON output for the API.
 */
function hashtag_get_trending_json()
{
	// Define $raw_output to avoid undefined errors
	$raw_output = [
		'response' => 200,
		'count'    => 0,
		'results'  => []
	];

	// Get all the hashtag
	$hashtags_query = db_query("SELECT hashtag, post_count FROM hashtag ORDER BY post_count DESC");

	// Collect the hashtags into an array
	$hashtags = db_rows($hashtags_query, 'slug');

	// Loop through the hashtags and create the output
	foreach($hashtags as $hashtag)
		$raw_output['results'][$hashtag->hashtag] = $hashtag->post_count;

	// Add the number of hashtags to the output
	$raw_output['count'] = count($hashtags);

	// Build the JSON output - don't escape foreign characters
	$json_output = json_encode(
		$raw_output,
		JSON_UNESCAPED_UNICODE
	);

	// Return it to the endpoint
	return $json_output;
}