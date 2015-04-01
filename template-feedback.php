<?php
/*
Template Name: feedback
*/
?>

<?php get_header(); ?>
<div id="single" class="bgf w">
	<div class="w900 center pt25" id="single_logo">
		<a class="db center bg3" href="/"></a>
	</div>
<div id="s_wrapper">
<?php while ( have_posts() ) : the_post(); ?>
	<header class="s_header w900 center oh mt50">
		<h2 class="f30 c3"><?php the_title(); ?></h2>
	</header>
	<article class="s_article typo mt20 w900 center">
    <?php the_content(); ?>
	</article>
	<footer class="mt20 w900 center">
	<?php get_template_part( 'comment-box' ); ?>
	</footer>
<?php endwhile; // end of the loop. ?>
</div>
</div>
</body>
</html><!--
