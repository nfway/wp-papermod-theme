<?php get_header(); ?>

<header class="page-header">
    <h1>
        <?php
        printf( esc_html__( 'Search Results for: %s', 'papermod' ), '<span>' . get_search_query() . '</span>' );
        ?>
    </h1>
</header>

<div id="searchbox-result-page">
    <?php get_search_form(); ?>
</div>

<div class="post-list">
    <?php if ( have_posts() ) : ?>
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article class="post-entry">
                <header class="entry-header">
                     <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
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
        <div class="no-results">
            <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'papermod' ); ?></p>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>