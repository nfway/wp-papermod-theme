<?php
/*
Template Name: Tags Page
*/
get_header(); ?>

<div class="tags-page">
    <header class="page-header">
        <h1><?php the_title(); ?></h1>
    </header>

    <div class="terms-tags">
        <?php
        $tags = get_tags(array(
            'hide_empty' => true,
        ));

        if ($tags) {
            // Find min and max counts
            $counts = wp_list_pluck($tags, 'count');
            $min_count = min($counts);
            $max_count = max($counts);
            
            // Define font size range
            $min_font_size = 14; // in px
            $max_font_size = 32; // in px

            $font_range = $max_font_size - $min_font_size;
            $count_range = $max_count - $min_count;
            
            // Avoid division by zero if all tags have the same count
            if ( $count_range == 0 ) {
                $count_range = 1;
            }

            echo '<ul>';
            foreach ($tags as $tag) {
                // Calculate font size
                $font_size = $min_font_size + ( ($tag->count - $min_count) * $font_range / $count_range );
                
                $tag_link = get_tag_link($tag->term_id);
                
                echo '<li>';
                echo '<a href="' . esc_url($tag_link) . '" style="font-size: ' . esc_attr($font_size) . 'px;">';
                echo esc_html($tag->name) . ' (' . esc_html($tag->count) . ')';
                echo '</a>';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>' . esc_html__('No tags found.', 'papermod') . '</p>';
        }
        ?>
    </div>
</div>

<?php get_footer(); ?>