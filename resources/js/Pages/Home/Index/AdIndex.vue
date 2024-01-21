<template>
    <section class="allAdIndex width">
        <ul class="adList">
            <li v-for="item in JSON.parse(data.post)">
                <a :href="item.address">
                    <figure>
                        <img :src="item.image" :alt="item.address">
                    </figure>
                </a>
            </li>
        </ul>
    </section>
</template>

<script>
export default {
    name: "AdIndex",
    props:['data']
}
</script>

<style scoped>

</style>
