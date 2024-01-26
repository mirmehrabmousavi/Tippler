<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="/">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">{{env('APP_NAME')}}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                    <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{Route::is('admin.dashboard') ? 'active' : ''}} nav-item">
                <a href="{{route('admin.dashboard')}}">
                    <i class="feather icon-home"></i>
                    <span class="menu-title">داشبورد</span>
                </a>
            </li>
            <li class=" navigation-header"><span>اطلاعات سایت</span></li>
            @can('page-list')
            <li class=" nav-item">
                <a href="#">
                    <i class="fa fa-file-text-o"></i>
                    <span class="menu-title">برگه ها</span>
                </a>
                <ul class="menu-content">
                    @can('page-list')
                    <li class="{{Route::is('admin.pages.index') ? 'active' : ''}}">
                        <a href="{{route('admin.pages.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">برگه ها</span>
                        </a>
                    </li>
                    @endcan
                    @can('page-create')
                    <li class="{{Route::is('admin.pages.create') ? 'active' : ''}}">
                        <a href="{{route('admin.pages.create')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">افزودن برگه</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('mag-list')
            <li class=" nav-item">
                <a href="#">
                    <i class="fa fa-file"></i>
                    <span class="menu-title">مقالات</span>
                </a>
                <ul class="menu-content">
                    @can('mag-list')
                    <li class="{{Route::is('admin.mags.index') ? 'active' : ''}}">
                        <a href="{{route('admin.mags.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">مقالات</span>
                        </a>
                    </li>
                    @endcan
                    @can('mag-create')
                    <li class="{{Route::is('admin.mags.create') ? 'active' : ''}}">
                        <a href="{{route('admin.mags.create')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">افزودن مقاله</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @canany(['category-list', 'tag-list'])
            <li class="nav-item">
                <a href="#">
                    <i class="fa fa-tags"></i>
                    <span class="menu-title">تاکسونامی</span>
                </a>
                <ul class="menu-content">
                    @can('category-list')
                    <li class="{{Route::is('admin.categories.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.categories.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">دسته بندی ها</span>
                        </a>
                    </li>
                    @endcan
                    @can('tag-list')
                    <li class="{{Route::is('admin.tags.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.tags.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">برچسب ها</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('widget-list')
            <li class="nav-item">
                <a href="#">
                    <i class="fa fa-hdd-o"></i>
                    <span class="menu-title">ویجت ها</span>
                </a>
                <ul class="menu-content">
                    @can('widget-list')
                    <li class="{{Route::is('admin.widgets.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.widgets.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">ویجت ها</span>
                        </a>
                    </li>
                    @endcan
                    @can('widget-list')
                    <li class="{{Route::is('admin.widgets.mobile.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.widgets.mobile.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">ویجت های موبایل</span>
                        </a>
                    </li>
                    @endcan
                    @can('widget-create')
                    <li class="{{Route::is('admin.widgets.create') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.widgets.create')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">افزودن ویجت</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('user-list')
            <li class="nav-item">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="menu-title">کاربران</span>
                </a>
                <ul class="menu-content">
                    @can('user-list')
                    <li class="{{Route::is('admin.users.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.users.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">همه کاربران</span>
                        </a>
                    </li>
                    @endcan
                    @can('user-create')
                    <li class="{{Route::is('admin.users.create') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.users.create')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">افزودن کابر</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('faq-list')
            <li class=" nav-item">
                <a href="#">
                    <i class="fa fa-question-circle-o"></i>
                    <span class="menu-title">سئوالات متداول</span>
                </a>
                <ul class="menu-content">
                    @can('faq-list')
                    <li class="{{Route::is('admin.faqs.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.faqs.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">سئوالات متداول</span>
                        </a>
                    </li>
                    @endcan
                    @can('faq-create')
                    <li class="{{Route::is('admin.faqs.create') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.faqs.create')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">افزودن سئوال متداول</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            <li class=" navigation-header"><span>عمومی</span></li>
            @can('gallery-list')
            <li class="{{Route::is('admin.galleries.index') ? 'active' : ''}} nav-item">
                <a href="{{route('admin.galleries.index')}}">
                    <i class="feather icon-upload"></i>
                    <span class="menu-title">گالری</span>
                </a>
            </li>
            @endcan
            @can('role-list')
            <li class="{{Route::is('admin.roles.index') ? 'active' : ''}} nav-item">
                <a href="{{route('admin.roles.index')}}">
                    <i class="fa fa-user-secret"></i>
                    <span class="menu-title">مقام ها</span>
                </a>
            </li>
            @endcan
            @can('settings-list')
            <li class="{{Route::is('admin.settings.index')? 'active' : ''}} nav-item">
                <a href="{{route('admin.settings.index')}}">
                    <i class="feather icon-settings"></i>
                    <span class="menu-item">تنظیمات</span>
                </a>
            </li>
            @endcan
            <li class="{{Route::is('logout') ? 'active' : ''}} nav-item">
                <a href="{{route('logout')}}" class="text-danger" onclick="event.preventDefault(); document.getElementById('logout').submit();">
                    <i class="text-danger feather icon-power"></i>
                    <span class="menu-title text-danger">خروج</span>
                </a>
                <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
