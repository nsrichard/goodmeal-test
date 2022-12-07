import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useOrders() {
    const order = ref(null)
    const orders = ref([])

    const errors = ref('')
    const router = useRouter()

    const getOrders = async () => {
        let response = await axios.get('/api/order')
        orders.value = response.data.response.data
    }

    const getOrder = async (id) => {
        let response = await axios.get(`/api/order/${id}`)
        order.value = response.data.response.data
    }

    const addOrder = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/order/add', data)
            localStorage.setItem('cart', JSON.stringify([]));
            await router.push({ name: 'home' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }

    }

    return {
        errors,
        order,
        orders,
        getOrder,
        getOrders,
        addOrder
    }
}