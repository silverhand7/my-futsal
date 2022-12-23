<template>
  <div>
    <h1 class="font-normal text-xl md:text-xl">Selamat Datang</h1>
    <p class="leading-tight mt-3"> Berikut data laporan berupa graphic pada My Stadium Futsal Bali</p>
    <Card class="bg-white dark:bg-gray-800 rounded-lg shadow mt-8">
      <div class="px-3 py-3">
        <h1 class="text-center text-3xl text-gray-500 font-light">Hello World Lorem Ipsum</h1>
      </div>
    </Card>
  </div>
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
