<?php
/**
 * Template Name: text-page
 */
?>

<?php get_header(); ?>

<section class="text-page pb-indent mb-indent">
	<div class="container">
		<div class="text-page__title s-title">
			<h1><?php the_title(); ?></h1>
		</div>
		<div class="text-page__content">
			<?php
			while (have_posts()) {
				the_post();
				the_content();
			}
			?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
