<?php require_once('config.php'); ?>

<?php get_header(); ?>

<div id="single" class="page">

    <div id="top">
        <a class="<?php if (LOGO_FONT) { echo 'icon-icon'; } else { echo 'image-icon'; } ?>" href="javascript:history.back()"></a>
    </div>

    <div class="section">
	<div class="images">
	</div><div class="article">
        <div>

        <div class="content">
            <h1>404 Not Found</h1>
            <p>The page you were looking for is no longer available.</p>
        </div>
	<center>	
	<?php get_search_form(); ?>
	</center>	
        </div>
        </div>
    </div>

</div>

<?php get_footer(); ?>
