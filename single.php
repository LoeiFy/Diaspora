<?php require_once('config.php'); ?>

<?php get_header(); ?>

<div id="single">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <?php setPostViews(get_the_ID()); ?>

    <?php $args = array(
        'post_type' => 'attachment',
        'numberposts' => -1, 
        'orderby' => 'menu_order', 
        'order' => 'ASC', 
        'post_mime_type' => 'image', 
        'post_status' => null, 
        'post_parent' => $post->ID 
    ); ?> 

    <div id="top">
        <div class="bar"></div>
        <a class="<?php if (LOGO_FONT) { echo 'icon-icon'; } else { echo 'image-icon'; } ?>" href="javascript:history.back()"></a>
        <div title="播放/暂停" data-id="<?php the_ID() ?>" class="icon-play"></div>
        <div title="查看壁纸" class="icon-images"></div>
		<h3 class="subtitle"><?php the_title(); ?></h3>
        <div class="social">
            <div class="like-icon">
		        <?php tz_printLikes(get_the_ID()); ?>
            </div><!--
         --><div>
		        <?php get_template_part( 'social' ); ?>
            </div>
        </div>
        <div class="scrollbar"></div>
    </div>

    <div class="section">

	<div class="images">
    <div id="jg">
    <?php $attachments = get_posts($args); if ($attachments) { ?>

        <?php foreach ( $attachments as $attachment ) { $img = wp_get_attachment_image_src($attachment->ID,'thumbnail'); ?>
			<a class="zoom icon-zoom" target="_blank" href="<?php echo wp_get_attachment_url( $attachment->ID , false ); ?>"><img width="300" height="<?php echo $img[2] ?>" src="<?php echo $img[0] ?>"/></a>
		<?php } ?>

    <?php } ?>
    </div>
    <a target="_blank" class="downloadlink">壁纸下载</a>
    </div><div class="article">

        <div>

		<h1 class="title"><?php the_title(); ?></h1>

        <div class="stuff">
            <span><?php the_time('F j, Y'); ?> </span>
            <span>阅读 <?php echo getPostViews(get_the_ID()); ?></span>
            <span>字数 <?php echo count_words ($text); ?></span>
            <span>评论 <?php comments_number( '0', '1', '%' ); ?></span>
            <span>喜欢 <?php tz_printLikes(get_the_ID()); ?></span>
        </div>

        <div class="content">
		    <?php the_content(); ?>
        </div>

        <div class="comment-wrap">
        <?php comments_template(); ?> 
        </div>

        </div>

    </div>

    </div>

    <div class="relate">
		<?php get_template_part( 'related' ); ?>
    </div>

	<?php endwhile; endif; ?>

</div>       

<?php get_footer(); ?>
