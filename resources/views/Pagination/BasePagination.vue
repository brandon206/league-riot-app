<template>
  <div class="base-pagination">
    <BaseButton
      :disabled="isPreviousButtonDisabled"
      @click.native="previousPage"
    >
      ←
    </BaseButton>
    <BaseButton
      :disabled="isNextButtonDisabled"
      @click.native="nextPage"
    >
      →
    </BaseButton>
  </div>
</template>
<script>
import BaseButton from "./BaseButton.vue";
export default {
  components: {
    BaseButton
  },
  props: {
    currentPage: {
      type: Number,
      required: true
    },
    pageCount: {
      type: Number,
      required: true
    }
  },
  computed: {
    isPreviousButtonDisabled() {
      return this.currentPage === 1
    },
    isNextButtonDisabled() {
      return this.currentPage === this.pageCount
    }
  },
  methods: {
    nextPage() {
      this.$emit('nextPage')
    },
    previousPage() {
      this.$emit('previousPage')
    }
  }
}
</script>