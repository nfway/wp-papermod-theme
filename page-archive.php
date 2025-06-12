<?php
/*
Template Name: Archives Page
*/
get_header(); ?>

<div class="archive-page">
    <header class="page-header">
        <h1><?php the_title(); ?></h1>
        <div class="archive-controls">
            <button id="sort-archives" data-order="desc"><?php esc_html_e('倒序', 'papermod'); ?></button>
        </div>
    </header>

    <div id="archive-list-container">
    <?php
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC', // Default to descending order
    );
    $all_posts = new WP_Query($args);

    if ($all_posts->have_posts()) :
        $years = array();
        while ($all_posts->have_posts()) : $all_posts->the_post();
            $year = get_the_date('Y');
            $month = get_the_date('F'); // Full month name for grouping
            $month_num = get_the_date('m'); // Month number for sorting months correctly later
            
            // The structure for each post
            $post_html = '<li class="archive-item"><a href="' . get_permalink() . '">' . get_the_title() . '</a><span class="archive-date">' . get_the_date('(n月 j日)') . '</span></li>';
            
            if (!isset($years[$year])) {
                $years[$year] = array();
            }
            if (!isset($years[$year][$month_num])) {
                $years[$year][$month_num] = array(
                    'name' => $month, // Store month name
                    'posts' => array()
                );
            }
            $years[$year][$month_num]['posts'][] = $post_html;

        endwhile;
        wp_reset_postdata();
        
        // Sort years descending
        krsort($years);

        foreach ($years as $year => $months) :
            // Sort months descending within each year
            krsort($months);
    ?>
    <div class="archive-year" data-year="<?php echo esc_attr($year); ?>">
        <h2 class="archive-year-header"><?php echo esc_html($year); ?></h2>
        <?php foreach ($months as $month_data) : ?>
            <div class="archive-month">
                <h3 class="archive-month-header"><?php echo esc_html($month_data['name']); ?></h3>
                <ul class="archive-posts">
                    <?php echo implode('', $month_data['posts']); ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
        endforeach;
    else :
        echo '<p>No posts found.</p>';
    endif;
    ?>
    </div>

</div>

<?php get_footer(); ?>