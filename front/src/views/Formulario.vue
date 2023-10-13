<template>
  <alert-danger v-if="error" titulo="Atenção" :message="message" />   
  <div class="flex justify-center items-center">

    <div class="w-full max-w-2xl mt-10">

      <form  @submit.prevent="register" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

        <h2 
          class="text-gray-700 text-[18px] text-sm font-bold mb-4 underline underline-offset-8"
          v-if="update"
        >
          {{$t("contactRegister.h2Update")}}  
        </h2>


        <h2 
          class="text-gray-700 text-[18px] text-sm font-bold mb-4 underline underline-offset-8"
          v-else
        >
          {{$t("contactRegister.h2Create")}}
        </h2>


        <div class="mb-4">
          <label 
            class="block text-gray-700 text-sm font-bold mb-2" 
            required 
          >
          {{ $t("contactRegister.inputName") }}
          </label>

          <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="inputRegisterName" 
            type="text" 
            :placeholder="$t('contactRegister.inputName')"
            name="name"
            v-model="name"
            required
          >
        </div>
        
        <div class="mb-4">
          <label 
            class="block text-gray-700 text-sm font-bold mb-2" 
            required 
          >
          {{ $t("contactRegister.inputEmail") }}
          </label>

          <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="inputRegisterEmail" 
            type="text" 
            :placeholder="$t('contactRegister.inputEmail')"
            name="email"
            v-model="email"
            required
          >
        </div>

        <div class="mb-4">
          <label 
            class="block text-gray-700 text-sm font-bold mb-2" 
            required 
          >
          {{ $t("contactRegister.inputTelephone") }}
          </label>

          <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="inputRegisterTelephone" 
            type="text" 
            :placeholder="$t('contactRegister.inputTelephone')"
            name="telephone"
            v-model="telephone"
            required
          >
        </div>

        <div class="mb-4">
          <label 
            class="block text-gray-700 text-sm font-bold mb-2" 
            required
          >
          {{ $t("contactRegister.inputPostCode") }}
          </label>

          <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="inputRegisterPostCode" 
            type="text" 
            :placeholder="$t('contactRegister.inputPostCode')"
            name="postcode"
            v-model="postcode"
            required
            @keyup="getAddressCep"
          >
        </div>

        <div class="mb-4">
          <label 
            class="block text-gray-700 text-sm font-bold mb-2" 
            required
          >
          {{ $t("contactRegister.inputAddress") }}
          </label>

          <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="inputRegisterAddress" 
            type="text" 
            :placeholder="$t('contactRegister.inputAddress')"
            name="address"
            v-model="address"
            required
          >
        </div>

        <div class="mb-4">
          <label 
            class="block text-gray-700 text-sm font-bold mb-2" 
            required
          >
          {{ $t("contactRegister.inputNumber") }}
          </label>

          <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="inputRegisterAddress" 
            type="text" 
            :placeholder="$t('contactRegister.inputNumber')"
            name="number"
            v-model="number"
            required
          >
        </div>

        <div class="mb-4">
          <label 
            class="block text-gray-700 text-sm font-bold mb-2" 
            required
          >
          {{ $t("contactRegister.inputNeighbourhood") }}
          </label>

          <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="inputRegisterNeighbourhood" 
            type="text" 
            :placeholder="$t('contactRegister.inputNeighbourhood')"
            name="neighbourhood"
            v-model="neighbourhood"
            required
          >
        </div>

        <div class="mb-4">
          <label 
            class="block text-gray-700 text-sm font-bold mb-2" 
            required
          >
          {{ $t("contactRegister.inputCity") }}
          </label>

          <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="inputRegisterCity" 
            type="text" 
            :placeholder="$t('contactRegister.inputCity')"
            name="city"
            v-model="city"
            required
          >
        </div>

        <div class="mb-4">
          <label 
            class="block text-gray-700 text-sm font-bold mb-2" 
            required
          >
          {{ $t("contactRegister.inputState") }}
          </label>

          <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="inputRegisterState" 
            type="text" 
            :placeholder="$t('contactRegister.inputState')"
            name="state"
            v-model="state"
            required
          >
        </div>

        <div class="mb-4">
          <label 
            class="block text-gray-700 text-sm font-bold mb-2" 
            required
          >
          {{ $t("contactRegister.inputCountry") }}
          </label>

          <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="inputRegisterCountry" 
            type="text" 
            :placeholder="$t('contactRegister.inputCountry')"
            name="country"
            v-model="country"
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
import ContactDataService from '../services/ContactDataService';

export default defineComponent({
  name:"register",
  components:{
    AlertDanger
  },
  props:[
    "id"
  ]
  ,
  setup (props){    
    const title = ref("")
    const name = ref("")
    const email = ref("")
    const telephone = ref("")
    const postcode = ref("")
    const address = ref("")
    const number = ref("")
    const neighbourhood = ref("")
    const city = ref("")
    const state = ref("")
    const country = ref("")

    const error = ref(false)
    const router = useRouter()
    const store = useContacts()
    const message = ref("");

    const update = ref(false);

    if (props.id) {
      update.value = true;
      
      ContactDataService.get(props.id).then(function(contact){
          name.value = contact.data.data?.name || "";
          email.value = contact.data.data?.email || "";
          telephone.value = contact.data.data?.telephone || "";
          postcode.value = contact.data.data?.postcode || "";
          address.value = contact.data.data?.address || "";
          neighbourhood.value = contact.data.data?.neighbourhood || "";
          number.value = contact.data.data?.number || "";
          city.value = contact.data.data?.city || "";
          state.value = contact.data.data?.state || "";
          country.value = contact.data.data?.country || "";
        });
      
    }

    const register = async function (){

      let data = {
          "name":name.value,
          "email":email.value,
          "telephone": telephone.value.replace(/[^0-9]/g, ''),
          "postcode": postcode.value.replace(/[^0-9]/g, ''),
          "address" : address.value,
          "neighbourhood": neighbourhood.value,
          "number":number.value,
          "city":city.value,
          "state":state.value,
          "country":country.value
      }

      if (props.id) {
        store.updateContact(data,props.id)
          .then(
            successRequest,
            errorRequest  
          );
      } else {
        store.saveContact(data)
          .then(
            successRequest,
            errorRequest  
          );
      }
    }

    const successRequest  = function() {
      router.push("/contact")
    }

    const errorRequest = function (responseError) {
      error.value = true;
      mensagem.value = responseError.response.data.message;
      setInterval(function(){
          error.value = false;
      }, 4000);
    }

    const getAddressCep = async function () {

      console.log("entrou aqui", postcode.value.length);

      const cepClean = postcode.value.replace(/[^0-9]/g, '');

      if(cepClean.length >= 8) {

        const url = "https://viacep.com.br/ws/"+cepClean+"/json/";

        try {
          const response = await fetch(url);
          const dataCep = await response.json();

          address.value = dataCep.logradouro;
          neighbourhood.value = dataCep.bairro;
          city.value = dataCep.localidade;
          state.value = dataCep.uf;

        } catch (error) {
          console.error(`error: ${error.message}`);
        }

      } 
        
    }
    
    return {
      register,
      title,
      name,
      email,
      telephone,
      postcode,
      address,
      number,
      neighbourhood,
      city,
      state,
      country,
      error,
      message,
      update,
      getAddressCep
    }
  }

 
})
</script>
