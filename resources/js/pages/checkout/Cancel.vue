<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Payment Cancelled">
        <div class="flex mt-24 flex-col items-center justify-center space-y-4 text-center">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-16 w-16 text-red-500"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <h1 class="text-2xl font-bold">Payment Cancelled</h1>
            <p class="text-gray-600">Your payment has been cancelled.</p>
            <a href="/" class="mt-4 rounded bg-green-600 px-4 py-2 text-white hover:bg-green-700"> Go Back Home </a>
        </div>
    </AppLayout>
</template>
