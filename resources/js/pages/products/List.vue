<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { usePage } from '@inertiajs/vue3'
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardTitle,
} from '@/components/ui/card'
import { CartProduct, useCartStore } from '@/stores/cart';

const products: {
    id: number,
    name: string,
    description: string,
    stock: number,
    quantity?: number,
    price: number
}[] = (usePage().props.products as any) ?? [];

const cart = useCartStore();

const addProduct = (product: CartProduct) => cart.addProduct({ ...product, quantity: 1 });
</script>

<template>
    <AppLayout title="Store">
        <div class="grid grid-cols-3 gap-4">
            <div v-for="product in products" :key="product.name" class="w-full">
                <Card class="border rounded-lg shadow-lg flex flex-col h-full">
                    <CardContent class="flex-grow p-4">
                        <img src="https://m.media-amazon.com/images/I/51oxjgxm4WL.jpg" alt="Product Image"
                            class="w-full h-48 object-cover mb-4">
                        <div>
                            <CardTitle class="text-xl font-semibold">{{ product.name }}</CardTitle>
                            <CardDescription class="text-gray-500">{{ product.description }}</CardDescription>
                        </div>
                    </CardContent>
                    <CardFooter class="p-4 mt-auto flex justify-between items-center">
                        <div class="flex flex-col items-start">
                            <span class="text-lg font-semibold text-green-600">£{{ product.price }}</span>
                            <span class="text-sm text-gray-500">{{ product.stock }} in stock</span>
                        </div>
                        <button
                            @click="() => addProduct(product as CartProduct)"
                            class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition duration-300">
                            Add to Cart
                        </button>
                    </CardFooter>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
