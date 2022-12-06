<template>
	<div class="flex flex-col min-h-screen font-Roboto bg-store-primary">
		<SiteNavigation />
		<RouterView />
		<SiteNavigationBottom />
	</div>
</template>

<script setup>
import { RouterView } from "vue-router";
import SiteNavigation from "./components/SiteNavigation.vue";
import SiteNavigationBottom from "./components/SiteNavigationBottom.vue";
</script>

<style lang="scss" scoped></style>