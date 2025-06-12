document.addEventListener("DOMContentLoaded", function () {
    // Theme toggle
    const themeToggle = document.getElementById('theme-toggle');
    const doc = document.documentElement;

    function setTheme(isDark) {
        if (isDark) {
            doc.classList.add('dark');
            localStorage.setItem("pref-theme", 'dark');
        } else {
            doc.classList.remove('dark');
            localStorage.setItem("pref-theme", 'light');
        }
    }

    if (themeToggle) {
        themeToggle.addEventListener("click", () => {
            setTheme(!doc.classList.contains('dark'));
        });
    }

    // Scroll to top
    const topLink = document.getElementById("top-link");
    if (topLink) {
        window.onscroll = function () {
            if (document.body.scrollTop > 800 || document.documentElement.scrollTop > 800) {
                topLink.style.visibility = "visible";
                topLink.style.opacity = "1";
            } else {
                topLink.style.visibility = "hidden";
                topLink.style.opacity = "0";
            }
        };
        topLink.addEventListener("click", function(e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
    
    // Search Modal
    const searchTrigger = document.getElementById('search-trigger');
    const searchModal = document.getElementById('search-modal');
    const searchInput = document.querySelector('#search-modal .search-field');
    const closeSearch = document.getElementById('close-search');

    if (searchTrigger && searchModal && closeSearch) {
        searchTrigger.addEventListener('click', () => {
            searchModal.classList.remove('search-modal-hidden');
            searchModal.classList.add('search-modal-visible');
            setTimeout(() => {
                 searchInput.focus();
            }, 100);
        });

        const hideSearch = () => {
            searchModal.classList.add('search-modal-hidden');
            searchModal.classList.remove('search-modal-visible');
        };

        closeSearch.addEventListener('click', hideSearch);
        searchModal.addEventListener('click', (e) => {
            if (e.target === searchModal) {
                hideSearch();
            }
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === "Escape" && searchModal.classList.contains('search-modal-visible')) {
                hideSearch();
            }
        });
    }

    // Code copy
    document.querySelectorAll('pre > code').forEach((codeblock) => {
        const container = codeblock.closest('.highlight, pre');
        if (!container) return;

        const copybutton = document.createElement('button');
        copybutton.classList.add('copy-code');
        copybutton.innerHTML = 'copy';

        copybutton.addEventListener('click', (cb) => {
            navigator.clipboard.writeText(codeblock.textContent).then(() => {
                copybutton.innerHTML = 'copied!';
                setTimeout(() => {
                    copybutton.innerHTML = 'copy';
                }, 2000);
            });
        });

        container.style.position = 'relative'; 
        container.appendChild(copybutton);
    });

    // Archive page sorting
    const sortButton = document.getElementById('sort-archives');
    const archiveContainer = document.getElementById('archive-list-container');

    if (sortButton && archiveContainer) {
        sortButton.addEventListener('click', () => {
            const currentOrder = sortButton.getAttribute('data-order');
            const newOrder = currentOrder === 'desc' ? 'asc' : 'desc';
            
            sortButton.setAttribute('data-order', newOrder);
            sortButton.textContent = newOrder === 'desc' ? '倒序' : '正序';

            const yearBlocks = Array.from(archiveContainer.querySelectorAll('.archive-year'));

            yearBlocks.sort((a, b) => {
                const yearA = parseInt(a.dataset.year, 10);
                const yearB = parseInt(b.dataset.year, 10);
                if (newOrder === 'desc') {
                    return yearB - yearA; // Newest first
                } else {
                    return yearA - yearB; // Oldest first
                }
            });

            // Re-append sorted blocks
            yearBlocks.forEach(block => archiveContainer.appendChild(block));
        });
    }
});