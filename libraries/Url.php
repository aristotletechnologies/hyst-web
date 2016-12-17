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
 * @author	Connor Gurney <cgurney@aristotle.org>
 * @path	/libraries/Url.php
 */

