<script>
  import PageContent from './city/PageContent.vue'
  
  export default {
    components: {
      PageContent
    },
    data: () => ({
      loaded: false,
      record: {}
    }),
    mounted () {
      this.axios.get(`api/v1/weather/forecast/${this.$route.params.city}`).then(({ data: { record } }) => {
        this.record.forecast = record
        
        axios.get(`api/v1/place/${this.$route.params.city}`).then(({ data: { record } }) => {
          this.record.places = record
          setTimeout(() => {
            this.loaded = true
          }, 100)
        })
      })
    }
  }
</script>

<template>
  <main :class="attr['page']" v-if="loaded">
    <!-- Page Content -->
    <page-content
      :payload="record"
    />
  </main>
</template>

<style lang="css" module="attr">
  .page {
    position: relative;
  }
</style>
