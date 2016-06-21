<?php
/*
Template Name: about
*/
?>

<?php require_once('config.php'); ?>

<?php get_header(); ?>
<div id="single" class="page">

<?php while ( have_posts() ) : the_post(); ?>

    <div id="top">
        <a class="<?php if (LOGO_FONT) { echo 'icon-icon'; } else { echo 'image-icon'; } ?>" href="javascript:history.back()"></a>
    </div>

    <div class="section">
	<div class="images">
	</div><div class="article">
        <div>

        <div class="content">
		    <?php the_content(); ?>
        </div>

        </div>
        </div>
    </div>

<?php endwhile; ?>


</div>

<?php get_footer(); ?>
