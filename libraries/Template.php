<?php
/**
 * Template.php
 * Handles rendering templates to the client.
 *
 * @author Connor Gurney <cgurney@aristotle.org>
 */
/**
 * $tpl_vars
 * Variables set for all templates on the current endpoint.
 */
$tpl_vars = [];

/**
 * tpl_render()
 * Renders a template to the client.
 *
 * @param string $name The name of the template.
 */
function tpl_render($name)
{
	/**
	 * Get access to the list of variables and the database query count.
	 * We do this here because we can't after tpl_render() is called nor before.
	 */
	global $tpl_vars,
	       $db_query_count;

	// Pass them to the templates
	extract($tpl_vars);

	// Output the global site header
	require __DIR__ . '/../templates/_layout/header.php';

	// Output the main template
	require __DIR__ . '/../templates/' . $name . '.php';

	// Output the global site footer
	require __DIR__ . '/../templates/_layout/footer.php';
}

/**
 * tpl_set()
 * Sets a variable for all templates on the current endpoint.
 *
 * @param  string $key   The key for the variable.
 * @param  mixed  $value The value for the variable.
 * @return void
 */
function tpl_set($key, $value)
{
	// Get access to the list of variables so we can add one
	global $tpl_vars;

	// Add the variable
	$tpl_vars[$key] = $value;
}