<?php get_header(); ?>

<div class="nav">
<?php wp_nav_menu( array( 'theme_location' => 'menu', 'container' => '', 'fallback_cb' => '' ) ); ?>
<p>&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>. Powered by WordPress</p>
</div>

<div id="container">	

    <?php if (have_posts()) : $count = 0;  while (have_posts()) : the_post(); $count++; if( $count <= 1 ): ?>

	<?php $cover = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); ?>
	
	<div id="screen" data-url="<?php echo $cover[0] ?>" data-width="<?php echo $cover[1] ?>" data-height="<?php echo $cover[2] ?>">
        <a class="icon-menu switchmenu"></a>
		<a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
	</div>

	<div style="display: none;">
	    <?php get_template_part( 'post' ); ?>
	</div>

    <div id="primary">

    <?php else : ?>

    <?php get_template_part( 'post' ); ?>

    <?php endif; endwhile; endif; ?>

    </div>
    
    <div id="pager"><?php next_posts_link(('加载更多')); ?></div>
  
</div>
<div id="preview"></div>
</body>
</html><!--
