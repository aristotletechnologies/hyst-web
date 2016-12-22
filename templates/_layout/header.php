<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<meta charset="utf-8">

		<title><?php echo (isset($endpoint_title) ? $endpoint_title . ' &mdash; ' : ''); ?>Hyst.io</title>

		<?php rsrc_output_all(); ?>
	</head>

	<body>
		<div class="container">
			<header class="navbar">
				<a class="navbar__brand" href="<?php echo url_home(); ?>">Hyst.io</a>
			</header>

			<div class="body">