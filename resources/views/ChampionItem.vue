<template>
  <champion class="champion-item">
    <header>
      <h1>{{ champion.title }}</h1>
      <p v-if="champion.id">
        #<span>{{ champion.id }}</span>
      </p>
    </header>

    <section class="champion-item__content">
      <p class="champion-item__description">{{ champion.description }}</p>
      <img
        class="champion-item__image"
        v-if="champion.image.full"
        :src="`${link}` + champion.image.full"
      />
    </section>

    <!-- <footer><a :href="champion.url">Link</a></footer> -->
  </champion>
</template>

<script>
export default {
  data() {
    return {
        link: process.env.MIX_CHAMPION_JSON_URL,
    };
  },
  props: {
    champion: {
      type: Object,
      required: true
    }
  }
};
</script>

<style lang="scss" scoped>
.champion-item {
  padding: 40px 10px;
  border-bottom: 1px solid #000;
  margin-bottom: 20px;

  &__content {
    display: flex;
  }

  &__description {
    font-size: 14px;
    width: 50%;
  }

  &__image {
    width: 50px;
    height: 50px;
    margin-left: 10px;
  }
}
</style>
