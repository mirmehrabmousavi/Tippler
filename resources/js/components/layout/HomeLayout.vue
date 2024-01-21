<template>
    <div class="allHome">
        <svg-content></svg-content>
        <header-home></header-home>
        <div class="contentHome">
            <slot></slot>
        </div>
    </div>
</template>

<script>
import SvgContent from "../../Pages/Svg/SvgContent";
import HeaderHome from "../../Pages/Home/Header/HeaderHome";
import FooterHome from "../../Pages/Home/Footer/FooterHome";

export default {
    name: "HomeLayout",
    components:{
        FooterHome,
        SvgContent,
        HeaderHome,
    },
}
</script>

<style scoped>

</style>
