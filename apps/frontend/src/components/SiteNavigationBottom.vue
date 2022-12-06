<template>
	<footer class="fixed left-0 bottom-0 right-0 bg-store-primary shadow-lg border-t-2">
		<nav class="container flex text-center py-6">
			<div class="w-1/3">
				<RouterLink :to="{ name: 'home' }">
					<i class="fa-solid fa-house text-xl cursor-pointer"></i>
				</RouterLink>
			</div>
			<div class="w-1/3">
				<RouterLink :to="{ name: 'home' }">
					<i class="fa-solid fa-list text-xl cursor-pointer"></i>
				</RouterLink>
			</div>
			<div class="w-1/3">
				<RouterLink :to="{ name: 'home' }">
					<i class="fa-solid fa-user text-xl cursor-pointer"></i>
				</RouterLink>
			</div>
		</nav>
	</footer>
</template>

<script setup>
import { RouterLink } from "vue-router";
</script>