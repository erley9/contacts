<template>

  <nav class="flex items-center justify-between flex-wrap bg-teal-500 p-6">
    <div class="block lg:hidden">
      <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
      </button>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
      <div class="text-sm lg:flex-grow">
        <RouterLink v-show="$route.path==='/' || $route.path==='/registro' ? false : true"   class="text-white hover:text-black" to="/contact">{{ $t("nav.menuitem") }}</RouterLink>
      </div>
      <div></div>
      <div>
        <a href="#"  
        v-show="$route.path==='/' || $route.path==='/registro' ? false : true" 
        @click.prevent="logout" 
        class="inline-block text-sm px-4 py-2 leading-none border rounded text-white hover:text-teal-500 hover:bg-white border-white mt-4 lg:mt-0">
        {{$t("nav.btnlogout")}}
        </a>
      </div>
    </div>
  </nav>
</template>

<script>
  import {RouterLink} from 'vue-router';
  import { defineComponent } from "vue";
  import {useRouter} from 'vue-router';
  import AuthDataService from '../services/AuthDataService';
  import SelectLanguage from "./SelectLanguage.vue";


  export default defineComponent({
    "name": "Nabvbar",
    "components":{
      SelectLanguage
    },
    setup(props) {
      const router = useRouter();
  
      const logout = async function logout() {
        AuthDataService.logout()
        localStorage.removeItem("accesstoken");
        router.push("/");
      }
      
      return {
        logout
      }
    }
  })
</script>
