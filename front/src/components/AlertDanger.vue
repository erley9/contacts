<template>

  <div class="bg-orange-100 min-w-fit ml-10 mt-5 border-l-4 border-orange-500 text-orange-700 p-4 absolute" role="alert">
    <p class="font-bold">{{titulo}}</p>
    <p> {{ message }}</p>
  </div>

</template>


<script> 
  import {defineComponent, defineProps, toRefs} from "vue";

  export default defineComponent({
    "name": "AlertDanger",
    props: ["titulo","message"],
    setup(props) {
      console.log(props.titulo);
      return {}
    }
  })
</script>
