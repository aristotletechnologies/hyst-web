<?php
/**
 * Topic.php
 * Handles working with topics from the database.
 *
 * @author Connor Gurney <cgurney@aristotle.org>
 */
/**
 * topic_get_all_json()
 * Returns a JSON list of topics for the API.
 *
 * @return string $json_output The JSON output for the API.
 */
function topic_get_all_json()
{
	// Define $raw_output to avoid undefined errors
	$raw_output = [
		'response' => 200,
		'count'    => 0,
		'results'  => []
	];

	// Get all the topic
	$topics_query = db_query("SELECT slug, name, description, emoji FROM topic ORDER BY name ASC");

	// Collect the topics into an array
	$topics = db_rows($topics_query, 'slug');

	// Loop through the topics and create the output
	foreach($topics as $topic)
		$raw_output['results'][$topic->slug] = [
			'name'        => $topic->name,
			'description' => $topic->description,
			'emoji'       => $topic->emoji
		];

	// Add the number of topics to the output
	$raw_output['count'] = count($topics);

	// Build the JSON output - don't escape foreign characters
	$json_output = json_encode(
		$raw_output,
		JSON_UNESCAPED_UNICODE
	);

	// Return it to the endpoint
	return $json_output;
}