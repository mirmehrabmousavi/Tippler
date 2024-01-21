<template>
      <div class="allProfileIndex width">
          <seller-list :tab="0"></seller-list>
          <div class="widgetItems">
              <div class="widgetItem">
                  <div class="widgetIcon">
                      <svg-icon :icon="'#bill'"></svg-icon>
                  </div>
                  <div class="widgetSubject">
                      <h4>مبلغ کل سفارشات</h4>
                      <h5>{{paycount|NumFormat}} تومان</h5>
                  </div>
              </div>
              <div class="widgetItem">
                  <div class="widgetIcon">
                      <svg-icon :icon="'#post'"></svg-icon>
                  </div>
                  <div class="widgetSubject">
                      <h4>تعداد محصولات شما</h4>
                      <h5>{{postcount|NumFormat}}</h5>
                  </div>
              </div>
              <div class="widgetItem">
                  <div class="widgetIcon">
                      <svg-icon :icon="'#bill'"></svg-icon>
                  </div>
                  <div class="widgetSubject">
                      <h4>کل تسویه حساب</h4>
                      <h5>{{checksum|NumFormat}} تومان</h5>
                  </div>
              </div>
          </div>
          <div class="productItems">
              <div class="productItem">
                  <h3>آخرین سفارشات</h3>
                  <table>
                      <tr>
                          <th>#</th>
                          <th>شماره سفارش</th>
                          <th>محصول</th>
                          <th>مبلغ</th>
                      </tr>
                      <tr v-for="(item, index) in pays" :key="index">
                          <td>
                              <span>{{++index}}</span>
                          </td>
                          <td>
                              <span>{{item.pay.property}}</span>
                          </td>
                          <td>
                              <span>{{item.post.title}}</span>
                          </td>
                          <td>
                              <span>{{item.price|NumFormat}} تومان </span>
                          </td>
                      </tr>
                  </table>
              </div>
              <div class="productItem">
                  <h3>آخرین محصولات</h3>
                  <table>
                      <tr>
                          <th>#</th>
                          <th>عنوان محصول</th>
                          <th>مبلغ</th>
                      </tr>
                      <tr v-for="(item, index) in posts" :key="index">
                          <td>
                              <span>{{++index}}</span>
                          </td>
                          <td>
                              <span>{{item.title}}</span>
                          </td>
                          <td>
                              <span>{{item.price|NumFormat}} تومان </span>
                          </td>
                      </tr>
                  </table>
              </div>
          </div>
      </div>
</template>

<script>
import SellerList from "./SellerList";
import SvgIcon from "../../Svg/SvgIcon";
export default {
    name: "SellerIndex",
    components: {SellerList,SvgIcon},
    props:['pays','paycount','postcount','checksum','posts']
}
</script>

<style scoped>

</style>
