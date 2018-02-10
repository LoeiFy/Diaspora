<ul>
<h3><em>相 关 文 章</em><span>
    <a href="javascript: window.scrollTo(0, 0);">返回顶部</a>
    <?php previous_post_link('%link', '上一篇'); ?>
    <?php next_post_link('%link', '下一篇'); ?>
</span></h3>
<p id="prev_next" style="display: none;"><?php previous_post_link('%link'); ?><?php next_post_link('%link'); ?></p>
<?php
$post_num = 7; // 數量設定.
$exclude_id = $post->ID; // 單獨使用要開此行 //zww: edit
$posttags = get_the_tags(); $i = 0;
if ( $posttags ) {
    $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ','; //zww: edit
    $args = array(
        'post_status' => 'publish',
        'tag__in' => explode(',', $tags), // 只選 tags 的文章. //zww: edit
        'post__not_in' => explode(',', $exclude_id), // 排除已出現過的文章.
        'caller_get_posts' => 1,
        'orderby' => 'rand', // 依評論日期排序.
        'posts_per_page' => $post_num
    );
    query_posts($args);
    while( have_posts() ) { the_post();//edit by Jeff at DeveWork.com
        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');?>
    <li>
        <div>
            <a class="relatea" data-id="<?php the_ID() ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 170,"..."); ?></p>
         </div><!--
      --><a href="<?php the_permalink(); ?>" data-id="<?php the_ID() ?>" title="<?php the_title(); ?>">
            <img class="relateimg" src="<?php echo $thumbnail[0]; ?>" alt="<?php the_title(); ?>" />
         </a>
    </li>

    <?php
        $exclude_id .= ',' . $post->ID; $i ++;
    } wp_reset_query();
}
if ( $i < $post_num ) { // 當 tags 文章數量不足, 再取 category 補足.
    $cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
    $args = array(
        'category__in' => explode(',', $cats), // 只選 category 的文章.
        'post__not_in' => explode(',', $exclude_id),
        'caller_get_posts' => 1,
        'orderby' => 'rand',
        'posts_per_page' => $post_num - $i
    );
    query_posts($args);
    while( have_posts() ) { the_post(); //edit by Jeff at DeveWork.com
     $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');?>
    <li>
        <div>
            <a class="relatea" data-id="<?php the_ID() ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            <p><?php echo wp_trim_words( get_the_content(), 170, '...' ); ?></p>
         </div><!--
      --><a data-id="<?php the_ID() ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <img class="relateimg" src="<?php echo $thumbnail[0]; ?>" alt="<?php the_title(); ?>" />
         </a>
    </li>
    <?php $i++;
    } wp_reset_query();
}
if ( $i  == 0 )  echo '';
?>
</ul>
