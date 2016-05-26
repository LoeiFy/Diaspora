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
<style>
/* http://lorem.in  @author LoeiFy@gmail.com */ 

body,div,h1,h2,h3,h4,h5,li,p,ul{margin:0;padding:0;font-weight:400;list-style:none}html{-webkit-text-size-adjust:100%}body,html{-webkit-tap-highlight-color:transparent;-webkit-font-smoothing:antialiased;background:#fff}body{position:relative;overflow-x:hidden}body:before{background:grey;position:absolute;content:'';width:14px;height:14px;left:50%;top:50%;margin-left:-7px;margin-top:-7px;border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;-webkit-animation:loading 2s ease-out forwards infinite;-moz-animation:loading 2s ease-out forwards infinite;display:none}body.loading:before{display:block}@-webkit-keyframes loading{0%{-webkit-transform:scale(0.3)}50%{-webkit-transform:scale(1)}100%{-webkit-transform:scale(0.3)}}@-moz-keyframes loading{0%{-moz-transform:scale(0.3)}50%{-moz-transform:scale(1)}100%{-moz-transform:scale(0.3)}}body.loading #container,body.loading #single,body.loading .nav{opacity:0}body.loading,html.loading{height:100%;overflow:hidden}
</style>

<script>var duoshuoQuery = {short_name:location.host.replace('.', '')};</script>

<script>if(self!=top){top.location=self.location}</script>
<script src="<?php echo get_template_directory_uri(); ?>/static/basket.js?000"></script>
<script>
	basket.require({ url: '<?php echo get_template_directory_uri(); ?>/dist/Diaspora.css', unique: 12,  execute: false })
	.then(function(responses) {
        _stylesheet.appendStyleSheet(responses[0], function() {});
		basket.require({ url: '<?php echo get_template_directory_uri(); ?>/static/jquery.min.js', unique: 10 })
		.then(function() {
			basket.require({ url: '<?php echo get_template_directory_uri(); ?>/dist/plugin.js', unique: 10 })
			.then(function() {
        		basket.require({ url: '<?php echo get_template_directory_uri(); ?>/dist/Diaspora.js', unique: 16 })
                .then(function() {
                    if (!window.$ || !window.DP) {
                        localStorage.clear()
                    }
                })
			})
		})
	});
</script>

</head>
<body class="loading">
<div id="loader"></div>
