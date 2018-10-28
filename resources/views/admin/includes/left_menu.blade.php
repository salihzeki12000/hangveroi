<!-- start:Left Menu -->
<div id="left-menu">
    <div class="sub-left-menu scroll">
        <ul class="nav nav-list">
            <li><div class="left-bg"></div></li>
            <li class="time">
                <h1 class="animated fadeInLeft">21:00</h1>
                <p class="animated fadeInRight">Sat,October 1st 2029</p>
            </li>
            <li class="ripple">
                <a class="tree-toggle nav-header"><span class="fa-cubes fa"></span>Sales 
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="{{ URL::to(Request::segment(1).'/sales') }}">Sales</a></li>
                </ul>
            </li>
            <li class="ripple">
                <a class="tree-toggle nav-header"><span class="fa-cubes fa"></span>{{ trans('order.orders') }} 
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="{{ URL::to(Request::segment(1).'/orders') }}">{{ trans('order.orders') }}</a></li>
                </ul>
            </li>
            <li class="ripple">
                <a class="tree-toggle nav-header"><span class="fa-cubes fa"></span>{{ trans('product.product') }} 
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="{{ URL::to(Request::segment(1).'/product') }}">{{ trans('product.product') }}</a></li>
                    <li><a href="{{ URL::to(Request::segment(1).'/product-promotion') }}">{{ trans('product.product_promotion') }}</a></li>
                    <li><a href="{{ URL::to(Request::segment(1).'/product-review') }}">{{ trans('product.product_review') }}</a></li>
                    <li><a href="{{ URL::to(Request::segment(1).'/product-type') }}">{{ trans('product.producttype') }}</a></li>
                    <li><a href="{{ URL::to(Request::segment(1).'/product-manufacturer') }}">{{ trans('product.productmanufacturer') }}</a></li>
                </ul>
            </li>
            <li class="ripple">
                <a class="tree-toggle nav-header">
                    <span class="fa-pencil-square fa"></span>News 
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="{{ URL::to(Request::segment(1).'/news') }}">News</a></li>
                    <li><a href="{{ URL::to(Request::segment(1).'/category') }}">Category</a></li>
                </ul>
            </li>
            <li class="ripple">
                <a class="tree-toggle nav-header">
                    <span class="fa fa-youtube-square"></span>Video
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="{{ URL::to(Request::segment(1).'/video') }}">Video</a></li>
                </ul>
            </li>
            <li class="ripple">
                <a class="tree-toggle nav-header">
                    <span class="fa fa-file-code-o"></span>Pages
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="{{ URL::to(Request::segment(1).'/page') }}">Pages</a></li>
                </ul>
            </li>
            <li class="ripple">
                <a class="tree-toggle nav-header"><span class="fa-cubes fa"></span>Settings 
                    <span class="fa-angle-right fa right-arrow text-right"></span>
                </a>
                <ul class="nav nav-list tree">
                    <li><a href="{{ URL::to(Request::segment(1).'/setting/banner') }}">Banner</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- end: Left Menu -->
<!-- start: Mobile -->
<div id="mimin-mobile" class="reverse">
    <div class="mimin-mobile-menu-list">
        <div class="col-md-12 sub-mimin-mobile-menu-list animated fadeInLeft">
            <ul class="nav nav-list">
                <li class="ripple">
                    <a class="tree-toggle nav-header">
                        <span class="fa-diamond fa"></span>{{ trans('order.orders') }}
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="{{ URL::to(Request::segment(1).'/orders') }}">{{ trans('order.orders') }}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>       
</div>
<button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger">
    <span class="fa fa-bars"></span>
</button>
<!-- end: Mobile -->