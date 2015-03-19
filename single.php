<?php get_header(); ?>

<div id="single">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <?php setPostViews(get_the_ID()); ?>

    <div id="top">
        <a href="javascript:history.back()">home</a>
        <div class="tab">
            <div class="text"></div>
            <div class="pic"></div>
        </div>
        <div class="social">
            <div class="share"></div>
            <div class="like"></div>
        </div>
        <div class="control">
        </div>
    </div>

	<?php $args = array('post_type' => 'attachment', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC', 'post_mime_type' => 'image' ,'post_status' => null, 'post_parent' => $post->ID ); $attachments = get_posts($args); if ($attachments) { ?>

	<div class="image_imgs rel oh">

		<div class="img_grid center oh">
        <?php foreach ( $attachments as $attachment ) { ?>
        <?php $image_attributes = wp_get_attachment_image_src($attachment->ID,'thumbnail');?>
			<a target="_blank" class="left rel cf f30 db postimgs icon-search" href="<?php echo wp_get_attachment_url( $attachment->ID , false ); ?>"><img class="db" width="300" height="<?php echo $image_attributes[2] ?>" src="<?php echo $image_attributes[0] ?>"/></a>
		<?php } ?>
		</div>
		<?php } ?>
        <div class="abs mark"></div>
        <div class="abs shrink"></div>

	</div>

    <div id="single_logo">
        <a class="rel db" href="/"></a>
        <div id="close" href="/" class="c0 rel dib f30 icon-cross3"></div>
    </div>

	<header class="s_header oh w900 center">
		<h2 class="f30 mb15 c3"><?php the_title(); ?></h2>
        <p class="f12 mr10 left tru ca0">
            <span>post by <?php the_author(); ?></span>&nbsp; // &nbsp;
            <span><?php the_time('F j, Y'); ?> </span>&nbsp; // &nbsp;
            <span><?php the_category(', '); ?></span>&nbsp; // &nbsp;
            <span><?php echo getPostViews(get_the_ID()); ?> views</span>
        </p>
	</header>

	<article class="s_article typo oh mt20 w900 center">
		<?php the_content(); ?>
	</article>

	<section class="postmore mt25 rel w900 center">
		<?php tz_printLikes(get_the_ID()); ?>
		<?php get_template_part( 'social' ); ?>

		<nav class="nav rel mt20">
			<?php previous_post_link('%link'); ?>
        	<?php next_post_link('%link'); ?>
		</nav>

	</section>

	<footer class="mt20 w900 center">

		<?php //get_template_part( 'author' ); ?>

	    <?php get_template_part( 'related' ); ?>

		<?php get_template_part( 'comment-box' ); ?>

	</footer>

	<?php endwhile; endif; ?>

</div>       
