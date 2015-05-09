<?php get_header(); ?>

<div class="nav">
<?php wp_nav_menu( array( 'theme_location' => 'menu', 'container' => '', 'fallback_cb' => '' ) ); ?>
<p>&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>. Powered by WordPress</p>
</div>

<div id="container">	

	<div id="home" class="loading skew">
		<a id="logo" class="icon-logo" href="/" title="<?php bloginfo('name'); ?>"></a>
        <span class="icon-menu switchmenu"></span>
	</div>

    <?php if (have_posts()) : $count = 0;  while (have_posts()) : the_post(); $count++; if( $count <= 1 ): ?>

	<?php $cover = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); ?>
	
	<div id="screen" data-img="<?php echo $cover[0] ?>" data-width="<?php echo $cover[1] ?>" data-height="<?php echo $cover[2] ?>">
		<a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
	</div>

	<div style="display: none;">
	    <?php get_template_part( 'post' ); ?>
	</div>

    <?php else : ?>

    <div id="primary">

        <?php get_template_part( 'post' ); ?>
  
    <?php endif; endwhile; endif; ?>
    
    <div id="pager"><?php next_posts_link(('加载更多')); ?></div>
  
</div>
<div id="preview"></div>
</body>
</html><!--
