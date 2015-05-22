<div class="post">
    <?php $img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); ?>
    <a data-id="<?php the_ID() ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <img width="680" height="440" src="<?php echo get_template_directory_uri(); ?>/timthumb/timthumb.php?src=<?php echo $img[0] ?>" class="cover" />
    </a>
    <div class="else">
        <p><?php the_time('F j, Y'); ?></p>
        <h3><a data-id="<?php the_ID() ?>" class="posttitle" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 100,"..."); ?></p>
        <p class="here">
            <span class="icon-letter"><?php echo count_words ($text); ?></span>
            <span class="icon-view"><?php echo getPostViews(get_the_ID()); ?></span>
            <?php tz_printLikes(get_the_ID()); ?>
        </p>
    </div>
</div>
