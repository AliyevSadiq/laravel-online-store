<div class="col-lg-3">
    <div class="sidebar-wrapper sidebar-wrapper-mrg-right">

        <div class="sidebar-widget shop-sidebar-border mb-35 pt-40">
            <h4 class="sidebar-widget-title">Categories </h4>
            <div class="shop-catigory">
                <ul>
                    @foreach($categories as $category)
                        <li><a href="{{route('home.category',['id'=>$category->id])}}">{{$category->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="sidebar-widget shop-sidebar-border mb-40 pt-40">
            <h4 class="sidebar-widget-title">Price Filter </h4>
            <div class="price-filter">
                <span>Range:  $400.00 - 1.200.00 </span>
                <div id="slider-range"></div>
                <form class="price-slider-amount" method="get" action="{{route('home.product.search')}}">
                    <div class="label-input">
                        <input type="text" id="amount-min" name="min" placeholder="Add Your Price" />
                        <input type="text" id="amount-max" name="max" placeholder="Add Your Price" />
                    </div>
                    <button type="submit">Filter</button>
                </form>
            </div>
        </div>


        <div class="sidebar-widget shop-sidebar-border pt-40">
            <h4 class="sidebar-widget-title">Popular Tags</h4>
            <div class="tag-wrap sidebar-widget-tag">
                @foreach($tags as $tag)
                <a href="{{route('home.tag',['id'=>$tag->id])}}">{{$tag->title}}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
