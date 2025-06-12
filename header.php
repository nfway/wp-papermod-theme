<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
    <script>
        // Place this script in the <head> to prevent FOUC (Flash of Unstyled Content)
        (function() {
            const pref = localStorage.getItem("pref-theme");
            if (pref === "dark") {
                document.documentElement.classList.add('dark');
            } else if (pref === "light") {
                document.documentElement.classList.remove('dark');
            } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>

<body <?php body_class(is_front_page() ? 'list' : ''); ?> id="top">

<header class="header">
    <nav class="nav">
        <div class="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" accesskey="h" title="<?php bloginfo( 'name' ); ?> (Alt + H)">
                <?php bloginfo( 'name' ); ?>
            </a>
            <div class="logo-switches">
                <button id="theme-toggle" accesskey="t" title="(Alt + T)" aria-label="Toggle theme">
                    <svg id="moon" xmlns="http://www.w3.org/2000/svg" width="24" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                    <svg id="sun" xmlns="http://www.w3.org/2000/svg" width="24" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                </button>
            </div>
        </div>
        
        <?php
        wp_nav_menu( array(
            'theme_location' => 'primary-menu',
            'container'      => 'ul',
            'menu_id'        => 'menu',
        ) );
        ?>
    </nav>
    <div class="search-icon-container">
        <button id="search-trigger" aria-label="Open Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
        </button>
    </div>
</header>

<div id="search-modal" class="search-modal-hidden">
    <div class="search-modal-content">
        <button id="close-search" aria-label="Close Search">×</button>
        <?php get_search_form(); ?>
    </div>
</div>

<main class="main">