<template>
    <div class="container">
        <div class="flex justify-between mx-5 my-5">
            <h1 class="font-bold">Countries</h1>
            <div class="flex items-center">
                <input type="text" v-model="search" placeholder="Search..."
                    class="px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                <button type="button" @click="listCountry"
                    class="px-4 py-2 bg-blue-500 text-white rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Search
                </button>
            </div>
        </div>
        <div class="mx-5 my-5">
            <table class="border-collapse border border-slate-500 w-full">
                <thead>
                    <tr>
                        <th class="border border-slate-600">Flags</th>
                        <th class="border border-slate-600">Country Name</th>
                        <th class="border border-slate-600">2 character Country Code</th>
                        <th class="border border-slate-600">3 character Country Code</th>
                        <th class="border border-slate-600">Native Country Name</th>
                        <th class="border border-slate-600">Alternative Country Name</th>
                        <th class="border border-slate-600">Country Calling Codes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="countries.data" v-for="country in countries.data">
                        <td class="border border-slate-700">
                            <div class="w-[75px] h-[50px] flex justify-center align-middle p-1 object-contain">
                                <img v-bind:src="country.flags.png" class="w-full h-full">
                            </div>
                        </td>
                        <td class="border border-slate-700">{{ country.name.official }}</td>
                        <td class="border border-slate-700">{{ country.cca2 }}</td>
                        <td class="border border-slate-700">{{ country.cca3 }}</td>
                        <td class="border border-slate-700">{{ country.name.nativeName }}</td>
                        <td class="border border-slate-700">{{ country.altSpellings }}</td>
                        <td class="border border-slate-700">{{ country.idd }}</td>

                    </tr>
                    <tr v-else><td colspan="7" class="text-center"><div class="my-2">Loading ...</div></td></tr>
                </tbody>
            </table>
            <nav class="flex justify-end mt-5">
                <ul class="flex">
                    <li class=" px-1">
                        <a v-if="countries.current_page != 1" style="cursor: pointer"
                            :style="countries.current_page == 1 ? 'background-color:#1249e3 !important;cursor: not-allowed !important' : 'cursor:pointer;background-color:gray'"
                            @click="listCountry(countries.current_page - 1)"
                            class="text-white w-24 h-8 flex justify-center items-center">Previous</a>
                        <a v-else style="cursor:not-allowed;background-color:gray"
                            class="text-white w-24 h-8 flex justify-center items-center">Previous</a>
                    </li>
                    <li class="px-1" v-for="pageNo in totalPages">
                        <a @click="listCountry(pageNo)" class="text-white" v-if="totalPages < 3" style="cursor: pointer">
                            <div class="w-8 h-8 flex justify-center items-center"
                                :style="pageNo == countries.current_page ? 'background-color:#12499c !important;color:white' : 'background-color:gray'">
                                {{ pageNo }}</div>
                        </a>
                        <a @click="listCountry(pageNo)" class="text-white"
                            v-if="totalPages > 3 && ((pageNo <= totalPages) && (pageNo > totalPages - 2))"
                            style="cursor: pointer">
                            <div class="w-8 h-8 flex justify-center items-center"
                                :style="pageNo == countries.current_page ? 'background-color:#12499c !important;color:white' : 'background-color:gray'">
                                {{ pageNo }}</div>
                        </a>
                        <a v-if="pageNo == 3">...</a><!--show when click next page pageNo equal 3 s-->
                        <a @click="listCountry(pageNo)" class="text-white"
                            v-if="pageNo == countries.current_page && totalPages > 2 && (pageNo < totalPages - 1 && pageNo > 2)">
                            <div class="w-8 h-8 flex justify-center items-center"
                                :style="pageNo == countries.current_page ? 'background-color:#12499c !important;color:white' : 'background-color:gray'">
                                {{ pageNo }}</div>
                        </a>
                        <a class="text-white" v-if="pageNo == countries.current_page && totalPages > 2 && (pageNo < totalPages - 2 && pageNo > 2)">...</a><!--show when click next page pageNo equal 3-->
                       
                        <a @click="listCountry(pageNo)" class="text-white" v-if="totalPages > 3 && pageNo < 3"
                            style="cursor: pointer">
                            <div class="w-8 h-8 flex justify-center items-center"
                                :style="pageNo == countries.current_page ? 'background-color:#12499c !important;color:white' : 'background-color:gray'">
                                {{ pageNo }}</div>
                        </a>
                    </li>
                    <li class="px-1">
                        <a v-if="countries.current_page != totalPages" style="cursor: pointer"
                            @click="listCountry(countries.current_page + 1)" class="text-white">
                            <div :style="countries.current_page && pageNo == totalPages ? 'background-color:#12499c !important;cursor: not-allowed !important;pointer-events: none;' : 'cursor:pointer;background-color:gray'"
                                class="w-16 h-8 flex justify-center items-center">Next</div>
                        </a>
                        <a v-else style="cursor:not-allowed;" class="text-white">
                            <div style="background-color:gray" class="w-16 h-8 flex justify-center items-center">Next</div>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
const countries = ref({});
const search = ref();
const totalPages = ref();
const isLoading=ref(false);
onMounted(() => {
    listCountry(1);
})

function listCountry(pageNo = 1) {
    countries.value={};
    isLoading.value=true;
    axios
        .get('/countries',
            {
                params:
                {
                    page: pageNo,
                    search: search.value,
                    orderDirection: 'DESC',
                }
            })
        .then(response => {
            countries.value = response.data
            totalPages.value = response.data.last_page
        }).finally(res=>{
            isLoading.value=false
        });
}
</script>