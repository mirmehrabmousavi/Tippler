<template>
  <div class="allCategoryIndex width">
      <div class="title">{{ data.title }}</div>
      <ul>
          <li v-for="item in JSON.parse(data.post)">
              <a :href="item.address">
                  <figure class="pic">
                      <img v-lazy="item.image" :alt="item.title">
                  </figure>
                  <h4>{{ item.title }}</h4>
              </a>
          </li>
      </ul>
  </div>
</template>

<script>
export default {
    name: "CategoryIndex",
    props:['data']
}
</script>

<style scoped>

</style>
