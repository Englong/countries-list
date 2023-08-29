<template>
    <div class="container">
        <div class="flex justify-between mx-5 my-5">
            <h1 class="font-bold">Countries</h1>
            <div class="flex items-center">
                <input type="text" name="query" placeholder="Search..."
                    class="px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                <button type="submit"
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
                    <tr v-for="country in countries">
                        <td class="border border-slate-700">
                            <div class="w-[75px] h-[50px] flex justify-center align-middle p-1 object-contain">
                                <img v-bind:src="country.flags.png" class="w-full h-full">
                            </div>
                        </td>
                        <td class="border border-slate-700">{{ country.name.official }}</td>
                        <td class="border border-slate-700">{{ country.cca2 }}</td>
                        <td class="border border-slate-700">{{ country.cca3 }}</td>
                        <td class="border border-slate-700">{{ country.name.nativeName.eng?.official }}</td>
                        <td class="border border-slate-700">{{ country.altSpellings }}</td>
                        <td class="border border-slate-700">{{ country.idd }}</td>
                        
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
const countries = ref({});
onMounted(() => {
    axios
        .get('https://restcountries.com/v3.1/independent?status=true')
        .then(response => {
            console.log(response.data)
            countries.value = response.data
        });
}) 
</script>