<nav id="topnav" class="defaultscroll is-sticky">
    <div class="container relative">
        <!-- Logo container-->
        <a class="logo" href="{{route('home.index',['locale'=>app()->getLocale()])}}">
            <img src="/images/logo-dark.png" class="inline-block dark:hidden" alt="">
            <img src="/images/logo-light.png" class="hidden dark:inline-block" alt="">
        </a>
        <!-- End Logo container-->

        <!-- Start Mobile Toggle -->
        <div class="menu-extras">
            <div class="menu-item">
                <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </div>
        </div>
        <!-- End Mobile Toggle -->

        <!--Login button Start-->
        <ul class="buy-button list-none mb-0">

{{--            @if(app()->getLocale()=='en')--}}
{{--                <li class="inline mb-0">--}}
{{--                    <a href="{{route('change-locale',['lang'=>'fa'])}}" class="btn btn-icon bg-green-600 hover:bg-green-700 border-green-600 dark:border-green-600 text-white rounded-full">fa</a>--}}
{{--                </li>--}}
{{--            @else--}}
{{--                <li class="inline mb-0">--}}
{{--                    <a href="{{route('change-locale',['lang'=>'en'])}}" class="btn btn-icon bg-green-600 hover:bg-green-700 border-green-600 dark:border-green-600 text-white rounded-full">en</a>--}}
{{--                </li>--}}
{{--            @endif--}}

            @auth('web')
                <li class="inline mb-0">
                    <a href="{{route('admin.index')}}" class="btn btn-icon bg-green-600 hover:bg-green-700 border-green-600 dark:border-green-600 text-white rounded-full"><i data-feather="user" class="h-4 w-4 stroke-[3]"></i></a>
                </li>

            @else
                <li class="inline mb-0">
                    <a href="{{route('auth.login-view')}}" class="btn btn-icon bg-green-600 hover:bg-green-700 border-green-600 dark:border-green-600 text-white rounded-full"><i data-feather="user" class="h-4 w-4 stroke-[3]"></i></a>
                </li>
                <li class="sm:inline ps-1 mb-0 hidden">
                    <a href="{{route('auth.register-view')}}" class="btn bg-green-600 hover:bg-green-700 border-green-600 dark:border-green-600 text-white rounded-full">{{__('website/navbar.register')}}</a>
                </li>
            @endauth
        </ul>
        <!--Login button End-->

        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu justify-end">
                <li><a href="{{route('estate.index')}}" class="sub-menu-item">{{__('website/navbar.estate')}}</a></li>
                <li><a href="{{route('service.index')}}" class="sub-menu-item">{{__('website/navbar.service')}}</a></li>
                <li><a href="{{route('contact.index')}}" class="sub-menu-item">{{__('website/navbar.contact')}}</a></li>
                <li class="has-submenu parent-menu-item">
                    <a href="javascript:void(0)">{{__('website/navbar.pages')}}</a><span class="menu-arrow"></span>
                    <ul class="submenu">
                        <li><a href="{{route('about-us')}}" class="sub-menu-item">{{__('website/navbar.about_us')}}</a></li>
                        <li><a href="{{route('blog.index')}}" class="sub-menu-item">{{__('website/navbar.blog')}}</a></li>
                        <li><a href="{{route('faq')}}" class="sub-menu-item">{{__('website/navbar.faq')}}</a></li>
{{--                        <li><a href="{{route('policy')}}" class="sub-menu-item">{{__('website/navbar.policy')}} <span class="bg-yellow-500 inline-block text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5 ms-1">New</span></a></li>--}}
                    </ul>
                </li>
            </ul><!--end navigation menu-->
        </div><!--end navigation-->
    </div><!--end container-->
</nav>