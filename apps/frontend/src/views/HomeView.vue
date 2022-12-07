<template>
	<main class="container">
		
		<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
			<ul class="flex flex-wrap -mb-px">
				<li class="mr-2">
					<a href="#" class="inline-block p-4 text-store-secondary rounded-t-lg border-b-2 border-store-secondary active" aria-current="page">Con stock</a>
				</li>
				<li class="mr-2">
					<a href="#" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Sin stock</a>
				</li>
				<li class="mr-2">
					<a href="#" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Favoritos</a>
				</li>
			</ul>
		</div>

		<div class="pt-4">
			<article v-for="item in stores" :key="item.id" class="mb-4">
				<div class="bg-white relative shadow rounded-lg mx-auto">
					<div :style="styleBackground(item.banner)" class="p-4 rounded-tl-lg rounded-tr-lg">
						<div class="my-2">
							<span class="text-md text-white font-medium bg-store-secondary py-1 px-3 rounded-lg">Hoy de {{ timeFormat(item.Opening.open) }} - {{ item.Opening.close }}</span>
						</div>
						<div class="my-2">
							<span class="text-sm text-store-secondary bg-pink-200 font-medium py-1 px-3 rounded-lg">{{ timeFormat(item.ServiceName) }}</span>
						</div>
					</div>
					<div class="flex justify-center relative">
						<img :src="item.logo" alt="" class="rounded-full mx-auto absolute -top-8 right-8 w-16 h-16 shadow-md">
					</div>
					<div class="p-2">
						<h3 class="font-bold text-2md text-gray-900">{{ item.name }}</h3>
						<p class="text-sm text-gray-400 font-medium">
							<span class="text-sm text-store-secondary font-bold">Desde ${{ item.FromPrice }}</span>
							<del class="text-sm text-gray-300 font-bold ml-3">${{ item.FromOldPrice }}</del>
						</p>
						<div class="flex">
							<div class="w-1/4">
								<i class="fa-solid fa-person-walking"></i>
								<span class="text-xs ml-2">{{ timeArrival() }}</span>
							</div>
							<div class="w-1/4">
								<i class="fa-sharp fa-solid fa-location-dot"></i>
								<span class="text-xs ml-2">{{ item.Distance }} km</span>
							</div>
							<div class="w-2/4 text-right">
								<span class="font-bold text-md mr-2">{{ ( item.TotalProducts > 10) ? '10+' : item.TotalProducts}}</span>
								<i class="fa-solid fa-bag-shopping"></i>
							</div>
						</div>
					</div>
				</div>
			</article>
		</div>

	</main>
</template>

<script setup>
import useStores from "@/composables/stores";
import { computed } from "@vue/reactivity";
import { onMounted } from "vue";
import moment from 'moment';

const { stores, getStores } = useStores()
onMounted(getStores)

const styleBackground = computed(() =>{
	return url => 'background:url(' + url + ') no-repeat center center; background-size: cover;';
})

let timeArrival = () => {
	// can be calculated based on distance
	return Math.ceil(Math.random(1, 40) * 100) + ' Min.';
}
let timeFormat = (value)  => {
    return moment('2000-01-01 ' + value).format('HH:mm');
}
</script>