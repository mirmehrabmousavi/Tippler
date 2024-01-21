<template>
    <div class="allSingleNews width">
        <div class="right">
            <div class="pic">
                <img :src="post.image" :alt="post.title">
            </div>
            <div class="postsList">
                <div class="titleList">
                    پیشنهادات
                </div>
                <ul>
                    <li v-for="item in suggest">
                        <a :href="'/blog/' + item.slug">
                            <img :src="item.image" :alt="item.title">
                            <div class="showInfo">
                                <h4>{{item.title}}</h4>
                                <span>{{item.created_at}}</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="postsList">
                <div class="titleList">
                    مطالب مرتبط
                </div>
                <ul>
                    <li v-for="item in related">
                        <a :href="'/blog/' + item.slug">
                            <img :src="item.image" :alt="item.title">
                            <div class="showInfo">
                                <h4>{{item.title}}</h4>
                                <span>{{item.created_at}}</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="left">
            <h1>{{post.title}}</h1>
            <div class="leftItem">
                <div class="option">
                    <h3>دسته بندی ها</h3>
                    <a :href="'/blog/category/'+post.category[0].slug">{{post.category[0].name}}</a>
                </div>
                <div class="option">
                    <h4>زمان مورد نیاز برای مطالعه</h4>
                    <a>
                        <span>
                            {{post.time}}
                        </span>
                        دقیقه
                    </a>
                </div>
            </div>
            <p v-html="post.body"></p>
        </div>
    </div>
</template>

<script>
export default {
    name: "SingleNews",
    props:['related','post','suggest']
}
</script>

<style scoped>

</style>
