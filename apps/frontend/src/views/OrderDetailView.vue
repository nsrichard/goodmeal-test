<template>
	<main class="container">

		<div class="py-5">
			<div class="mb-4 bg-white border border-gray-200 rounded-lg shadow-md relative">
				<label class="absolute bg-teal-500 text-white top-0 right-6 py-1 px-6 rounded-br-lg rounded-bl-lg">Rescatada</label>
				<div class="p-6">
					<h3 class="pb-3 text-teal-500 font-bold">{{ dateFormat(order.created_at) }}</h3>
					<p class="mb-2 font-normal text-gray-700">
						<strong>Tienda: </strong> {{ order.store.name }}
					</p>
					<p class="mb-2 font-normal text-gray-700">
						<strong>Nro de órden: </strong> {{ order.id }}
					</p>
					<p class="mb-2 font-normal text-gray-700">
						<strong>Monto total: </strong> ${{ order.total }}
					</p>
					<p class="mb-2 font-normal text-gray-700">
						<strong>Horario: </strong> {{ timeFormat(order.store.Opening.open) }} - {{ timeFormat(order.store.Opening.close) }}
					</p>
					<hr class="my-2">
					<h4 class="font-semibold my-3">Productos</h4>
					<table class="block">
						<tr v-for="product in order.detail" :key="product.id" class="flex">
							<td class="w-1/5">{{ product.quantity }}</td>
							<td class="w-3/5">{{ product.product.name }}</td>
							<td class="w-1/5 text-right">${{ product.total }}</td>
						</tr>
					</table>
					<hr class="my-2">
					<table class="block">
						<tr class="flex">
							<td class="w-2/5">Delivery</td>
							<td class="w-3/5 text-right">${{ order.delivery }}</td>
						</tr>
						<tr class="flex font-semibold">
							<td class="w-2/5">Monto total</td>
							<td class="w-3/5 text-right">${{ order.total }}</td>
						</tr>
					</table>	
				</div>
			</div>
		</div>

	</main>
</template>

<script setup>
import useOrders from "@/composables/orders";
import { onMounted } from "vue";
import moment from 'moment';

const { errors, order, getOrder } = useOrders()

const props = defineProps({
    id: {
        required: true,
        type: String
    }
})
onMounted(getOrder(props.id))

let dateFormat = (value)  => {
    return moment(value).format('DD/MM/YYYY');
}

let timeFormat = (value)  => {
    return moment('2000-01-01 ' + value).format('HH:mm');
}

</script>