<?php
/*
Template Name: Archive
*/
?>

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
        <?php zww_archives_list(); ?>
        </div>
        

        </div>
        </div>
    </div>

</div>

<?php get_footer(); ?>
