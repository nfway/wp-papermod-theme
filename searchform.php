<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'papermod' ); ?></span>
        <input type="search" id="searchInput" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'papermod' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit" style="display: none;"></button>
</form>