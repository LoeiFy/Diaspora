<?php 
if (is_home()) {
    $description = get_bloginfo('description');
    $keywords = "素锦, inspiration, customization, rainmeter, design, web, 壁纸, 设计, 收集, wallpaper, collection, jaku, icon";
} else {
    if ($post->post_excerpt) {
        $description = $post->post_excerpt;
    } else {
        $description = substr(strip_tags($post->post_content),0,100);
    }
    $keywords = "";
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {
        $keywords = $keywords . $tag->name . ", ";
    }
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="loading">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="google" content="notranslate" />
<title><?php bloginfo('name'); ?> <?php wp_title( '|', true, 'left' ); ?></title>
<meta name="keywords" content="<?php echo $keywords ?>" />
<meta name="description" content="<?php echo $description ?>" />
<meta name="author" content="LoeiFy">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/72.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/images/57.png">
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/32.png" />
<style>
.image-logo{background-image:url(<?php echo get_template_directory_uri(); ?>/images/logo.png)}body.mu .image-logo{background-image:url(<?php echo get_template_directory_uri(); ?>/images/logo_black.png)}.image-icon{background-image:url(<?php echo get_template_directory_uri(); ?>/images/logo_min.png)}
</style>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/Diaspora.css" />
<?php wp_head(); ?>
</head>
<body class="loading">
<div id="loader"></div>
