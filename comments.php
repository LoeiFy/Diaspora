<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2>评论列表</h2>
		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 40,
					'per_page'    => 9999,
				) );
			?>
		</ol>

	<?php endif; ?>

	<?php
		comment_form( array(
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
		) );
	?>

</div>
