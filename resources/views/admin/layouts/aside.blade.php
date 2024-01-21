<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="#">
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
            <li class=" nav-item">
                <a href="#">
                    <i class="feather icon-home"></i>
                    <span class="menu-title">داشبورد</span>
                    <span class="badge badge badge-warning badge-pill float-right mr-2">2</span>
                </a>
                <ul class="menu-content">
                    <li class="{{Route::is('index.index') ? 'active' : ''}}">
                        <a href="{{route('index.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">صفحه اصلی</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.home') ? 'active' : ''}}">
                        <a href="{{route('admin.home')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">پنل ادمین</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header"><span>اطلاعات سایت</span></li>
            <li class=" nav-item">
                <a href="#">
                    <i class="fa fa-product-hunt"></i>
                    <span class="menu-title">محصولات</span>
                </a>
                <ul class="menu-content">
                    <li class="{{Route::is('admin.products.index') ? 'active' : ''}}">
                        <a href="{{route('admin.products.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">لیست محصولات</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.products.create') ? 'active' : ''}}">
                        <a href="{{route('admin.products.create')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">افزودن محصول تکی</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.collections.index') ? 'active' : ''}}">
                        <a href="{{route('admin.collections.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">افزودن پک محصولات</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a href="#">
                    <i class="fa fa-file-text-o"></i>
                    <span class="menu-title">برگه ها</span>
                </a>
                <ul class="menu-content">
                    <li class="{{Route::is('admin.pages.index') ? 'active' : ''}}">
                        <a href="{{route('admin.pages.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">برگه ها</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.pages.create') ? 'active' : ''}}">
                        <a href="{{route('admin.pages.create')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">افزودن برگه</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a href="#">
                    <i class="fa fa-file"></i>
                    <span class="menu-title">مقالات</span>
                </a>
                <ul class="menu-content">
                    <li class="{{Route::is('admin.mags.index') ? 'active' : ''}}">
                        <a href="{{route('admin.mags.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">مقالات</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.mags.create') ? 'active' : ''}}">
                        <a href="{{route('admin.mags.create')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">افزودن مقاله</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="fa fa-tags"></i>
                    <span class="menu-title">تاکسونامی</span>
                </a>
                <ul class="menu-content">
                    <li class="{{Route::is('admin.categories.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.categories.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">دسته بندی ها</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.brands.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.brands.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">برند ها</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.tags.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.tags.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">برچسب ها</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.times.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.times.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">زمان</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.currency.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.currency.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">ارز ها</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.guarantees.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.guarantees.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">گارانتی ها</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.carriers.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.carriers.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">حامل ها</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.discounts.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.discounts.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">کد تخفیف</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="fa fa-hdd-o"></i>
                    <span class="menu-title">ویجت ها</span>
                </a>
                <ul class="menu-content">
                    <li class="{{Route::is('admin.widgets.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.widgets.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">ویجت ها</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.widgets.mobile.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.widgets.mobile.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">ویجت های موبایل</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.widgets.create') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.widgets.create')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">افزودن ویجت</span>
                        </a>
                    </li>
                </ul>
            </li>
            @can('user-list')
            <li class="nav-item">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="menu-title">کاربران</span>
                </a>
                <ul class="menu-content">
                    <li class="{{Route::is('admin.seller.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.seller.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item">قروشندگان</span>
                        </a>
                    </li>
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
            <li class=" nav-item">
                <a href="#">
                    <i class="fa fa-question-circle-o"></i>
                    <span class="menu-title">سئوالات متداول</span>
                </a>
                <ul class="menu-content">
                    <li class="{{Route::is('admin.faqs.index') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.faqs.index')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">سئوالات متداول</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.faqs.create') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.faqs.create')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">افزودن سئوال متداول</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header"><span>تفکیک محصولات</span></li>
            <li class=" nav-item">
                <a href="#">
                    <i class="fa fa-signal"></i>
                    <span class="menu-title">آمارگیری</span>
                </a>
                <ul class="menu-content">
                    <li class="{{Route::is('admin.statistics.today') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.statistics.today')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">آمارگیری امروز</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.statistics.yesterday') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.statistics.yesterday')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">آمارگیری دیروز</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.statistics.weekly') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.statistics.weekly')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">آمارگیری این هفته</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.statistics.monthly') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.statistics.monthly')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">آمارگیری این ماه</span>
                        </a>
                    </li>
                    <li class="{{Route::is('admin.statistics.yearly') ? 'active' : ''}} nav-item">
                        <a href="{{route('admin.statistics.yearly')}}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-title">آمارگیری امسال</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{Route::is('admin.pay.index') ? 'active' : '' }} nav-item">
                <a href="{{route('admin.pay.index')}}">
                    <i class="fa fa-credit-card-alt"></i>
                    <span class="menu-title">سفارشات</span>
                </a>
            </li>
            <li class="{{Route::is('admin.inventory.index') ? 'active' : ''}} nav-item">
                <a href="{{route('admin.inventory.index')}}">
                    <i class="fa fa-window-restore"></i>
                    <span class="menu-title">وضعیت موجودی</span>
                </a>
            </li>
            <li class="{{Route::is('admin.variety.index') ? 'active' : ''}} nav-item">
                <a href="{{route('admin.variety.index')}}">
                    <i class="fa fa-filter"></i>
                    <span class="menu-title">تنوع ها</span>
                </a>
            </li>
            <li class="{{Route::is('admin.change.index') ? 'active' : ''}} nav-item">
                <a href="{{route('admin.change.index')}}">
                    <i class="fa fa-cubes"></i>
                    <span class="menu-title">تغییر قیمت گروهی</span>
                </a>
            </li>
            <li class="{{Route::is('admin.lotteries.index') ? 'active' : ''}} nav-item">
                <a href="{{route('admin.lotteries.index')}}">
                    <i class="fa fa-trophy"></i>
                    <span class="menu-title">قرعه کشی</span>
                </a>
            </li>
            <li class="{{Route::is('admin.wallets.index') ? 'active' : ''}} nav-item">
                <a href="{{route('admin.wallets.index')}}">
                    <i class="fa fa-cc-mastercard"></i>
                    <span class="menu-title">کیف پول</span>
                </a>
            </li>
            <li class="nav-item {{Route::is('admin.comments.index') ? 'active' : ''}}">
                <a href="{{route('admin.comments.index')}}">
                    <i class="fa fa-comments"></i>
                    <span class="menu-title">دیدگاه ها</span>
                    @php $comments = \App\Models\Comment::all(); @endphp
                    @if(count($comments) > 0)
                        <span class="badge badge badge-warning badge-pill float-right mr-2">{{count($comments)}}</span>
                    @endif
                </a>
            </li>
            <li class="{{Route::is('admin.tickets.index') ? 'active' : ''}} nav-item">
                <a href="{{route('admin.tickets.index')}}">
                    <i class="fa fa-ticket"></i>
                    <span class="menu-title">درخواست ها</span>
                    @php $tickets = \App\Models\Ticket::all(); $counselings = \App\Models\Counseling::all(); @endphp
                    @if(count($tickets) > 0 || count($counselings) > 0)
                    <span class="badge badge badge-warning badge-pill float-right mr-2">{{count($tickets)+count($counselings)}}</span>
                    @endif
                </a>
            </li>
            <li class=" navigation-header"><span>عمومی</span></li>
            <li class="{{Route::is('admin.seller.index') ? 'active' : ''}} nav-item">
                <a href="{{route('admin.seller.index')}}">
                    <i class="fa fa-shopping-basket"></i>
                    <span class="menu-title">فروشنده ها</span>
                </a>
            </li>
            <li class="{{Route::is('admin.galleries.index') ? 'active' : ''}} nav-item">
                <a href="{{route('admin.galleries.index')}}">
                    <i class="feather icon-upload"></i>
                    <span class="menu-title">گالری</span>
                </a>
            </li>
            <li class="{{Route::is('admin.roles.index') ? 'active' : ''}} nav-item">
                <a href="{{route('admin.roles.index')}}">
                    <i class="fa fa-user-secret"></i>
                    <span class="menu-title">مقام ها</span>
                </a>
            </li>
            <li class="{{Route::is('admin.settings.index')? 'active' : ''}} nav-item">
                <a href="{{route('admin.settings.index')}}">
                    <i class="feather icon-settings"></i>
                    <span class="menu-item">تنظیمات</span>
                </a>
            </li>
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
