<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($categories as $category)
        <url>
            <loc>{{ $domain. \App\Http\Services\LangLinkManager::current($category->url) }}</loc>
            <lastmod>123</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach
</urlset>
