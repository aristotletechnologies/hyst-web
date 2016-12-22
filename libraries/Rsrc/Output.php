<?php
/**
 * Output.php
 * Handles outputting static resources to the client.
 *
 * @author Connor Gurney <cgurney@aristotle.org>
 */
/**
 * rsrc_output_all()
 * Outputs all resources for the current endpoint.
 *
 * @return void
 */
function rsrc_output_all()
{
	// Get access to the resource stack
	global $rsrc_stack;

	// Loop through and echo each
	foreach($rsrc_stack as $rsrc)
		echo $rsrc;
}