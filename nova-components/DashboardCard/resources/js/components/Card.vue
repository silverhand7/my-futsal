<template>
  <Card class="min-h-0 h-auto">
    <div class="px-3 py-3">
      <p class="text-gray-500 font-light text-xl">Welcome to Dashboard. Owners special area to manage all futsal field data.</p>
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