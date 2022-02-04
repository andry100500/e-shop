<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($pages as $page)
        <url>
            <loc>{{ $domain. \App\Http\Services\LangLinkManager::current($page->url) }}</loc>
            <lastmod>123</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.1</priority>
        </url>
    @endforeach
</urlset>
