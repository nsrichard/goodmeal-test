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
</template>

<script setup>
import { RouterLink } from "vue-router";
</script>