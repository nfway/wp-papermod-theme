<?php get_header(); ?>

<?php
while ( have_posts() ) :
    the_post();
?>

<article class="post-single">
    <header class="post-header">
        <h1 class="post-title">
            <?php the_title(); ?>
        </h1>
    </header>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="entry-cover">
            <?php the_post_thumbnail('full'); ?>
        </div>
    <?php endif; ?>

    <div class="post-content">
        <?php the_content(); ?>
    </div>

</article>

<?php endwhile; ?>

<?php get_footer(); ?>