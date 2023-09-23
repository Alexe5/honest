<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Honest</title>

	<?php wp_head(); ?>
</head>

<body>
	<?php 
        $posts = new WP_Query([
            'posts_per_page' => 0,
            'paged' => 1,
        ]);
	?>

	<?php if ($posts->have_posts()) { ?>
		<div class="posts">
			<?php while ($posts->have_posts()) { ?>
				<?php $posts->the_post(); ?>
				
				<?php get_template_part('parts/post'); ?>
			<?php } ?>

			<?php if ($posts->max_num_pages > 1) { ?>
				<button class="more" type="button">More</button>
			<?php } ?>
		</div>
	<?php } ?>
	<?php wp_reset_postdata(); ?>

	<?php wp_footer(); ?>

<script>
	let currentPage = 1;

	$('.more').on('click', function() {
		currentPage++;

		$.ajax({
			type: 'POST',
			url: '/wp-admin/admin-ajax.php',
			dataType: 'html',
			data: {
				action: 'load_more',
				paged: currentPage,
			},
			beforeSend: function() {
				$('.more').text('Loading...');
			},
			success: function(res) {
				$(res).insertBefore('.more');
				$('.more').text('More');

				if ( currentPage === <?= $posts->max_num_pages ?> ) {
					$('.more').remove();
				}
			}
		});
	});
</script>
</body>
</html>