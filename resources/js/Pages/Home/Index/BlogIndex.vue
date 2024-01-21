<template>
    <div class="allBlogIndex width">
        <div class="title">
            <div class="right">
                <div class="name">
                    <h3 v-if="data.show == 0">جدید ترین</h3>
                    <h3 v-if="data.show == 1">محبوب ترین</h3>
                    <h3 v-if="data.show == 2">پربازدید ترین</h3>
                    <h3 v-if="data.show == 3">ارزان ترین</h3>
                    <h3 v-if="data.show == 4">گران ترین</h3>
                    <h3 v-if="data.show == 5">پرفروش ترین</h3>
                    <span>{{ data.title }}</span>
                </div>
            </div>
            <a href="/blog">{{ data.more }}</a>
        </div>
        <div class="allNews">
            <div class="right">
                <a :href="'/blog/'+data.post[0].slug" class="item">
                    <div class="pic">
                        <img v-lazy="data.post[0].image" :alt="data.post[0].title">
                    </div>
                    <div class="over">
                        <div class="titleItem">
                            <span>{{data.post[0].title}}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="left">
                <a class="item" v-for="item in data.post.slice(1,5)" :href="'/blog/'+item.slug">
                    <div class="pic">
                        <img v-lazy="item.image" :alt="item.title">
                    </div>
                    <div class="over">
                        <div class="titleItem">
                            <span>{{item.title}}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BlogIndex",
    props: ['data'],
}
</script>

<style scoped>

</style>
