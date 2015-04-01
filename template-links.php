<?php
/*
Template Name: links
*/
?>

<?php get_header(); ?>
<div id="single" class="bgf w">
	<div class="w900 center pt25" id="single_logo">
		<a class="db center bg3" href="/"></a>
	</div>
<div id="s_wrapper">
	<header class="s_header w900 center oh mt50">
		<h2 class="f30 c3"><?php the_title(); ?></h2>
	</header>

	<ul class="mt25 w900 f16 links center">
		<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
	</ul>
</div>
</div>
</body>
</html><!--
