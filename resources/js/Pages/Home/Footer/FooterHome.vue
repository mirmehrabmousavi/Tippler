<template>
    <div class="allFooterIndex">
        <div class="blockFooter width">
            <div class="topFooter">
                <div class="right">
                    <div class="iconRec">
                        <svg-icon :icon="'#FooterRec'"></svg-icon>
                    </div>
                    <div class="rightData">
                        <div class="title">
                            <h2>
                                فروشگاه اینترنتی
                                <span>{{ name }}</span>
                            </h2>
                            <h3>بررسی، انتخاب و خرید آنلاین</h3>
                        </div>
                        <p>{{about}}</p>
                        <div class="data">
                            <div class="socialItems">
                                <a :href="telegram" title="تلگرام">
                                    <i>
                                        <svg-icon :icon="'#telegram'"></svg-icon>
                                    </i>
                                </a>
                                <a :href="facebook" title="فیسبوک">
                                    <i>
                                        <svg-icon :icon="'#facebook'"></svg-icon>
                                    </i>
                                </a>
                                <a :href="instagram" title="اینستاگرام">
                                    <i>
                                        <svg-icon :icon="'#instagram'"></svg-icon>
                                    </i>
                                </a>
                                <a :href="twitter" title="توییتر">
                                    <i>
                                        <svg-icon :icon="'#twitter'"></svg-icon>
                                    </i>
                                </a>
                            </div>
                            <div class="phone">
                                <h4>{{ number }}</h4>
                                <i>
                                    <svg-icon :icon="'#phone2'"></svg-icon>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="left">
                    <div class="title">
                        <h2>
                            نماد های
                            <span>اعتماد</span>
                        </h2>
                        <h3>با خیالی آسوده خرید کنید</h3>
                    </div>
                    <div class="images">
                        <div v-html="fanavari"></div>
                        <div v-html="enamad"></div>
                    </div>
                </div>
            </div>
            <div class="mainFooter">
                <div class="mainItem">
                    <i>
                        <svg-icon :icon="'#7day'"></svg-icon>
                    </i>
                    <h4>هفت روز ضمانت بازگشت</h4>
                </div>
                <div class="mainItem">
                    <i>
                        <svg-icon :icon="'#secure'"></svg-icon>
                    </i>
                    <h4>ضمانت کالا</h4>
                </div>
                <div class="mainItem">
                    <i>
                        <svg-icon :icon="'#support'"></svg-icon>
                    </i>
                    <h4>پشتیبانی آنلاین</h4>
                </div>
                <div class="mainItem">
                    <i>
                        <svg-icon :icon="'#express'"></svg-icon>
                    </i>
                    <h4>تحویل اکسپرس</h4>
                </div>
                <div class="mainItem">
                    <i>
                        <svg-icon :icon="'#payHome'"></svg-icon>
                    </i>
                    <h4>پرداخت در محل</h4>
                </div>
            </div>
            <div class="catFooter">
                <div class="catItem">
                    <h3>دسته بندی</h3>
                    <ul>
                        <li v-for="item in footercat">
                            <a :href="'/products/category/' + item.slug">{{item.name}}</a>
                        </li>
                    </ul>
                </div>
                <div class="catItem">
                    <h3>برگه ها</h3>
                    <ul>
                        <li v-for="item in pages">
                            <a :href="'/page/' + item.slug">{{item.title}}</a>
                        </li>
                    </ul>
                </div>
                <div class="catItem">
                    <h3>پر تخفیف ترین</h3>
                    <ul>
                        <li v-for="item in off">
                            <a :href="'/product/' + item.slug">{{ item.title }}</a>
                        </li>
                    </ul>
                </div>
                <div class="catItem">
                    <h3>دسترسی سریع</h3>
                    <ul>
                        <li v-for="item in links">
                            <a :href="item.address">{{ item.name }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="botFooter">
                کلیه حقوق این سایت متعلق به شرکت {{ name }} می باشد
            </div>
        </div>
    </div>
</template>

<script>
import SvgIcon from "../../Svg/SvgIcon";
export default {
    name: "FooterHome",
    components: {SvgIcon},
    props:['footercat','enamad','fanavari','links','pages','off','name','about','number','telegram','twitter','instagram','facebook']
}
</script>

<style scoped>

</style>
