<template>
	<header class="sticky top-0 bg-store-primary shadow-lg z-50">
		<nav class="container flex text-black gap-4 py-6">
			<RouterLink :to="{ name: 'home' }">
				<div class="flex gap-3">
					<p class="text-2xl ">Goodmeal</p>
				</div>
			</RouterLink>
			<div class="flex gap-3 flex-1 justify-end text-store-secondary">
				<i class="fa-solid fa-bars text-xl cursor-pointer"></i>
			</div>
		</nav>
	</header>
</template>

<script setup>
import { RouterLink } from "vue-router";
</script>