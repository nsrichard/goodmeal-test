<template>
	<main class="container">

		<div v-if="errors">
			<div v-for="(v, k) in errors" :key="k" class="bg-red-400 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
				<p v-for="error in v" :key="error" class="text-sm">
					{{ error }}
				</p>
			</div>
		</div>
		
		<article class="my-4">
			<div class="bg-white relative mx-auto">
				<div :style="styleBackground(store.banner)" class="p-4 h-24">
				</div>
				<div class="flex justify-center relative">
					<img :src="store.logo" alt="" class="rounded-full mx-auto absolute -top-8 right-8 w-16 h-16 shadow-md">
				</div>
				<div class="p-2">
					<h3 class="font-bold text-2md text-gray-900">{{ store.name }}</h3>
					<p class="text-sm font-medium py-3">
						<i class="fa-sharp fa-solid fa-location-dot text-black"></i>
						<span class="text-md text-pink-500 underline font-medium px-2 rounded-lg">Av. Marathon, Macul, Región Metropolitana, Chile</span>
					</p>
					<p class="text-sm font-medium">
						<i class="fa-solid fa-clock text-black"></i>
						<span class="text-md text-black font-medium py-1 px-2 rounded-lg">Horario de retiro {{ timeFormat(store.Opening.open) }} - {{ timeFormat(store.Opening.close) }}</span>
					</p>
					<div class="flex">
						
					</div>
				</div>
			</div>

			<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
				<ul class="flex flex-nowrap -mb-px">
					<li class="mr-2">
						<a href="#" class="inline-block p-4 text-store-secondary rounded-t-lg border-b-2 border-store-secondary active" aria-current="page">Ver todo</a>
					</li>
					<li class="mr-2" v-for="item in store.products.slice(0, 3)" :key="item.category_id">
						<a href="#" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">{{ item.category.name }}</a>
					</li>
				</ul>
			</div>

			<div class="py-5">
				<div class="grid grid-cols-3 gap-4">
					<div v-for="product in store.products" :key="product.id">
						<div class="p-4 rounded-lg shadow-lg relative">
							<button @click="addCart(product)" class="absolute text-xs top-2 right-2 w-6 h-6 rounded-full bg-white border-2 border-store-secondary text-store-secondary">
								<i class="fa-sharp fa-solid fa-plus"></i>
							</button>
							<img :src="product.image" class="w-4/5 block m-auto" />
							<p class="text-sm text-gray-400 font-medium text-center my-2">
								<span class="text-sm text-store-secondary font-bold">${{ product.price - (product.price * product.discount / 100)  }}</span>
								<del class="text-sm text-gray-300 font-bold ml-3">${{ product.price }}</del>
							</p>
							<div class="my-2 text-center">
								<span class="text-sm text-white bg-green-500 font-medium py-1 px-3 rounded-lg">😄 {{ product.discount }}% Dcto.</span>
							</div>
							<p class="text-gray-400 text-sm">
								{{ product.description.substr(0, 24) + "\u2026" }}
							</p>
						</div>
					</div>
				</div>
			</div>
			
		</article>

	</main>
</template>

<script setup>
import useStores from "@/composables/stores";
import { computed } from "@vue/reactivity";
import { onMounted } from "vue";
import moment from 'moment';

const { errors, store, getStore } = useStores()
const props = defineProps({
    id: {
        required: true,
        type: String
    }
})
onMounted(getStore(props.id))

const styleBackground = computed(() => {
	return url => 'background:url(' + url + ') no-repeat center center; background-size: cover;';
})

let timeFormat = (value)  => {
    return moment('2000-01-01 ' + value).format('HH:mm');
}

const addCart = (product) => {
	if (localStorage.getItem('cart') == null){
		localStorage.setItem('cart', JSON.stringify([]));
	}
	let cart = JSON.parse(localStorage.getItem('cart'));
	cart.push(product);
	localStorage.setItem('cart', JSON.stringify(cart));
}

</script>