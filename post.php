<div class="post">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"/>
        <?php the_post_thumbnail( 'cover', array( 'class' => 'cover' ) ); ?>
    </a>
    <h3><a href="<?php the_permalink(); ?>" /><?php the_title(); ?></a></h3>
    <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 70," […] "); ?></p>
</div>
