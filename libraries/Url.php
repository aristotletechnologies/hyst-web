<?php
/**
 * Url
 * Handles generation of URLs for future-proofing.
 *
 * For example, if the URL to a profile changes from profile.php?id={$id} to
 * /profile/{$id}, we'd usually have to change a large amount of the codebase.
 * However, if we simply call url_profile($id), we can change that one function
 * and we then have no need to change the codebase in a dramatic manner.
 *
 * @author Connor Gurney <cgurney@aristotle.org>
 */
/**
 * url_endpoint()
 * Returns the URL to any endpoint.
 *
 * @param  string $name         The name of the endpoint.
 * @param  array  $query_string Any query string parameters. 
 * @return string $url          The URL to the endpoint. 
 */
function url_endpoint($name, $query_string = [])
{
	// Create the URL
	$url = '/' . $name . '.php';

	// Add any query string on to it
	if(!empty($query_string))
		$url .= '?' . http_build_query($query_string);

	// Return the URL
	return $url;
}

/**
 * url_home()
 * Returns the URL to the homepage.
 *
 * @return string The URL to the homepage. 
 */
function url_home()
{
	return '/';
}

/**
 * url_profile()
 * Returns the URL to a user's profile.
 *
 * @param  string $user_id The ID of the user.
 * @return string $url     The URL to the profile.
 */
function url_profile($user_id)
{
	// Get the URL to the profile endpoint with the user ID on
	$url = url_endpoint('profile', ['user_id' => $user_id]);

	// Return the URL
	return $url;
}