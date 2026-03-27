document.addEventListener('DOMContentLoaded', function () {
    function patchBookStackLinks() {
        document.querySelectorAll('a[href*="' + window.__bookstackHost + '"]').forEach(function (a) {
            a.setAttribute('target', '_blank');
            a.setAttribute('rel', 'noopener noreferrer');
        });
    }

    // Fetch the BookStack base URL from a meta tag we'll inject
    const meta = document.querySelector('meta[name="bookstack-host"]');
    if (!meta) return;

    window.__bookstackHost = meta.getAttribute('content');

    // Observe DOM changes for dynamically loaded search results
    const observer = new MutationObserver(patchBookStackLinks);
    observer.observe(document.body, { childList: true, subtree: true });

    // Also run immediately
    patchBookStackLinks();
});
