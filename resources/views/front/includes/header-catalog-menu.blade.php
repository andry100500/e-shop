{{--<div class="main-menu container">--}}
<ul class="main-menu container">

    @foreach($categories as $category)
        <li class="first-level">

            @if(count($category->subCategory) > 0)
                <div class="item">
                    {{ $category->categoryDescription->name }}
                    <i class="fas fa-angle-down caret caret-main-menu"></i>
                </div>

                <div class="sub-categories">
                    <div class="item">
                        <div class="image">
                            <a href="{{ \App\Http\Services\LangLinkManager::current($category->url) }}"><img
                                    src="{{$category->image}}" alt="{{ $category->categoryDescription->name }}"></a>
                        </div>
                        <a href="{{ \App\Http\Services\LangLinkManager::current($category->url) }}"> {{ $category->categoryDescription->name }}</a>
                    </div>
                    @foreach($category->subCategory as $subCategory)

                        <div class="item">
                            <div class="image">
                                <a href="{{ \App\Http\Services\LangLinkManager::current($subCategory->url) }}"> <img
                                        src="{{$subCategory->image}}"
                                        alt="{{ $subCategory->categoryDescription->name }}"></a>
                            </div>
                            <a href="{{ \App\Http\Services\LangLinkManager::current($subCategory->url) }}"> {{ $subCategory->categoryDescription->name }}</a>
                        </div>
                    @endforeach
                </div>
            @else

                <a href="{{ \App\Http\Services\LangLinkManager::current($category->url) }}"> {{ $category->categoryDescription->name }}</a>
                <i class="fas fa-angle-down caret caret-main-menu"></i>
            @endif

        </li>

    @endforeach

</ul>
{{--</div>--}}
