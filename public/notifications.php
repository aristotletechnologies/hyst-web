<?php
require $_SERVER['DOCUMENT_ROOT'] . '/../libraries/Database.php';

db_open_connection(
	'mysql:host=localhost;dbname=hystio;charset=utf8mb4',
	'root',
	'root'
);

$topics_query = db_query("SELECT * FROM topic ORDER BY name ASC");
$topics       = db_rows($topics_query, 'slug');

$trending_hashtags_query = db_query("SELECT * FROM hashtag ORDER BY post_count DESC, hashtag ASC");
$trending_hashtags       = db_rows($trending_hashtags_query, 'hashtag');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Hyst.io</title>

		<link rel="stylesheet" href="/static/main.css">
	</head>

	<body>
		<div class="container">
			<header class="navbar">
				<a class="navbar__logo" href="/">Hyst.io</a>

				<nav class="menu">
					<a class="menu__item" href="/">Feed</a>
					<a class="menu__item" href="/explore">Popular</a>
					<a class="menu__item" href="/notifications">Notifications</a>
				</nav>

				<form action="/search" class="navbar__search" method="GET">
					<span class="navbar__search__icon fa fa-search"></span>
					<input class="navbar__search__input" name="q" placeholder="Search..." type="text">
				</form>

				<div class="clearfix"></div>
			</header>

			<div class="body">
				<aside class="sidebar">
					<div class="sidebar__block">
						<h4 class="sidebar__block__title">Explore</h4>

						<ul class="sidebar__list">
							<?php foreach($topics as $topic): ?>
								<li class="sidebar__list__item">
									<a class="sidebar__list__item__link" href="/explore/<?php echo $topic->slug; ?>">
										<span class="sidebar__list__item__emoji emojione emojione-<?php echo $topic->emoji; ?>">
											&#x<?php echo $topic->emoji; ?>;
										</span>

										<div class="sidebar__list__item__text">
											<span class="sidebar__list__item__heading"><?php echo $topic->name; ?></span>
											<span class="sidebar__list__item__description"><?php echo $topic->description; ?></span>
										</div>

										<div class="clearfix"></div>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>

					<div class="sidebar__block">
						<h4 class="sidebar__block__title">Trending</h4>

						<ul class="sidebar__list">
							<?php foreach($trending_hashtags as $trending_hashtag): ?>
								<li class="sidebar__list__item">
									<a class="sidebar__list__item__link" href="/search?q=%23<?php echo $trending_hashtag->hashtag; ?>">
										<div class="sidebar__list__item__text">
											<span class="sidebar__list__item__heading">#<?php echo $trending_hashtag->hashtag; ?></span>
											<span class="sidebar__list__item__description"><?php echo $trending_hashtag->post_count; ?> post<?php echo ($trending_hashtag->post_count == 1 ? '' : 's'); ?> tagged with this.</span>
										</div>

										<div class="clearfix"></div>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</aside>

				<main class="content">
					<nav class="menu">
						<a class="menu__item" href="/notifications/likes">Likes</a>
						<a class="menu__item" href="/notifications/mentions">Mentions</a>
					</nav>
				</main>
			</div>
		</div>
	</body>
</html>