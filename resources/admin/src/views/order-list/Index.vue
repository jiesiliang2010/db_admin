<template>
  <div @click="toDetail(5)">order-list</div>
</template>

<script>
export default {
  name: 'Index',
  methods: {
    toDetail: function (id) {
      console.log(id)
      this.$router.push('/order-detail/' + id)
    },
  },
}
</script>
