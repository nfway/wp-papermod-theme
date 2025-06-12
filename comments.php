<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				printf( esc_html_x( 'One Reply to “%s”', 'comments title', 'papermod' ), get_the_title() );
			} else {
				printf(
                    esc_html(
					    _nx(
						    '%1$s Reply to “%2$s”',
						    '%1$s Replies to “%2$s”',
						    $comments_number,
						    'comments title',
						    'papermod'
					    )
                    ),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments(
					array(
						'style'      => 'ol',
						'short_ping' => true,
                        'avatar_size' => 50,
					)
				);
			?>
		</ol>

		<?php the_comments_pagination(); ?>

	<?php endif; ?>

	<?php
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'papermod' ); ?></p>
	<?php endif; ?>

	<?php
		comment_form(
			array(
				'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
				'title_reply_after'  => '</h2>',
			)
		);
	?>

</div><!-- .comments-area -->