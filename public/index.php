<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Hyst.io</title>

		<link rel="stylesheet" href="/static/app.css">
	</head>

	<body>
		<div class="container" id="hystio">
			<header class="navbar">
				<a class="navbar__logo" href="/">Hyst.io</a>

				<nav class="menu">
					<a class="navbar__menu__item menu__item" href="/">Feed</a>
					<a class="navbar__menu__item menu__item" href="/explore">Popular</a>
					<a class="navbar__menu__item menu__item" href="/notifications">Notifications</a>
				</nav>

				<form action="/search" class="navbar__search" method="GET">
					<span class="navbar__search__icon fa fa-search"></span>
					<input class="navbar__search__input" name="q" placeholder="Search..." type="text">
				</form>

				<div class="clearfix"></div>
			</header>

			<div class="body">
				<aside class="sidebar">
					<explore-topics></explore-topics>
					<trending-hashtags></trending-hashtags>
				</aside>

				<main class="content">
					<form action="/post/new" class="post-form" method="POST">
						<textarea class="post-form__textarea" placeholder="What's going through your head?"></textarea>

						<div class="post-form__buttons">
							<button class="button button--is-primary post-form__submit" type="submit">Post</button>
						</div>
					</form>
				</main>
			</div>
		</div>

		<template id="explore-topics-template">
			<div class="sidebar__block">
				<h4 class="sidebar__block__title">Explore</h4>

				<ul :key="topic.slug" class="sidebar__list" v-for="(topic, topic_slug) in topics">
					<li class="sidebar__list__item">
						<a class="sidebar__list__item__link" href="#" v-bind:href="'explore/' + topic_slug">
							<span class="sidebar__list__item__emoji emojione" v-bind:class="'emojione-' + topic.emoji">
								&#x{{ topic.emoji }};
							</span>

							<div class="sidebar__list__item__text">
								<span class="sidebar__list__item__heading">{{ topic.name }}</span>
								<span class="sidebar__list__item__description">{{ topic.description }}</span>
							</div>

							<div class="clearfix"></div>
						</a>
					</li>
				</ul>
			</div>
		</template>

		<template id="trending-hashtags-template">
			<div class="sidebar__block">
				<h4 class="sidebar__block__title">Trending</h4>

				<ul class="sidebar__list" v-for="(post_count, hashtag) in hashtags">
					<li class="sidebar__list__item">
						<a class="sidebar__list__item__link" href="#" v-bind:href="'search?q=%23' + hashtag">
							<div class="sidebar__list__item__text">
								<span class="sidebar__list__item__heading">#{{ hashtag }}</span>
								<span class="sidebar__list__item__description">{{ post_count }} post<span v-show="post_count != 1">s</span> tagged with this.</span>
							</div>

							<div class="clearfix"></div>
						</a>
					</li>
				</ul>
			</div>
		</template>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.8/vue.js"></script>
		<script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js"></script>
		<script src="/static/app.js"></script>
	</body>
</html>