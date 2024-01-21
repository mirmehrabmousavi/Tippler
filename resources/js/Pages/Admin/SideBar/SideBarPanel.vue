<template>
    <div class="allSideBar">
        <div class="logoHeaderPanel">
            <a href="/">
                <img :src="$page.logo">
            </a>
        </div>
        <VuePerfectScrollbar class="scroll-area">
            <div class="allSideBarItem">
                <div class="allSideBarIconsText">
                    <div class="active" v-if="index == 0" @click="btnIndex(0)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#home'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">داشبورد</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 0" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(0)" v-else>
                        <i>
                            <svg-icon :icon="'#home'"></svg-icon>
                        </i>
                        داشبورد
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 0" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 0">
                        <li>
                            <inertia-link href="/">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                خانه
                            </inertia-link>
                        </li>
                        <li v-if="dashboard == 1">
                            <inertia-link href="/admin">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                داشبورد
                            </inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="allSideBarIconsText">
                    <div class="active" v-if="index == 1" @click="btnIndex(1)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#gallery'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">رسانه</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 1" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(1)" v-else>
                        <i>
                            <svg-icon :icon="'#gallery'"></svg-icon>
                        </i>
                        رسانه
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 1" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 1">
                        <li>
                            <inertia-link href="/admin/gallery">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                همه رسانه ها
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link href="/admin/gallery">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                افزودن رسانه
                            </inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="allSideBarIconsText">
                    <div class="active" v-if="index == 2" @click="btnIndex(2)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#setting2'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">تنظیمات</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 2" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(2)" v-else>
                        <i>
                            <svg-icon :icon="'#setting2'"></svg-icon>
                        </i>
                        تنظیمات
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 2" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 2">
                        <li>
                            <inertia-link href="/admin/setting/setting-manage">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                تنظیمات سایت
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link href="/admin/setting/setting-comment">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                تنظیمات دیدگاه
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link href="/admin/setting/seo">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                تنظیمات سئو
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link href="/admin/setting/setting-category">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                تنظیمات دسته بندی
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link href="/admin/setting/setting-design">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                تنظیمات قالب سایت
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link href="/admin/setting/setting-pay">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                تنظیمات درگاه
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link href="/admin/setting/setting-popup">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                تنظیمات پاپ آپ
                            </inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="allSideBarIconsText">
                    <div class="active" v-if="index == 3" @click="btnIndex(3)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#customer'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">کاربران و مقام ها</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 3" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(3)" v-else>
                        <i>
                            <svg-icon :icon="'#customer'"></svg-icon>
                        </i>
                        کاربران و مقام ها
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 3" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 3">
                        <li v-if="user == 1">
                            <inertia-link href="/admin/user">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                همه کاربران
                            </inertia-link>
                        </li>
                        <li v-if="employees == 1">
                            <inertia-link href="/admin/user/role">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                همه کارمندان
                            </inertia-link>
                        </li>
                        <li v-if="role == 1">
                            <inertia-link href="/admin/role">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                همه مقام ها
                            </inertia-link>
                        </li>
                        <li v-if="view == 1">
                            <inertia-link href="/admin/view">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                همه بازدید ها
                            </inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="allSideBarIconsText">
                    <div class="active" v-if="index == 4" @click="btnIndex(4)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#box'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">تاکسونامی</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 4" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(4)" v-else>
                        <i>
                            <svg-icon :icon="'#box'"></svg-icon>
                        </i>
                        تاکسونامی
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 4" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 4">
                        <li v-if="discount == 1">
                            <inertia-link href="/admin/discount">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                کد تخفیف
                            </inertia-link>
                        </li>
                        <li v-if="links == 1">
                            <inertia-link href="/admin/link">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                لینک ها
                            </inertia-link>
                        </li>
                        <li v-if="cat == 1">
                            <inertia-link href="/admin/category">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                دسته بندی ها
                            </inertia-link>
                        </li>
                        <li v-if="tag == 1">
                            <inertia-link href="/admin/tag">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                برچسب ها
                            </inertia-link>
                        </li>
                        <li v-if="brand == 1">
                            <inertia-link href="/admin/brand">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                برند ها
                            </inertia-link>
                        </li>
                        <li v-if="country == 1">
                            <inertia-link href="/admin/country">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                کشور ها
                            </inertia-link>
                        </li>
                        <li v-if="guarantee == 1">
                            <inertia-link href="/admin/guarantee">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                گارانتی ها
                            </inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="allSideBarIconsText">
                    <div class="active" v-if="index == 5" @click="btnIndex(5)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#comment'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">برگه</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 5" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(5)" v-else>
                        <i>
                            <svg-icon :icon="'#comment'"></svg-icon>
                        </i>
                        برگه
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 5" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 5">
                        <li v-if="page == 1">
                            <inertia-link href="/admin/page">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                برگه ها
                            </inertia-link>
                        </li>
                        <li v-if="ask == 1">
                            <inertia-link href="/admin/ask">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                سوالات متداول
                            </inertia-link>
                        </li>
                        <li v-if="ticket == 1">
                            <inertia-link href="/admin/ticket">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                درخواست ها
                            </inertia-link>
                        </li>
                        <li v-if="comment == 1">
                            <inertia-link href="/admin/comment">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                دیدگاه ها
                            </inertia-link>
                        </li>
                        <li v-if="comment == 1">
                            <inertia-link href="/admin/question">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                پرسش و پاسخ
                            </inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="allSideBarIconsText" v-if="post|| inventory">
                    <div class="active" v-if="index == 6" @click="btnIndex(6)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#post'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">محصولات</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 6" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(6)" v-else>
                        <i>
                            <svg-icon :icon="'#post'"></svg-icon>
                        </i>
                        محصولات
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 6" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 6">
                        <li v-if="post == 1">
                            <inertia-link href="/admin/post">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                همه محصول ها
                            </inertia-link>
                        </li>
                        <li v-if="post == 1">
                            <inertia-link href="/admin/post/create">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                افزودن محصول
                            </inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="allSideBarIconsText" v-if="pay == 1 || inventory == 1">
                    <div class="active" v-if="index == 7" @click="btnIndex(7)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#bill'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">خرید</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 7" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(7)" v-else>
                        <i>
                            <svg-icon :icon="'#bill'"></svg-icon>
                        </i>
                        خرید
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 7" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 7">
                        <li v-if="pay">
                            <inertia-link href="/admin/pay">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                همه پرداختی ها
                            </inertia-link>
                        </li>
                        <li v-if="pay">
                            <inertia-link href="/admin/pay/chart">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                آمار پرداختی ها
                            </inertia-link>
                        </li>
                        <li v-if="inventory">
                            <inertia-link href="/admin/inventory">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                انبار محصولات
                            </inertia-link>
                        </li>
                        <li v-if="pay == 1">
                            <inertia-link href="/admin/pay/create">ایجاد سفارش دستی</inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="allSideBarIconsText" v-if="notification == 1">
                    <div class="active" v-if="index == 8" @click="btnIndex(8)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#notification'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">اطلاع رسانی</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 8" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(8)" v-else>
                        <i>
                            <svg-icon :icon="'#notification'"></svg-icon>
                        </i>
                        اطلاع رسانی
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 8" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 8">
                        <li>
                            <inertia-link href="/admin/notification/sms">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                ارسال پیامک
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link href="/admin/notification/email">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                ارسال ایمیل
                            </inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="allSideBarIconsText" v-if="robot == 1">
                    <div class="active" v-if="index == 9" @click="btnIndex(9)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#robot'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">رباط تلگرامی شما</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 9" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(9)" v-else>
                        <i>
                            <svg-icon :icon="'#robot'"></svg-icon>
                        </i>
                        رباط تلگرامی شما
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 9" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 9">
                        <li>
                            <inertia-link href="/admin/robot">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                رباط ها
                            </inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="allSideBarIconsText" v-if="news == 1">
                    <div class="active" v-if="index == 10" @click="btnIndex(10)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#news'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">خبر و بلاگ ها</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 10" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(10)" v-else>
                        <i>
                            <svg-icon :icon="'#news'"></svg-icon>
                        </i>
                        خبر و بلاگ ها
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 10" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 10">
                        <li>
                            <inertia-link href="/admin/news">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                همه خبر ها
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link href="/admin/news/create">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                افزودن خبر
                            </inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="allSideBarIconsText" v-if="excel == 1">
                    <div class="active" v-if="index == 11" @click="btnIndex(11)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#excel'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">اکسل</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 11" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(11)" v-else>
                        <i>
                            <svg-icon :icon="'#excel'"></svg-icon>
                        </i>
                        اکسل
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 11" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 11">
                        <li>
                            <inertia-link href="/admin/excel">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                خروجی اکسل
                            </inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="allSideBarIconsText">
                    <div class="active" v-if="index == 12" @click="btnIndex(12)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#event'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">رویداد ها</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 12" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(12)" v-else>
                        <i>
                            <svg-icon :icon="'#event'"></svg-icon>
                        </i>
                        رویداد ها
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 12" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 12">
                        <li v-if="event == 1">
                            <inertia-link href="/admin/event">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                رویداد ها
                            </inertia-link>
                        </li>
                        <li v-if="feedback == 1">
                            <inertia-link href="/admin/report/feedback">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                بازخورد ها
                            </inertia-link>
                        </li>
                        <li v-if="notification2 == 1">
                            <inertia-link href="/admin/report/notification">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                اطلاع رسانی از شگفتانه
                            </inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="allSideBarIconsText">
                    <div class="active" v-if="index == 13" @click="btnIndex(13)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#seller'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">فروشندگان</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 13" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(13)" v-else>
                        <i>
                            <svg-icon :icon="'#seller'"></svg-icon>
                        </i>
                        فروشندگان
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 13" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 13">
                        <li v-if="seller == 1">
                            <inertia-link href="/admin/seller">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                فروشندگان
                            </inertia-link>
                        </li>
                        <li v-if="document == 1">
                            <inertia-link href="/admin/document">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                مدارک فروشندگان
                            </inertia-link>
                        </li>
                        <li v-if="checkout == 1">
                            <inertia-link href="/admin/checkout">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                تسویه حساب ها
                            </inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="allSideBarIconsText">
                    <div class="active" v-if="index == 14" @click="btnIndex(14)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#car'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">حامل</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 14" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(14)" v-else>
                        <i>
                            <svg-icon :icon="'#car'"></svg-icon>
                        </i>
                        حامل
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 14" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 14">
                        <li v-if="carrier == 1">
                            <inertia-link href="/admin/carrier">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                حامل
                            </inertia-link>
                        </li>
                        <li v-if="time == 1">
                            <inertia-link href="/admin/time">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                زمان
                            </inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="allSideBarIconsText">
                    <div class="active" v-if="index == 15" @click="btnIndex(15)">
                        <span class="shape1"></span>
                        <span class="shape2"></span>
                        <i>
                            <svg-icon :icon="'#graph'"></svg-icon>
                        </i>
                        <span class="sidemenu-label">تنوع ها</span>
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 15" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </div>
                    <h4 @click="btnIndex(15)" v-else>
                        <i>
                            <svg-icon :icon="'#graph'"></svg-icon>
                        </i>
                        تنوع ها
                        <i class="arrow">
                            <svg-icon class="down" v-if="index2 == 15" :icon="'#left'"></svg-icon>
                            <svg-icon v-else :icon="'#left'"></svg-icon>
                        </i>
                    </h4>
                    <ul v-if="index2 == 15">
                        <li v-if="variety == 1">
                            <inertia-link href="/admin/variety">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                همه تنوع ها
                            </inertia-link>
                        </li>
                        <li v-if="post == 1">
                            <inertia-link href="/admin/post">
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                                همه محصول ها
                            </inertia-link>
                        </li>
                    </ul>
                </div>
            </div>
        </VuePerfectScrollbar>
    </div>
