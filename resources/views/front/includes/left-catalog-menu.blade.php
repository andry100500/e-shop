{{--<div class="main-menu container">--}}
    <ul class="main-menu container">

        @foreach($categories as $category)
            <li class="first-level">

                @if(count($category->subCategory) > 0)
                    {{ $category->categoryDescription->name }}
                    <i class="fas fa-angle-down caret caret-main-menu"></i>

                    <div class="sub-categories hidden">
                        <div class="item">
                            <div class="image">Image here</div>
                            <a href="{{ \App\Http\Services\LangLinkManager::current($category->url) }}"> {{ $category->categoryDescription->name }}</a>
                        </div>
                        @foreach($category->subCategory as $subCategory)

                            <div class="item">
                                <div class="image">Image here</div>
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
