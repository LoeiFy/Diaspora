<?php

require_once('config.php');

/* Archives list v2014 by zwwooooo | http://zww.me */
function zww_archives_list() {
	if( !$output = get_option('zww_db_cache_archives_list') ){
		$output = '<div id="archives">';
		$args = array(
			'post_type' => 'post', //如果你有多个 post type，可以这样 array('post', 'product', 'news')  
			'posts_per_page' => -1, //全部 posts
			'ignore_sticky_posts' => 1 //忽略 sticky posts

		);
		$the_query = new WP_Query( $args );
		$posts_rebuild = array();
		$year = $mon = 0;
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$post_year = get_the_time('Y');
			$post_mon = get_the_time('m');
			$post_day = get_the_time('d');
			if ($year != $post_year) $year = $post_year;
			if ($mon != $post_mon) $mon = $post_mon;
			$posts_rebuild[$year][$mon][] = '<li>'. get_the_time('d日: ') .'<a href="'. get_permalink() .'">'. get_the_title() .'</a> <em>('. get_comments_number('0', '1', '%') .')</em></li>';
		endwhile;
		wp_reset_postdata();

		foreach ($posts_rebuild as $key_y => $y) {
			$output .= '<h3 class="al_year">'. $key_y .' 年</h3><ul class="al_mon_list">'; //输出年份
			foreach ($y as $key_m => $m) {
				$posts = ''; $i = 0;
				foreach ($m as $p) {
					++$i;
					$posts .= $p;
				}
				$output .= '<li><span class="al_mon">'. $key_m .' 月 <em> ( '. $i .' 篇文章 )</em></span><ul class="al_post_list">'; //输出月份
				$output .= $posts; //输出 posts
				$output .= '</ul></li>';
			}
			$output .= '</ul>';
		}

		$output .= '</div>';
		update_option('zww_db_cache_archives_list', $output);
	}
	echo $output;
}
function clear_db_cache_archives_list() {
	update_option('zww_db_cache_archives_list', ''); // 清空 zww_archives_list
}
add_action('save_post', 'clear_db_cache_archives_list'); // 新发表文章/修改文章时

// POST NUMBER
function count_words ($text) {   
    global $post;   
    if ( '' == $text ) {   
        $text = $post->post_content;   
        if (mb_strlen($output, 'UTF-8') < mb_strlen($text, 'UTF-8')) $output .= '' . mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($post->post_content))),'UTF-8') . '';   
        return $output;   
    }   
}

//add_filter('show_admin_bar', '__return_false');

// MENU SUPPORT
function register_menu() {
	register_nav_menu('menu', __('Menu'));
}
add_action('init', 'register_menu');

// FEATURED IMAGE SUPPORT
add_theme_support( 'post-thumbnails', array( 'post' ) );

if (!USE_TIMTHUMB) {
    add_image_size( 'cover', 680, 440, true );
}

// NEXT PAGE CLASS
add_filter('next_posts_link_attributes', 'posts_link_attributes');
function posts_link_attributes() {
    return 'class="more"';
}

// FRIENDS LINKS
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

// POSTVIEW 
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
 
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// LIKETHIS
function tz_likeThis($post_id,$action = 'get') {

	if(!is_numeric($post_id)) {
		error_log("Error: Value submitted for post_id was not numeric");
		return;
	} //if

	switch($action) {
	
	case 'get':
		$data = get_post_meta($post_id, '_likes');
		
		if(!is_numeric($data[0])) {
			$data[0] = 0;
			add_post_meta($post_id, '_likes', '0', true);
		} //if
		
		return $data[0];
	break;
	
	
	case 'update':
		if(isset($_COOKIE["like_" + $post_id])) {
			return;
		} //if
		
		$currentValue = get_post_meta($post_id, '_likes');
		
		if(!is_numeric($currentValue[0])) {
			$currentValue[0] = 0;
			add_post_meta($post_id, '_likes', '1', true);
		} //if
		
		$currentValue[0]++;
		update_post_meta($post_id, '_likes', $currentValue[0]);
		
		setcookie("like_" + $post_id, $post_id,time()*20, '/');
	break;

	} //switch

} //tz_likeThis

function tz_printLikes($post_id) {
	$likes = tz_likeThis($post_id);
	
	$who = ' people like ';
	
	if($likes == 1) {
		$who = ' person likes ';
	} //if
	
	if(isset($_COOKIE["like_" . $post_id])) {

	print '<a href="javascript:;" class="likeThis active" id="like-'.$post_id.'"><span class="icon-like"></span><span class="count">'.$likes.'</span></a>';
		return;
	} //if

	print '<a href="javascript:;" class="likeThis" id="like-'.$post_id.'"><span class="icon-like"></span><span class="count">'.$likes.'</span></a>';
} //tz_printLikes


function setUpPostLikes($post_id) {
	if(!is_numeric($post_id)) {
		error_log("Error: Value submitted for post_id was not numeric");
		return;
	} //if
	
	
	add_post_meta($post_id, '_likes', '0', true);

} //setUpPost


function checkHeaders() {
	if(isset($_POST["likepost"])) {
		tz_likeThis($_POST["likepost"],'update');
	} //if

} //checkHeaders

add_action ('publish_post', 'setUpPostLikes');
add_action ('init', 'checkHeaders');

add_action( 'wp_print_styles', 'del_mediaelement', 100 );
function del_mediaelement() {
        wp_deregister_style( 'mediaelement' );
        wp_deregister_script( 'mediaelement' );
}

?>
