<template>
	<main class="container">

		<div class="py-5">
			<div v-for="order in orders" :key="order.id">
				<RouterLink :to="{ name: 'order', params: { id: order.id } }">
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
						</div>
					</div>
				</RouterLink>
			</div>
		</div>

	</main>
</template>

<script setup>
import useOrders from "@/composables/orders";
import { onMounted } from "vue";
import moment from 'moment';

const { errors, orders, getOrders } = useOrders()

onMounted(getOrders())

let dateFormat = (value)  => {
    return moment(value).format('DD/MM/YYYY');
}

let timeFormat = (value)  => {
    return moment('2000-01-01 ' + value).format('HH:mm');
}

</script>