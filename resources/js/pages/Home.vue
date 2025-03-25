<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <AppLayout title="Homepage" description="Enter your email and password below to log in">
        <div class="relative overflow-hidden">
            <img class="w-full h-[600px] object-cover object-center"
                src="https://www.rothmansny.com/cdn/shop/files/DSC_9642_8dc72f91-e7af-40db-b209-8cd6cd90133a.jpg?v=1729121213&width=1080" />

            <div class="absolute inset-0 bg-gradient-to-r from-black from-0% via-black/70 via-40% to-black/30 to-100%">
            </div>

            <div class="absolute inset-0 flex flex-col justify-center px-8 md:px-16 lg:px-24 max-w-4xl">
                <div class="space-y-6">
                    <p class="text-green-400 font-medium tracking-wider uppercase">Our Sale is on!</p>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight">
                        Seasonal Collection <br /><span class="text-green-400">Live Now</span>
                    </h1>

                    <p class="text-lg md:text-xl text-white/80 max-w-2xl">
                        We specialise in gearing up our programmers with the latest merch! We offer desk accessories
                        also, this will surely enhance your programming capabilities...
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <Link :href="route('login')"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 text-base rounded-md transition duration-300">
                        Shop the Sale
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
