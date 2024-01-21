<template>
    <div class="allComment">
        <div class="allCommentContainerSend" v-if="showSendLoader">
            <div class="allCommentContainerTop">
                <div class="allCommentContainerTopPic">
                    <img :src="JSON.parse(posts.image)[0]" :alt="posts.title">
                </div>
                <div class="allCommentContainerTopItems">
                    <div class="allCommentContainerTopItemsTitle">
                        <h3>{{posts.title}}</h3>
                    </div>
                    <div class="allCommentContainerTopItemsRate">
                        <div class="allCommentContainerTopItemsRateItem" v-for="item in rates">
                            <label>{{item.name}}</label>
                            <div class="rateItemsCount">
                                <div class="rateItemsCountItem">
                                    <div class="rateItemsCountItemBarActive" v-if="item.rate >= 1"></div>
                                    <div class="rateItemsCountItemBar" v-if="item.rate == 0"></div>
                                    <div class="rateItemsCountItemCircleActives" @click.prevent="item.rate = 0" v-if="item.rate >= 1"></div>
                                    <div class="rateItemsCountItemCircleActive" @click.prevent="item.rate = 0" v-if="item.rate == 0"></div>
                                </div>
                                <div class="rateItemsCountItem">
                                    <div class="rateItemsCountItemBarActive" v-if="item.rate >= 2"></div>
                                    <div class="rateItemsCountItemBar" v-if="item.rate <= 1"></div>
                                    <div class="rateItemsCountItemCircleActives" @click.prevent="item.rate = 1" v-if="item.rate >= 2"></div>
                                    <div class="rateItemsCountItemCircleActive" @click.prevent="item.rate = 1" v-if="item.rate == 1"></div>
                                    <div class="rateItemsCountItemCircle" @click.prevent="item.rate = 1" v-if="item.rate <= 0"></div>
                                </div>
                                <div class="rateItemsCountItem">
                                    <div class="rateItemsCountItemBarActive" v-if="item.rate >= 3"></div>
                                    <div class="rateItemsCountItemBar" v-if="item.rate <= 2"></div>
                                    <div class="rateItemsCountItemCircleActives" @click.prevent="item.rate = 2" v-if="item.rate >= 3"></div>
                                    <div class="rateItemsCountItemCircleActive" @click.prevent="item.rate = 2" v-if="item.rate == 2"></div>
                                    <div class="rateItemsCountItemCircle" @click.prevent="item.rate = 2" v-if="item.rate <= 1"></div>
                                </div>
                                <div class="rateItemsCountItem">
                                    <div class="rateItemsCountItemBarActive" v-if="item.rate >= 4"></div>
                                    <div class="rateItemsCountItemBar" v-if="item.rate <= 3"></div>
                                    <div class="rateItemsCountItemCircleActives" @click.prevent="item.rate = 3" v-if="item.rate >= 4"></div>
                                    <div class="rateItemsCountItemCircleActive" @click.prevent="item.rate = 3" v-if="item.rate == 3"></div>
                                    <div class="rateItemsCountItemCircle" @click.prevent="item.rate = 3" v-if="item.rate <= 2"></div>
                                </div>
                                <div class="rateItemsCountItem">
                                    <div class="rateItemsCountItemCircleActive" @click.prevent="item.rate = 4" v-if="item.rate == 4"></div>
                                    <div class="rateItemsCountItemCircle" @click.prevent="item.rate = 4" v-if="item.rate <= 3"></div>
                                </div>
                                <span v-if="item.rate == 0">خیلی بد</span>
                                <span v-if="item.rate == 1">بد</span>
                                <span v-if="item.rate == 2">متوسط</span>
                                <span v-if="item.rate == 3">خوب</span>
                                <span v-if="item.rate == 4">عالی</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="allCommentContainerBottom">
                <div class="allCommentContainerBottomCoercion" v-if="coercion == 1">
                    <div class="allCommentContainerBottomCoercionItem">
                        <label>نام</label>
                        <label>
                            <input type="text" placeholder="نام را وارد کنید" v-model="UserName">
                        </label>
                    </div>
                    <div class="allCommentContainerBottomCoercionItem">
                        <label>ایمیل</label>
                        <label>
                            <input type="email" placeholder="ایمیل را وارد کنید" v-model="emailUser">
                        </label>
                    </div>
                </div>
                <div class="allCommentContainerBottomItem">
                    <label>عنوان</label>
                    <label>
                        <input type="text" placeholder="عنوان را وارد کنید" v-model="title">
                    </label>
                </div>
                <div class="allCommentContainerBottomItem">
                    <div class="allCommentContainerBottomItemTitle">
                        <i>
                            <svg-icon :icon="'#circle'"></svg-icon>
                        </i>
                        <label>نقاط قوت</label>
                    </div>
                    <label>
                        <input type="text" placeholder="نقطه قوت را وارد کنید" v-model="good" @keyup.enter="addGood">
                        <i @click.prevent="addGood" v-if="good">
                            <svg-icon :icon="'#add'"></svg-icon>
                        </i>
                    </label>
                    <span v-for="(item , index) in goods" :key="index">
                        {{item}}
                        <i @click.prevent="removeGood(index)">
                            <svg-icon :icon="'#cancel'"></svg-icon>
                        </i>
                    </span>
                </div>
                <div class="allCommentContainerBottomItem">
                    <div class="allCommentContainerBottomItemTitle">
                        <i>
                            <svg-icon :icon="'#circle'"></svg-icon>
                        </i>
                        <label>نقاط ضعف</label>
                    </div>
                    <label>
                        <input type="text" placeholder="نقطه ضعف را وارد کنید" v-model="bad" @keyup.enter="addBad">
                        <i @click.prevent="addBad" v-if="bad">
                            <svg-icon :icon="'#add'"></svg-icon>
                        </i>
                    </label>
                    <span v-for="(item , index) in bads" :key="index">
                        {{item}}
                        <i @click.prevent="removeBad(index)">
                            <svg-icon :icon="'#cancel'"></svg-icon>
                        </i>
                    </span>
                </div>
                <div class="allCommentContainerBottomItem">
                    <label>توضیحات</label>
                    <textarea v-model="body" placeholder="توضیحات را وارد کنید"></textarea>
                </div>
                <div class="allCommentContainerBottomSuggest">
                    <label>آیا خرید این محصول را به دوستانتان پیشنهاد می کنید؟</label>
                    <div class="allCategoryPanel" @click="showStatus = !showStatus">
                        <div class="categoryShow">
                            <h4 v-if="status == 0">در مورد خرید این محصول مطمئن نیستم</h4>
                            <h4 v-if="status == 1">خرید این محصول را توصیه نمی‌کنم</h4>
                            <h4 v-if="status == 2">خرید این محصول را توصیه می‌کنم</h4>
                            <i>
                                <svg-icon :icon="'#down'"></svg-icon>
                            </i>
                        </div>
                        <ul v-if="showStatus">
                            <li @click="status = 0">در مورد خرید این محصول مطمئن نیستم</li>
                            <li @click="status = 1">خرید این محصول را توصیه نمی‌کنم</li>
                            <li @click="status = 2">خرید این محصول را توصیه می‌کنم</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="allCommentButtons">
                <button @click.prevent="sendComment">
                    <i>
                        <svg-icon :icon="'#comment'"></svg-icon>
                    </i>
                    ارسال
                    <img src="/img/loaderHome.gif" alt="صبر کنید ..." v-if="showLoader">
                </button>
                <button @click.prevent="showSendLoader = !showSendLoader">انصراف</button>
            </div>
        </div>
        <div class="allCommentAllow" v-if="showSendLoader == false">
            <div class="allCommentAllowItem">
                <div class="allCommentAllowItemBtn">
                    <h3>شما هم میتوانید در مورد این محصول نظر دهید</h3>
                    <h4>برای ثبت نظر لازم هست ابتدا</h4>
                    <a href="/login">وارد حساب کاربری خود شوید</a>
                    <button @click.prevent="showSendLoader = !showSendLoader">افزودن نظر جدید</button>
                </div>
                <div class="allCommentAllowItemRate" v-if="rates.length">
                    <div class="titleRate">
                        <h4>امتیاز محصول</h4>
                        <h3>
                            <span>{{ allRate }}</span>
                            از مجموع {{ countRate }} امتیاز
                        </h3>
                    </div>
                    <div class="container">
                        <div class="feedback">
                            <div class="rating">
                                <input type="radio" value="5" id="5" v-model="rating">
                                <label @click="btnRating(5)" :for="rating"></label>
                                <input type="radio" value="4" id="4" v-model="rating">
                                <label @click="btnRating(4)" :for="rating"></label>
                                <input type="radio" value="3" id="3" v-model="rating">
                                <label @click="btnRating(3)" :for="rating"></label>
                                <input type="radio" value="2" id="2" v-model="rating">
                                <label @click="btnRating(2)" :for="rating"></label>
                                <input type="radio" value="1" id="1" v-model="rating">
                                <label @click="btnRating(1)" :for="rating"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="allCommentContainerGet">
            <div class="allCommentContainerGetItems">
                <div class="showGetLoader" v-if="showGetLoader">
                    <i class="loading">
                        <svg-icon :icon="'#loading'"></svg-icon>
                    </i>
                </div>
                <div class="commentItems" v-if="comments.data">
                    <div class="paginate" v-if="comments.links">
                        <div class="allPaginatePanel" v-if="comments.links.length != 3">
                            <div class="pageItem" v-for="(item,index) in comments.links" :key="index">
                                <div class="pageItemLabel" v-if="item.label == 'Previous' || item.label == 'Next'">
                                    <div v-if="item.label == 'Previous' && item.url != null" @click="sendPage(item.url)"><svg-icon :icon="'#right'"></svg-icon></div>
                                    <div v-if="item.label == 'Next' && item.url != null" @click="sendPage(item.url)"><svg-icon :icon="'#left'"></svg-icon></div>
                                </div>
                                <div class="pageItemLabel" v-else>
                                    <div v-if="item.active == true" class="active" @click="sendPage(item.url)">{{item.label}}</div>
                                    <div v-else @click="sendPage(item.url)">{{item.label}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="getItems" v-if="comments.data.length">
                        <div class="allCommentContainerGetItem" v-for="(item , index) in comments.data" :key="index">
                            <div class="allCommentContainerGetUser">
                                <div class="allCommentContainerUser">
                                    <div class="allCommentContainerUserPic" v-if="showUser == 0 || showUser== 2">
                                        <img v-if="item.user.profile == null" src="/img/user.png" :alt="item.user.name">
                                        <img v-else :src="item.user.profile" :alt="item.user.name">
                                    </div>
                                    <div class="allCommentContainerUserName" v-if="showUser == 0 || showUser== 1">
                                        {{item.user.name}}
                                    </div>
                                    <div class="allCommentContainerUserOnline" v-if="checkOnline == 1">
                                        <span>زمان آنلاین بودن :</span>
                                        <span>{{item.user.activity}}</span>
                                    </div>
                                </div>
                                <div class="allCommentContainerCreated">
                                    <span>{{item.created_at}}</span>
                                </div>
                                <div class="allCommentContainerStatusUnknown" v-if="item.status == 0">
                                    <span>در مورد خرید این محصول مطمئن نیستم</span>
                                </div>
                                <div class="allCommentContainerStatusBad" v-if="item.status == 1">
                                    <i>
                                        <svg-icon :icon="'#likeDown'"></svg-icon>
                                    </i>
                                    <span>خرید این محصول را توصیه نمی‌کنم</span>
                                </div>
                                <div class="allCommentContainerStatusGood" v-if="item.status == 2">
                                    <i>
                                        <svg-icon :icon="'#likeUp'"></svg-icon>
                                    </i>
                                    <span>خرید این محصول را توصیه می‌کنم</span>
                                </div>
                                <div class="allCommentContainerRate" v-if="JSON.parse(item.rate).length">
                                    <label>امتیاز کاربر</label>
                                    <div class="allCommentContainerRateContainer">
                                        <div class="allCommentContainerRateContainerItem" v-for="(value,index2) in JSON.parse(item.rate)" :key="index2">
                                            <span>{{value.name}}</span>
                                            <div class="allSingleHomeDetailBodyItemRate">
                                                <div class="allSingleHomeDetailBodyItemRateValue" :style="{'width' : value.rate * '25' +'%'}"></div>
                                            </div>
                                            <span v-if="value.rate == 0">خیلی بد</span>
                                            <span v-if="value.rate == 1">بد</span>
                                            <span v-if="value.rate == 2">متوسط</span>
                                            <span v-if="value.rate == 3">خوب</span>
                                            <span v-if="value.rate == 4">عالی</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="allCommentContainerGetBody">
                                <div class="allCommentTitle">
                                    {{item.title}}
                                </div>
                                <div class="allCommentBody">
                                    <p>{{item.body}}</p>
                                </div>
                                <div class="allCommentGoodItemsContainer">
                                    <label>نقاط قوت</label>
                                    <div class="allCommentGoodItems">
                                        <div class="allCommentGoodItem" v-for="(value,index3) in JSON.parse(item.good)" :key="index3">
                                            <i>
                                                <svg-icon :icon="'#circle'"></svg-icon>
                                            </i>
                                            {{value}}
                                        </div>
                                    </div>
                                </div>
                                <div class="allCommentBadItemsContainer">
                                    <label>نقاط ضعف</label>
                                    <div class="allCommentBadItems">
                                        <div class="allCommentBadItem" v-for="(value,index3) in JSON.parse(item.bad)" :key="index3">
                                            <i>
                                                <svg-icon :icon="'#circle'"></svg-icon>
                                            </i>
                                            {{value}}
                                        </div>
                                    </div>
                                </div>
                                <div class="allCommentContainerAnswer" v-if="replyAllow == 1">
                                    <div class="allCommentContainerAnswerTitle" v-if="showReply != index" @click.prevent="showReply = index">
                                        <i>
                                            <svg-icon :icon="'#reply'"></svg-icon>
                                        </i>
                                        <span>پاسخ</span>
                                    </div>
                                    <div class="allCommentContainerAnswerBody" v-if="showReply == index">
                                        <div class="allCommentContainerAnswerBodyBtn">
                                            <div class="allCommentContainerAnswerBodyBtnItem">
                                                <i>
                                                    <svg-icon :icon="'#reply'"></svg-icon>
                                                </i>
                                                <span>پاسخ</span>
                                            </div>
                                            <div class="allCommentContainerAnswerBodyBtnItem">
                                                <button @click.prevent="sendReply(item.id)">ارسال</button>
                                                <button @click.prevent="showReply = -1">انصراف</button>
                                            </div>
                                        </div>
                                        <label>
                                            <textarea placeholder="پاسخ را وارد کنید" v-model="reply"></textarea>
                                        </label>
                                    </div>
                                </div>
                                <div class="allCommentContainerReply">
                                    <div class="allCommentContainerReplyItem" v-for="(child,index4) in item.comments" :key="index4">
                                        <div class="allCommentContainerReplyItemUser">
                                            <div class="allCommentContainerReplyItemUserPic" v-if="showUser == 0 || showUser== 2">
                                                <img v-if="child.user.profile == null" :src="child.user.profile_photo_url" :alt="child.user.name">
                                                <img v-else :src="child.user.profile" :alt="child.user.name">
                                            </div>
                                            <div class="allCommentContainerReplyItemUserName" v-if="showUser == 0 || showUser== 1">
                                                {{child.user.name}}
                                            </div>
                                            <div class="allCommentContainerReplyItemUserOnline" v-if="checkOnline == 1">
                                                <span>زمان آنلاین بودن :</span>
                                                <span>{{child.user.activity}}</span>
                                            </div>
                                        </div>
                                        <div class="allCommentContainerReplyItemP">
                                            <p>
                                                {{child.body}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="emptyComment" v-else>
                        <i>
                            <svg-icon :icon="'#comment'"></svg-icon>
                        </i>
                        <h3>دیدگاهی ثبت نشده</h3>
                    </div>
                    <div class="paginate" v-if="comments.links">
                        <div class="allPaginatePanel" v-if="comments.links.length != 3">
                            <div class="pageItem" v-for="(item,index) in comments.links" :key="index">
                                <div class="pageItemLabel" v-if="item.label == 'Previous' || item.label == 'Next'">
                                    <div v-if="item.label == 'Previous' && item.url != null" @click="sendPage(item.url)"><svg-icon :icon="'#right'"></svg-icon></div>
                                    <div v-if="item.label == 'Next' && item.url != null" @click="sendPage(item.url)"><svg-icon :icon="'#left'"></svg-icon></div>
                                </div>
                                <div class="pageItemLabel" v-else>
                                    <div v-if="item.active == true" class="active" @click="sendPage(item.url)">{{item.label}}</div>
                                    <div v-else @click="sendPage(item.url)">{{item.label}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SvgIcon from "../../Svg/SvgIcon";
export default {
    name: "AllComment",
    props: ['rate','posts','errors' , 'replyAllow' , 'showUser' , 'coercion' , 'checkOnline'],
    components:{
        SvgIcon,
    },
    data(){
        return{
            rates : this.rate,
            comments : [],
            i : 0,
            rating : 0,
            allRate : 0,
            countRate : 0,
            status : 0,
            showLoader : false,
            showStatus : false,
            showReply : -1,
            showGetLoader : false,
            showSendLoader : false,
            good : '',
            title : '',
            UserName : '',
            emailUser : '',
            body : '',
            reply : '',
            goods : [],
            bad : '',
            bads : [],
            notificationSystem:{
                options: {
                    show: {
                        icon: "icon-person",
                        position: "topCenter",
                    },
                    success: {
                        position: "bottomRight"
                    },
                    error: {
                        position: "bottomRight"
                    },
                }
            },
        }
    },
    methods:{
        sendComment(){
            if (this.body != ''){
                if (this.coercion == 1){
                    if (this.emailUser != '' || this.UserName != ''){
                        this.showLoader =true;
                        let rate = JSON.stringify(this.rates);
                        let bads = JSON.stringify(this.bads);
                        let goods = JSON.stringify(this.goods);
                        const url = `/send-comment`;
                        axios.post(url , {
                            rate : rate,
                            bads : bads,
                            goods : goods,
                            status : this.status,
                            title : this.title,
                            post : this.posts,
                            emailUser : this.emailUser,
                            UserName : this.UserName,
                            body : this.body,
                        })
                            .then(response =>{
                                if (response.data == 'noUser'){
                                    this.$toast.error('عضو نیستید', 'ابتدا عضو شوید', this.notificationSystem.options.error);
                                }
                                if (response.data == 'limit'){
                                    this.$toast.error('انجام نشد', 'بیش از حد دیدگاه ارسال کردید', this.notificationSystem.options.error);
                                }
                                if (response.data == 'badWord'){
                                    this.$toast.error('انجام نشد', 'از الفاظ توهین آمیز استفاده نکنید', this.notificationSystem.options.error);
                                }
                                if (response.data == 'success'){
                                    this.$toast.success('دیدگاه ارسال شد', 'دیدگاه بعد تایید نمایش داده میشود', this.notificationSystem.options.success);
                                    this.bads = [];
                                    this.goods = [];
                                    this.title = '';
                                    this.body = '';
                                    this.emailUser = '';
                                    this.UserName = '';
                                    this.good = '';
                                    this.bad = '';
                                    this.getComment();
                                }
                                this.showLoader = false
                            })
                    }
                }else{
                    this.showLoader =true;
                    let rate = JSON.stringify(this.rates);
                    let bads = JSON.stringify(this.bads);
                    let goods = JSON.stringify(this.goods);
                    const url = `/send-comment`;
                    axios.post(url , {
                        rate : rate,
                        bads : bads,
                        goods : goods,
                        status : this.status,
                        title : this.title,
                        post : this.posts,
                        emailUser : null,
                        UserName : null,
                        body : this.body,
                    })
                        .then(response =>{
                            if (response.data == 'noUser'){
                                this.$toast.error('عضو نیستید', 'ابتدا عضو شوید', this.notificationSystem.options.error);
                            }
                            if (response.data == 'limit'){
                                this.$toast.error('انجام نشد', 'بیش از حد دیدگاه ارسال کردید', this.notificationSystem.options.error);
                            }
                            if (response.data == 'badWord'){
                                this.$toast.error('انجام نشد', 'از الفاظ توهین آمیز استفاده نکنید', this.notificationSystem.options.error);
                            }
                            if (response.data == 'success'){
                                this.$toast.success('دیدگاه ارسال شد', 'دیدگاه بعد تایید نمایش داده میشود', this.notificationSystem.options.success);
                                this.bads = [];
                                this.goods = [];
                                this.title = '';
                                this.body = '';
                                this.good = '';
                                this.emailUser = '';
                                this.UserName = '';
                                this.bad = '';
                                this.getComment();
                            }
                            this.showLoader = false
                        })
                }
            }
        },
        sendReply(id){
            if (this.reply != ''){
                this.showReplyLoader =true;
                const url = `/send-reply`;
                axios.post(url , {
                    reply : this.reply,
                    post : this.posts,
                    commentId : id,
                })
                    .then(response =>{
                        if (response.data == 'noUser'){
                            this.$toast.error('عضو نیستید', 'ابتدا عضو شوید', this.notificationSystem.options.error);
                        }
                        if (response.data == 'limit'){
                            this.$toast.error('انجام نشد', 'بیش از حد دیدگاه ارسال کردید', this.notificationSystem.options.error);
                        }
                        if (response.data == 'badWord'){
                            this.$toast.error('انجام نشد', 'از الفاظ توهین آمیز استفاده نکنید', this.notificationSystem.options.error);
                        }
                        else{
                            this.$toast.success('دیدگاه ارسال شد', 'دیدگاه بعد تایید نمایش داده میشود', this.notificationSystem.options.success);
                            this.reply = '';
                            this.getComment();
                            this.showReplyLoader = false
                        }
                    })
            }
        },
        getComment(){
            this.showGetLoader =true;
            const url = `/get-comment`;
            axios.post(url ,{
                postID : this.posts.id
            })
                .then(response=>{
                    this.showGetLoader =false;
                    this.comments = response.data;
                })
        },
        removeGood(index){
            this.goods.splice(index , 1);
        },
        addGood(){
            if (this.good != ''){
                this.goods.push(this.good);
                this.good = '';
            }
        },
        removeBad(index){
            this.bads.splice(index , 1);
        },
        addBad(){
            if (this.bad != ''){
                this.bads.push(this.bad);
                this.bad = '';
            }
        },
        btnRating(number){
            if(this.rating == 0){
                this.rating = number;
                const url = `/rate`;
                axios.post(url ,{
                    post_id : this.posts.id,
                    rate_post : number,
                })
                    .then(response=>{
                        if (response.data == 'noUser'){
                            this.$toast.error('عضو نیستید', 'ابتدا عضو شوید', this.notificationSystem.options.error);
                            this.rating = 0;
                        }
                        if (response.data == 'found'){

                        }
                        if (response.data != 'found' && response.data != 'noUser'){
                            this.$toast.success('ارسال شد', 'ممنون از نظر دادن شما', this.notificationSystem.options.success);
                            this.rating = response.data[0];
                            this.$emit('allRate' , response.data[1]);
                        }
                    })
            }
        },
        getRate(){
            const url = '/get-rate';
            axios.post(url ,{
                post_id : this.posts.id,
            })
                .then(response=>{
                    this.rating = response.data[0];
                    this.allRate = response.data[1];
                    this.countRate = response.data[2];
                })
        },
    },
    mounted() {
        this.getComment();
        this.getRate();
    }
}
</script>

<style scoped>

</style>
