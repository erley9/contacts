<template>

    <div class="bg-white mt-5 rounded overflow-hidden shadow-lg">

        <div class="px-6 py-4 min-h-[700px] ">

        <p class="font-bold text-[18px]">{{$t("listContacts.title")}}</p>

        <RouterLink to="/contact/register" class="mt-[15px] inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ $t("listContacts.btnRegister") }}
        </RouterLink>

        <table class="table mt-[15px] mb-[15px] border-collapse border-2 border-gray-500">
            <thead class="bg-gray-500 text-white">
              <tr>
                <th class="px-2 py-2">{{ $t("listContacts.name") }}</th>
                <th class="px-2 py-2">{{ $t("listContacts.email") }}</th>
                <th class="px-2 py-2">{{ $t("listContacts.telephone") }}</th>
                <th class="px-2 py-2">{{ $t("listContacts.postcode") }}</th>
                <th class="px-2 py-2">{{ $t("listContacts.address") }}</th>
                <th class="px-2 py-2">{{ $t("listContacts.number") }}</th>
                <th class="px-2 py-2">{{ $t("listContacts.neighbourhood") }}</th>
                <th class="px-2 py-2">{{ $t("listContacts.city") }}</th>
                <th class="px-2 py-2">{{ $t("listContacts.state") }}</th>
                <th class="px-2 py-2">{{ $t("listContacts.country") }}</th>
                <th class="px-2 py-2">{{ $t("listContacts.edit") }}</th>
                <th class="px-2 py-2">{{ $t("listContacts.delete") }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="contact in contacts" :key="contact.id">
                <td class="border px-2 py-2">{{contact.name}}</td>
                <td class="border px-2 py-2">{{contact.email}}</td>
                <td class="border px-2 py-2">{{contact.telephone}}</td>
                <td class="border px-2 py-2">{{contact.postcode}}</td>
                <td class="border px-2 py-2">{{contact.address}}</td>
                <td class="border px-2 py-2">{{contact.number}}</td>
                <td class="border px-2 py-2">{{contact.neighbourhood}}</td>
                <td class="border px-2 py-2">{{contact.city}}</td>
                <td class="border px-2 py-2">{{contact.state}}</td>
                <td class="border px-2 py-2">{{contact.country}}</td>
                <td class="border px-2 py-2 text-center">
                  <RouterLink  class="icone"  :to="'/contact/update/' + contact.id">
                    <font-awesome-icon icon="fa-solid fa-pen-to-square" />
                  </RouterLink>
                </td>
                <td class="border px-2 py-2 text-center cursor-pointer"  @click.prevent="remove(contact.id)">
                  <a>
                    <font-awesome-icon icon="fa-solid fa-trash" />
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
          
          <nav aria-label="Page navigation example">
            <ul class="inline-flex -space-x-px text-base h-10">
              <li 
                v-for="item in pagination"
                @click.prevent="changeUrl(item.url)"
              >
                <a 
                :class="{ 'text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white': item.active }"
                v-html="item.label"
                class="
                flex 
                items-center 
                justify-center 
                px-4 h-10 ml-0 
                leading-tight 
                text-gray-500 
                bg-white 
                border 
                border-gray-300 
                rounded-l-lg 
                hover:bg-gray-100 
                hover:text-gray-700 
                dark:bg-gray-800 
                dark:border-gray-700
                dark:text-gray-400 
                dark:hover:bg-gray-700 
                dark:hover:text-white"
                >
                </a>
              </li>
            </ul>
          </nav>

        </div>
    </div>

</template>

<script>

import {ref, defineComponent, computed} from 'vue';
import { useContacts } from '@/stores/contactsStore'
import { useRoute, useRouter} from 'vue-router'


export default defineComponent({
    name:"ListContactView",
    props:[],
    components: [
    ],
    setup(props) {
        const route = useRoute()
        const router = useRouter(); 
        const store = useContacts();
        const pagination = ref([]);

        const page = ref(route.query.page ?? 1);
        store.page=page;
        store.getContacts(page);

        const remove = function (id) {
          store.deleteContact(id);
          store.getContacts(page);
        }
        const changeUrl = function(url) {
          if (url) {   
            router.push("/contact"+url)
            page.value = url.replace("?page=","");
            store.getContacts(page.value);
          } 
        }

        return {
          contacts : computed(() => store.list) ,
          pagination : computed(() => store.pagination.links),
          remove,
          changeUrl
        }
    }

})


</script>