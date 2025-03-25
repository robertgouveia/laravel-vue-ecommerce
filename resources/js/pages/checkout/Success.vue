<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

const orderDetails = {
    orderId: '123456789',
    items: [
        { name: 'Product 1', quantity: 2, price: '£20.00', image: 'https://m.media-amazon.com/images/I/51oxjgxm4WL.jpg' },
        { name: 'Product 2', quantity: 1, price: '£15.00', image: 'https://m.media-amazon.com/images/I/51oxjgxm4WL.jpg' },
    ],
    total: '£55.00',
};
</script>

<template>
    <AppLayout title="Order Success">
        <div class="p-8 text-center">
            <h1 class="mb-4 text-3xl font-bold text-green-600">Payment Received</h1>
            <p class="text-lg">Thank you! Your payment has been successfully processed through Stripe.</p>
            <p class="mb-6 text-lg">
                Order ID: <span class="font-semibold">{{ orderDetails.orderId }}</span>
            </p>

            <div class="mb-6">
                <h2 class="mb-2 text-xl font-bold">Order Summary</h2>
                <ul class="space-y-6 border-b border-t py-4 text-left">
                    <li v-for="(item, index) in orderDetails.items" :key="index" class="flex items-center justify-between">
                        <img :src="item.image" alt="product image" class="h-16 w-16 rounded-md object-cover" />
                        <div class="ml-4 flex-grow">
                            <span class="font-semibold">{{ item.name }}</span>
                            <p class="text-sm text-gray-500">Quantity: {{ item.quantity }}</p>
                        </div>
                        <span class="font-semibold">{{ item.price }}</span>
                    </li>
                </ul>
                <div class="mt-4 flex justify-between text-lg font-semibold">
                    <span>Total:</span>
                    <span class="text-green-600">{{ orderDetails.total }}</span>
                </div>
            </div>

            <Link :href="route('home')" class="mt-6 rounded-md bg-green-500 px-4 py-3 text-white hover:bg-green-600">Go to My Orders</Link>
        </div>
    </AppLayout>
</template>
