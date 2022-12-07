<template>
	<main class="container">
		
		<div class="shadow-sm overflow-hidden my-8">
			<table class="border-collapse table-auto w-full text-sm">
				<thead>
					<tr>
						<th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left"></th>
						<th class="border-b dark:border-slate-600 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Producto</th>
						<th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Precio</th>
					</tr>
				</thead>
				<tbody class="bg-white dark:bg-slate-800">
					<tr v-for="product in cart" :key="product.id">
						<td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">x1</td>
						<td class="border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">{{ product.name }}</td>
						<td class="border-b border-slate-100 dark:border-slate-700 p-4 pr-8 text-slate-500 dark:text-slate-400">${{ product.price - (product.price * product.discount / 100) }}</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left"></th>
						<th class="border-b dark:border-slate-600 font-medium p-4 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">Total</th>
						<th class="border-b dark:border-slate-600 font-medium p-4 pr-8 pt-3 pb-3 text-slate-400 dark:text-slate-200 text-left">${{ getTotal() }}</th>
					</tr>
				</tfoot>
			</table>
		</div>

		<div class="flex">
			<a href="#" @click="confirmOrder" class="w-full items-center px-3 py-2 text-sm font-medium text-center text-white bg-store-secondary rounded-lg hover:bg-pink-400 ">
				Confirmar pedido <i class="fa-solid fa-cart-shopping"></i>
			</a>
		</div>

	</main>
</template>

<script setup>
import useOrders from "@/composables/orders";
import { computed } from "@vue/reactivity";
import { onMounted } from "vue";
import moment from 'moment';

if (localStorage.getItem('cart') == null){
	localStorage.setItem('cart', JSON.stringify([]));
}
let cart = JSON.parse(localStorage.getItem('cart'));

const { addOrder } = useOrders()

const confirmOrder = async () => {
    await addOrder(cart)
}

let getTotal = () => {
	return cart.reduce(function(prev, current) {
		return prev + (current.price - (current.price * current.discount / 100));
	}, 0);
}

</script>