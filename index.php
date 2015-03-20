<?php get_header(); ?>

<div id="container">	

	<div id="home">
		<a id="logo" href="/" title="<?php bloginfo('name'); ?>"></a>
		<?php wp_nav_menu( array( 'theme_location' => 'menu', 'container' => '', 'fallback_cb' => '' ) ); ?>
        <img src="<?php header_image(); ?>" />
	</div>

    <div id="primary">
    
        <div class="group">
            <?php if (have_posts()) : $i = 0; while (have_posts()) : the_post(); $i ++; ?>
            <?php 
                $size = rand(300, 460); $w = 1000; $h = 1000;

                switch ($i % 4) 
                {
                    case 1:
                        $left = rand(-($size / 4), $w / 2 - $size);
                        $top = rand(0, $h / 2 - $size / 4 * 3);
                        break;
                    case 0:
                        $left = rand(-($size / 4), $w / 2 - $size);
                        $top = rand(-($size / 4), $h / 2 - $size);
                        break;
                    case 2:
                        $left = rand(0, $w / 2 - $size / 4 * 3);
                        $top = rand(-($size / 4), $h / 2 - $size);
                        break;
                    case 3:
                        $left = rand(0, $w / 2 - $size / 4 * 3);
                        $top = rand(0, $h / 2 - $size / 4 * 3);
                        break;
                }
            ?>

            <div style="width: <?php echo $size ?>px; height: <?php echo $size ?>px; margin-left: <?php echo $left ?>px; margin-top: <?php echo $top ?>px;" id="post<?php the_Id() ?>" class="post post<?php echo $i % 4; ?>">
                    <a class="inner" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('cover'); ?>
                        <div style="background: rgba(<?php echo rand(0, 200); ?>, <?php echo rand(0, 200); ?>, <?php echo rand(0, 200); ?>, .7)" class="overlay"><p><?php the_title(); ?></p></div>
                    </a>
            </div>

<?php if ($i % 4 == 0) : ?>
        </div>

        <div class="group">
        <?php endif; endwhile; endif; ?>
        </div>

    </div>
  
</div>
<div id="preview"></div>
</body>
</html>
