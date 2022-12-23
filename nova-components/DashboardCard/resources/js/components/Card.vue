<template>
  <Card class="min-h-0 h-auto">
    <div class="px-3 py-3">
      <p class="text-gray-500 font-light text-xl">Selamat datang di Dashboard. Area khusus admin untuk mengelola seluruh data lapangan futsal.</p>
    </div>
  </Card>
</template>

<script>
export default {
  props: [
    'card',

    // The following props are only available on resource detail cards...
    // 'resource',
    // 'resourceId',
    // 'resourceName',
  ],

  mounted() {
    //
  },
}
</script>

<style>

</style>