<div class="post">
	<h2 class="post__title"><?= get_the_title() ?></h2>
	<p class="post__text"><?= wp_trim_words( wp_strip_all_tags(get_the_content()), 25 ) ?></p>
</div>