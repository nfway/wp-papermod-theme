<?php get_header(); ?>

<?php
while ( have_posts() ) :
    the_post();
?>

<article class="post-single">
    <header class="post-header">
        <?php papermod_breadcrumbs(); ?>
        <h1 class="post-title">
            <?php the_title(); ?>
        </h1>
        <div class="post-meta">
            <?php papermod_posted_on(); ?>
        </div>
    </header>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="entry-cover">
            <?php the_post_thumbnail('full', array('loading' => 'eager')); ?>
        </div>
    <?php endif; ?>

    <div class="post-content">
        <?php the_content(); ?>
    </div>

    <footer class="post-footer">
        <nav class="paginav">
            <?php
            $prev_post = get_previous_post();
            if ($prev_post) :
            ?>
            <a class="prev" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
                <span class="title">« <?php esc_html_e( 'Prev', 'papermod' ); ?></span>
                <br>
                <span><?php echo esc_html(get_the_title($prev_post->ID)); ?></span>
            </a>
            <?php endif; ?>

            <?php
            $next_post = get_next_post();
            if ($next_post) :
            ?>
            <a class="next" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                <span class="title"><?php esc_html_e( 'Next', 'papermod' ); ?> »</span>
                <br>
                <span><?php echo esc_html(get_the_title($next_post->ID)); ?></span>
            </a>
            <?php endif; ?>
        </nav>
    </footer>

    <?php
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;
    ?>
</article>

<?php endwhile; ?>

<?php get_footer(); ?>