<template>
  <alert-danger v-if="error" titulo="Atenção" :message="message" />   
  <div class="flex justify-center items-center">

    <div class="w-full max-w-xs mt-20">

      <form  @submit.prevent="cadastrar " class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

        <div class="mb-4">
          <label 
            class="block text-gray-700 text-sm font-bold mb-2" 
            required for="username"
          >
          {{ $t("register.inputName") }}
          </label>

          <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="inputLoginEmail" 
            type="text" 
            :placeholder="$t('register.inputName')"
            name="name"
            v-model="name"
            required
          >
        </div>
        
        <div class="mb-4">
          <label 
            class="block text-gray-700 text-sm font-bold mb-2" 
            required for="username"
          >
          {{ $t("register.inputEmail") }}
          </label>

          <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="inputLoginEmail" 
            type="text" 
            :placeholder="$t('register.inputEmail')"
            name="email"
            v-model="email"
            required
          >
        </div>

        <div class="mb-6">
          <label 
            class="block text-gray-700 text-sm font-bold mb-2" 
            required 
            for="password"
          >
          {{ $t("register.inputPassword") }}
          </label>

          <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" 
            id="inputPassword" 
            type="password" 
            placeholder="******************"
            name="password"
            v-model="password"
            required
          >
        </div>

        <div class="flex items-center justify-between">       
          <button 
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
          type="submit"
          >
          {{ $t("register.btnSave") }}
          </button>
        </div>

      </form>
    </div>
  </div>
</template>

<script>
import {ref, defineComponent} from 'vue';
import AuthDataService from '../services/AuthDataService';
import { useRouter } from 'vue-router';
import { useContacts } from '@/stores/contactsStore'
import AlertDanger from "@/components/AlertDanger.vue";

export default defineComponent({
  name:"register",
  components:{
    AlertDanger
  },
  setup (){      
    const name = ref("")
    const email = ref("")
    const password = ref("")
    const error = ref(false)
    const router = useRouter()
    const store = useContacts()
    const message = ref("");

    const cadastrar = async function (){
      try{
        const {data} = await AuthDataService.register({
          "name":name.value,
          "email":email.value,
          "password": password.value
        });

        if (data.status) {
          localStorage.setItem('accesstoken', data.token);
          store.getContacts(1);
          router.push("/clientes");
        } 
      } catch(responseError) {
        message.value = "Verifique se todos os campos foram preenchidos ou tente outro e-mail";
        error.value = true;
        setInterval(function(){
          error.value = false;
        }, 5000);
      }
    }  
    
    return {
      cadastrar,
      name,
      email,
      password,
      error,
      message
    }
  }

 
})



</script>
