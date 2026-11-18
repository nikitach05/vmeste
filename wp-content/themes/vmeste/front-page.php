<?php get_header(); ?>

<?php
get_template_part('template-parts/home/main');
get_template_part('template-parts/home/for-whom');
get_template_part('template-parts/home/formats');
get_template_part('template-parts/home/for-you');
get_template_part('template-parts/home/founder');
get_template_part('template-parts/home/steps', null, ['class' => 'pt-indent']);
get_template_part('template-parts/home/materials');
get_template_part('template-parts/home/environment');
get_template_part('template-parts/home/events');
get_template_part('template-parts/home/partners');
get_template_part('template-parts/home/request');
?>

<?php get_footer(); ?>
