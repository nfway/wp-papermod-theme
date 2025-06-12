<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

    <header class="page-header">
        <?php
            the_archive_title( '<h1>', '</h1>' );
            the_archive_description( '<div class="post-description">', '</div>' );
        ?>
    </header>

    <?php
    $post_counter = 0;
    while ( have_posts() ) :
        the_post();
        $post_counter++;
        $post_class = ($post_counter == 1 && !is_paged()) ? 'first-entry' : 'post-entry';
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
        
        <?php if ( has_post_thumbnail() && ($post_class == 'post-entry' || is_paged() ) ) : ?>
        <div class="entry-cover">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large'); ?>
            </a>
        </div>
        <?php endif; ?>

        <header class="entry-header">
            <h2 class="entry-hint-parent">
                <?php the_title(); ?>
            </h2>
        </header>

        <div class="entry-content">
            <?php the_excerpt(); ?>
        </div>
        
        <footer class="entry-footer">
            <?php papermod_posted_on(); ?>
        </footer>
        
        <a class="entry-link" aria-label="post link to <?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"></a>
    </article>

    <?php endwhile; ?>

    <?php the_posts_pagination( array(
        'prev_text' => '« ' . esc_html__( 'Prev', 'papermod' ),
        'next_text' => esc_html__( 'Next', 'papermod' ) . ' »',
    ) ); ?>

<?php else : ?>

    <section class="no-results not-found">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'papermod' ); ?></h1>
		</header>
		<div class="page-content">
			<p><?php esc_html_e( 'It seems we can’t find what you’re looking for. Perhaps searching can help.', 'papermod' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</section>

<?php endif; ?>

<?php get_footer(); ?>