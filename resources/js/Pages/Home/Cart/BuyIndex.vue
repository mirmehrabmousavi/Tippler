<template>
    <div class="buyIndex width">
        <div class="allBuyItems">
            <div class="allBuySuccessItemTitle" v-if="pay.status == 100 || pay.status == 50">
                <h3>پرداخت با موفقیت انجام شد</h3>
            </div>
            <div class="allBuyFailItemTitle" v-else>
                <h3>پرداخت رد شد</h3>
            </div>
            <div class="allBuyItem">
                <label>زمان پرداخت :</label>
                <h4>{{pay.created_at}}</h4>
            </div>
            <div class="allBuyItem">
                <label>نام خریدار :</label>
                <h4>{{name}}</h4>
            </div>
            <div class="allBuyItem">
                <label>مبلغ پرداخت :</label>
                <h4 v-if="pay.method == 2">{{pay.deposit|NumFormat}} تومان</h4>
                <h4 v-else>{{pay.price|NumFormat}} تومان</h4>
            </div>
            <div class="allBuyItem">
                <label>شماره سفارش :</label>
                <h4>{{pay.property}}</h4>
            </div>
            <div class="allBuyItem">
                <label>وضعیت پرداخت :</label>
                <h4 v-if="pay.status == 100 || pay.status == 50">موفقیت آمیز</h4>
                <h4 v-else>ناموفق</h4>
            </div>
            <div class="allBuyButton">
                <a href="/" :title="'صفحه نخست'" :name="'صفحه نخست'">بازگشت صفحه اصلی</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BuyIndex",
    props : ['name','pay'],
}
</script>

<style scoped>

</style>
