<template>
  <div class="flex flex-col justify-center w-20 mt-5 ml-10">
  <label for="" class="font-mono text-white">{{ $t("selectLanguage.label") }}:</label>
  <select 
    @change="setLocation" 
    class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  
    v-model="selectedLocale"
    >
    <option value="pt">{{ $t("selectLanguage.optionDefault") }}</option>
    <option 
    v-for="(lang, i) in langs"
    :key="`Lang${i}`"
    :value="lang[0]"
    >
    {{lang[1]}}
    </option>
  </select>
</div>

</template>

<script>
import { ref,defineComponent,watch } from "vue";
import { useI18n } from "vue-i18n";

export default defineComponent({
  "name": "SelectLanguage",
  setup(props) {
    const langs = ref([
      ["pt","pt-br"],
      ["en","en-us"]
    ]);

    const i18n = useI18n()

    const selectedLocale = ref(i18n.locale.value)

    const setLocation = () => {
      i18n.locale.value = selectedLocale.value
    }

    return {
      langs,
      selectedLocale,
      setLocation
    }
  }
})
</script>