<?php
/*
Template Name: feedback
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
        
        <div class="comment link" data-id="<?php the_ID(); ?>">添加评论</div>

        </div>
        </div>
    </div>

<?php endwhile; ?>

</div>

</body>
</html>