</template>

<script>
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import SvgIcon from "../../Svg/SvgIcon";
    export default {
        name: "SideBarPanel",
        components:{
            SvgIcon,
            VuePerfectScrollbar
        },
        data() {
            return {
                index: 0,
                index2: 0,
                i: 0,
                allows: [],
                ticket: 0,
                user: 0,
                role: 0,
                cat: 0,
                tag: 0,
                page: 0,
                time: 0,
                setting: 0,
                gallery: 0,
                comment: 0,
                country: 0,
                guarantee: 0,
                links: 0,
                post: 0,
                carrier:0,
                news: 0,
                brand: 0,
                pay: 0,
                dashboard: 0,
                notification: 0,
                robot: 0,
                view: 0,
                event: 0,
                excel: 0,
                feedback: 0,
                notification2: 0,
                seller: 0,
                checkout: 0,
                document: 0,
                variety: 0,
                employees: 0,
                inventory: 0,
                ask: 0,
            }
        },
        methods:{
            btnIndex(num){
                if(this.index2 == num){
                    this.index2 = -1;
                }else{
                    this.index2 = num;
                }
            },
            sidebar2(){
                if (this.$page.allow.length){
                    this.allows = this.$page.allow;
                }
                if (this.$page.userData.admin == 1){
                    this.allows = [];
                    this.allows.push({name : 'admin'});
                }
                this.getAllow();
            },
            getAllow(){
                for ( this.i ; this.i <  this.allows.length; this.i++) {
                    if (this.allows[this.i].name == 'خروجی اکسل' || this.allows[this.i].name == 'admin'){
                        this.excel = 1;
                    }
                    if (this.allows[this.i].name == 'افزودن کد تخفیف' || this.allows[this.i].name == 'admin'){
                        this.discount = 1;
                    }
                    if (this.allows[this.i].name == 'افزودن لینک' || this.allows[this.i].name == 'admin'){
                        this.links = 1;
                    }
                    if (this.allows[this.i].name == 'سوالات متداول' || this.allows[this.i].name == 'admin'){
                        this.ask = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش مدارک' || this.allows[this.i].name == 'admin'){
                        this.document = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش تسویه حساب ها' || this.allows[this.i].name == 'admin'){
                        this.checkout = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش فروشنده' || this.allows[this.i].name == 'admin'){
                        this.seller = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش کارمندان' || this.allows[this.i].name == 'admin'){
                        this.employees = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش انبارداری' || this.allows[this.i].name == 'admin'){
                        this.inventory = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش بازخورد' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف بازخورد'){
                        this.feedback = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش اطلاع پست' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف اطلاع پست'){
                        this.notification2 = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش همه رباط ها' || this.allows[this.i].name == 'نمایش رباط های خودش' || this.allows[this.i].name == 'افزودن رباط' || this.allows[this.i].name == 'حذف رباط' || this.allows[this.i].name == 'admin'){
                        this.robot = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش همه اطلاع رسانی ها' || this.allows[this.i].name == 'نمایش اطلاع رسانی های خودش' || this.allows[this.i].name == 'افزودن اطلاع رسانی' || this.allows[this.i].name == 'حذف اطلاع رسانی' || this.allows[this.i].name == 'admin'){
                        this.notification = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش همه تصویر ها' || this.allows[this.i].name == 'نمایش تصویر های خودش' || this.allows[this.i].name == 'افزودن تصویر' || this.allows[this.i].name == 'حذف تصویر' || this.allows[this.i].name == 'admin'){
                        this.gallery = 1;
                    }
                    if (this.allows[this.i].name == 'تنظیمات دسته بندی ها' || this.allows[this.i].name == 'تنظیمات قالب سایت' || this.allows[this.i].name == 'تنظیمات سئو'  || this.allows[this.i].name == 'تنظیمات درگاه' || this.allows[this.i].name == 'تنظیمات سایت' || this.allows[this.i].name == 'تنظیمات دیدگاه' || this.allows[this.i].name == 'admin' ){
                        this.setting = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش همه کاربر ها' || this.allows[this.i].name == 'نمایش کاربر های خودش' || this.allows[this.i].name == 'افزودن کاربر' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف کاربر' || this.allows[this.i].name == 'ویرایش کاربر'){
                        this.user = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش بازدید' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف بازدید'){
                        this.view = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش رویداد' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف رویداد'){
                        this.event = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش مقام' || this.allows[this.i].name == 'افزودن مقام' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف مقام' || this.allows[this.i].name == 'ویرایش مقام'){
                        this.role = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش تنوع' || this.allows[this.i].name == 'افزودن تنوع' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف تنوع' || this.allows[this.i].name == 'ویرایش تنوع'){
                        this.variety = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش حامل' || this.allows[this.i].name == 'افزودن حامل' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف حامل' || this.allows[this.i].name == 'ویرایش حامل'){
                        this.carrier = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش زمان' || this.allows[this.i].name == 'افزودن زمان' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف زمان' || this.allows[this.i].name == 'ویرایش زمان'){
                        this.time = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش گارانتی' || this.allows[this.i].name == 'افزودن گارانتی' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف گارانتی' || this.allows[this.i].name == 'ویرایش گارانتی'){
                        this.guarantee = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش دسته های خودش' || this.allows[this.i].name == 'نمایش همه دسته ها' || this.allows[this.i].name == 'افزودن دسته' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف دسته' || this.allows[this.i].name == 'ویرایش دسته'){
                        this.cat = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش برچسب های خودش' || this.allows[this.i].name == 'نمایش همه برچسب ها' || this.allows[this.i].name == 'افزودن برچسب' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف برچسب' || this.allows[this.i].name == 'ویرایش برچسب'){
                        this.tag = 1;
                    }
                    if (this.allows[this.i].name == 'افزودن کشور' || this.allows[this.i].name == 'admin'){
                        this.country = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش کالا های خودش' || this.allows[this.i].name == 'نمایش همه کالا ها' || this.allows[this.i].name == 'افزودن کالا' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف کالا' || this.allows[this.i].name == 'ویرایش کالا'){
                        this.post = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش خبر های خودش' || this.allows[this.i].name == 'نمایش همه خبر ها' || this.allows[this.i].name == 'افزودن خبر' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف خبر' || this.allows[this.i].name == 'ویرایش خبر'){
                        this.news = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش برند های خودش' || this.allows[this.i].name == 'نمایش همه برند ها' || this.allows[this.i].name == 'افزودن برند' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف برند' || this.allows[this.i].name == 'ویرایش برند'){
                        this.brand = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش برگه' || this.allows[this.i].name == 'افزودن برگه' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف برگه' || this.allows[this.i].name == 'ویرایش برگه'){
                        this.page = 1;
                    }
                    if (this.allows[this.i].name == 'نمایش درخواست' || this.allows[this.i].name == 'فرستادن ایمیل' || this.allows[this.i].name == 'افزودن درخواست' || this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف درخواست' || this.allows[this.i].name == 'ویرایش درخواست'){
                        this.ticket = 1;
                    }
                    if (this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف پرداختی' || this.allows[this.i].name == 'نمایش پرداختی'){
                        this.pay = 1;
                    }
                    if (this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'حذف دیدگاه' || this.allows[this.i].name == 'ویرایش دیدگاه'){
                        this.comment = 1;
                    }
                    if (this.allows[this.i].name == 'admin' || this.allows[this.i].name == 'نمایش داشبورد'){
                        this.dashboard = 1;
                    }
                }
            },
            sidebar(item){
                this.index = item;
                this.index2 = item;
            },
        },
        mounted(){
            this.sidebar2();
        },
        created: function() {
            this.$eventHub.on('sidebar', this.sidebar);
        },
    }
</script>

<style scoped>

</style>
