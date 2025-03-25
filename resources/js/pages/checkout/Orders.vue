<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';

interface Order {
    id: number;
    user_id: number;
    amount: number;
    status: string;
}

const { orders } = defineProps<{ orders: Order[] }>();
</script>

<template>
    <AppLayout title="Orders">
        <h1 class="mb-4 text-2xl font-bold">Your Orders</h1>
        <div class="grid grid-cols-1 gap-4" v-if="orders.length > 0">
            <div v-for="order in orders" :key="order.id" class="rounded-lg border border-gray-300 p-4 shadow-md">
                <div class="mb-2 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold">Order #{{ order.id }}</h2>
                    </div>
                    <span
                        :class="{
                            'rounded-sm px-2 py-1 text-sm font-semibold': true,
                            'bg-green-500 text-white': order.status === 'paid',
                            'bg-blue-500 text-white': order.status === 'pending',
                            'bg-red-500 text-white': order.status === 'cancelled',
                        }"
                    >
                        {{ order.status }}
                    </span>
                </div>
                <hr class="my-2 border-gray-200" />
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Estimated Delivery: <span class="font-medium text-gray-800">3-5 days</span></p>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-bold text-gray-800">£{{ order.amount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
