<?php
/**
 * Template Name: About
 */
?>

<?php get_header(); ?>

<?php
get_template_part('template-parts/about/about-main');
get_template_part('template-parts/about/why-we');
get_template_part('template-parts/about/audience');
get_template_part('template-parts/about/trust');
get_template_part('template-parts/about/tariffs');
get_template_part('template-parts/about/agency');
get_template_part('template-parts/about/survey');
// Общие этапы — данные с главной
get_template_part('template-parts/home/steps', null, ['class' => 'pb-indent', 'force' => true]);
get_template_part('template-parts/about/anketa');
?>

<?php get_footer(); ?>
