<div class="product">
    <a href="{{ \App\Http\Services\LangLinkManager::current($post->url) }}"
       class="image-product-category">
        <img src="{{ $post->image }}" alt="{{ $post->postsDescription->name }}">
    </a>

    <p class="name-product-category">
        <a href="{{ \App\Http\Services\LangLinkManager::current($post->url) }}">{{ $post->postsDescription->name }}</a>
    </p>

    <p>{!! $post->postsDescription->preview !!}</p>

</div>
