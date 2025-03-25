<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { computed } from 'vue';
import { useCartStore } from '@/stores/cart';
import axios from 'axios';

const cart = useCartStore();
const cartItems = computed(() => cart.getProducts());
const totalPrice = computed(() => cartItems.value.reduce((sum, item) => sum + item.price * item.quantity, 0));

const submit = async () => {
    const response = await axios.post('/order', { total: totalPrice.value });
    window.location.href = response.data;
    cart.clearCart();
};
</script>

<template>
    <AppLayout title="Checkout">
        <h1 class="mb-4 text-2xl font-bold text-gray-800">Checkout</h1>
        <div>
            <div v-for="item in cartItems" :key="item.id" class="mb-4 flex items-center border-b pb-4 last:border-b-0">
                <img src="https://m.media-amazon.com/images/I/51oxjgxm4WL.jpg" alt="Item image" class="h-20 w-20 rounded object-cover" />
                <div class="ml-4 flex-grow">
                    <h2 class="text-lg font-semibold text-gray-800">{{ item.name }}</h2>
                    <p class="text-sm text-gray-600">Price: £{{ item.price }}</p>
                    <p class="text-sm text-gray-600">Quantity: {{ item.quantity }}</p>
                    <p class="mt-2 text-sm font-semibold text-gray-800">Subtotal: £{{ item.price * item.quantity }}</p>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-between">
                <p class="text-lg font-semibold text-gray-800"><strong>Total Price: </strong>£{{ totalPrice }}</p>
                <form @submit.prevent="submit">
                    <button type="submit" class="rounded-md bg-green-500 px-6 py-2 text-white transition hover:bg-green-600">Go to Payment</button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
