<template>
	<footer class="fixed left-0 bottom-0 right-0 bg-store-primary shadow-lg border-t-2">
		<nav class="container flex text-center py-3">
			<div class="w-1/3">
				<RouterLink :to="{ name: 'home' }">
					<i class="fa-solid fa-house text-xl cursor-pointer"></i>
					<span class="text-xs block">Inicio</span>
				</RouterLink>
			</div>
			<div class="w-1/3">
				<RouterLink :to="{ name: 'home' }">
					<i class="fa-solid fa-clipboard-list text-xl cursor-pointer"></i>
					<span class="text-xs block">Órdenes</span>
				</RouterLink>
			</div>
			<div class="w-1/3">
				<RouterLink :to="{ name: 'home' }">
					<i class="fa-solid fa-user text-xl cursor-pointer"></i>
					<span class="text-xs block">Perfil</span>
				</RouterLink>
			</div>
		</nav>
	</footer>

	<div class="fixed bottom-20 right-5">
		<RouterLink :to="{ name: 'cart' }">
			<button class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-500 rounded-lg hover:bg-orange-400 ">
				Carrito <i class="fa-solid fa-cart-shopping"></i>
			</button>
		</RouterLink>
	</div>
</template>

<script setup>
import { RouterLink } from "vue-router";
</script>