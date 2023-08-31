<template>
    <div>
        <!-- Modal Trigger Button -->


        <!-- Modal -->
        <div v-if="props.isModalOpen" class="fixed inset-0 flex items-center justify-center">
            <div class="bg-white rounded shadow-lg w-1/2 overflow-hidden">
                <div class="bg-slate-500 px-5 py-2">
                    <div class="flex items-end">
                        <div class="w-[75px] h-[50px] flex justify-center align-middle p-1 object-contain">
                            <img v-bind:src="props.countryDetail.flags.png" class="w-full h-full">
                        </div>
                        <div>
                            <h2 class="text-lg font-bold mb-4">
                                {{ props.countryDetail.name.official }}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 p-8">
                    <div>
                        <p class="py-1">2 character Country Code</p>
                        <p class="py-1">3 character Country Code</p>
                        <p class="py-1">Native Country Name</p>
                        <p class="py-1">Alternative Country Name</p>
                        <p class="py-1">Country Calling Codes</p>
                        <p class="py-1">Capital</p>
                        <p class="py-1">currencies</p>
                        <p class="py-1">Languages</p>
                    </div>
                    <div class="col-span-2">
                        <p class="py-1">: {{ props.countryDetail.cca2 }}</p>
                        <p class="py-1">: {{ props.countryDetail.cca3 }}</p>
                        <p class="truncate hover:text-clip py-1">:
                            <span v-for="(value, key, index) in props.countryDetail.languages">
                                {{ props.countryDetail.name.nativeName[key]?.official}}
                                <span v-if=" props.countryDetail.name.nativeName[key] && props.countryDetail.languages && (index < Object.keys(props.countryDetail.languages).length - 1)">
                                    ,
                                </span>
                            </span>
                        </p>
                        <p class="truncate hover:text-clip py-1">: {{ props.countryDetail.altSpellings.join(" , ") }}</p>
                        <p class="truncate hover:text-clip py-1">:
                            <span v-if="props.countryDetail.idd.root && props.countryDetail.idd.suffixes">{{
                                props.countryDetail.idd.root + '-' + props.countryDetail.idd.suffixes }}
                            </span>
                        </p>
                        <p class="truncate hover:text-clip py-1">: {{ props.countryDetail.capital.join(" , ") }}</p>
                        <p class="truncate hover:text-clip py-1">:
                            <span v-for="(value, key, index) in props.countryDetail.currencies">
                                {{ props.countryDetail.currencies[key]?.name}}({{ props.countryDetail.currencies[key]?.symbol}})
                                <span v-if="props.countryDetail.currencies && (index < Object.keys(props.countryDetail.currencies).length - 1)">
                                    ,
                                </span>
                            </span>
                        </p>
                        <p class="truncate hover:text-clip py-1">:
                            <span v-for="(value, key, index) in props.countryDetail.languages">
                                {{ props.countryDetail.languages[key]}}
                                <span v-if="props.countryDetail.languages && (index < Object.keys(props.countryDetail.languages).length - 1)">
                                    ,
                                </span>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="px-5 py-4 flex justify-end">
                    <button @click="$emit('closeModalEvent')"
                        class="mt-4 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import { defineProps } from 'vue';
const props = defineProps(['isModalOpen', 'countryDetail'])

</script>