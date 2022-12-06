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
			<article v-for="item in itemsResults" :key="item.index" class="mb-4">
				<div class="bg-white relative shadow rounded-lg mx-auto">
					<div class="bg-[url('https://dummyimage.com/600x200/c7c7c7/000000.jpg')] bg-cover p-4 rounded-tl-lg rounded-tr-lg">
						<div class="my-2">
							<span class="text-md text-white font-medium bg-store-secondary py-1 px-3 rounded-lg">Hoy de 09:00 - 12:00</span>
						</div>
						<div class="my-2">
							<span class="text-sm text-store-secondary bg-pink-200 font-medium py-1 px-3 rounded-lg">Retiro en local</span>
						</div>
					</div>
					<div class="flex justify-center relative">
						<img src="https://avatars0.githubusercontent.com/u/35900628?v=4" alt="" class="rounded-full mx-auto absolute -top-8 right-8 w-16 h-16 shadow-md">
					</div>
					<div class="p-2">
						<h3 class="font-bold text-2md text-gray-900">Pantazi Software</h3>
						<p class="text-sm text-gray-400 font-medium">
							<span class="text-sm text-store-secondary font-medium font-bold">Desde $5.000</span>
							<del class="text-sm text-gray-300 font-medium font-bold ml-3">$5.000</del>
						</p>
						<div class="flex">
							<div class="w-1/4">
								<i class="fa-solid fa-person-walking"></i>
								<span class="text-xs ml-2">11 min</span>
							</div>
							<div class="w-1/4">
								<i class="fa-sharp fa-solid fa-location-dot"></i>
								<span class="text-xs ml-2">0.5 km</span>
							</div>
							<div class="w-2/4 text-right">
								<span class="font-bold text-md mr-2">5</span>
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
import { ref } from "vue";

const itemsResults = ref(null);

itemsResults.value = [0, 1, 2, 3];

</script>