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
		    <?php tz_printLikes(get_the_ID()); ?>
		    <?php get_template_part( 'social' ); ?>
            <div class="like"></div>
        </div>
        <div class="control">
            <span>post by <?php the_author(); ?></span>&nbsp; // &nbsp;
            <span><?php the_time('F j, Y'); ?> </span>&nbsp; // &nbsp;
            <span><?php the_category(', '); ?></span>&nbsp; // &nbsp;
            <span><?php echo getPostViews(get_the_ID()); ?> views</span>
        </div>
    </div>

	<?php $args = array('post_type' => 'attachment', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC', 'post_mime_type' => 'image' ,'post_status' => null, 'post_parent' => $post->ID ); $attachments = get_posts($args); if ($attachments) { ?>

	<div class="images">

        <?php foreach ( $attachments as $attachment ) { ?>
            <?php $img = wp_get_attachment_image_src($attachment->ID,'thumbnail');?>
			<a target="_blank" href="<?php echo wp_get_attachment_url( $attachment->ID , false ); ?>"><img width="300" height="<?php echo $img[2] ?>" src="<?php echo $img[0] ?>"/></a>
		<?php } ?>

	</div>

    <div class="article">

		<h2><?php the_title(); ?></h2>

        <div class="content">
		    <?php the_content(); ?>
        </div>

		<?php get_template_part( 'comment-box' ); ?>

        <div class="relate">
			<?php previous_post_link('%link'); ?>
        	<?php next_post_link('%link'); ?>
	        <?php get_template_part( 'related' ); ?>
        </div>

    </div>

	<?php endwhile; endif; ?>

</div>       
