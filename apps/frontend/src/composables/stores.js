import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useStores() {
    const store = ref([])
    const stores = ref([])

    const errors = ref('')
    const router = useRouter()

    const getStores = async () => {
        let response = await axios.get('/api/store')
        stores.value = response.data.response.data
    }

    const getStore = async (id) => {
        let response = await axios.get(`/api/store/${id}`)
        store.value = response.data.data
    }

    const addStore = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/store', data)
            //await router.push({ name: 'store.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }

    }

    const updateStore = async (id) => {
        errors.value = ''
        try {
            await axios.patch(`/api/store/${id}`, store.value)
            await router.push({ name: 'store.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value = e.response.data.errors
                }
            }
        }
    }

    const destroyStore = async (id) => {
        await axios.delete('/api/store/' + id)
    }

    return {
        errors,
        store,
        stores,
        getStore,
        getStores,
        addStore,
        updateStore
    }
}