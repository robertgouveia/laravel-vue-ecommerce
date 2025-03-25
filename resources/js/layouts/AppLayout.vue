<script setup lang="ts">
import { ShoppingCartIcon, XCircleIcon, UserIcon, ArrowRightIcon } from '@heroicons/vue/24/solid';
import { usePage } from '@inertiajs/vue3';
import { ref, watch, computed } from 'vue';
import axios from 'axios';
import { Head, Link } from '@inertiajs/vue3';
import {
    NavigationMenu,
    NavigationMenuContent,
    NavigationMenuItem,
    NavigationMenuLink,
    NavigationMenuList,
    NavigationMenuTrigger,
    navigationMenuTriggerStyle,
} from '@/components/ui/navigation-menu';
import { Button } from '@/components/ui/button';
import { useCartStore } from '@/stores/cart';

defineProps<{ title: string }>();

const auth = usePage().props.auth as { user: any | null };
const user = ref(auth.user ?? null);

const cartStore = useCartStore();
const cart = computed(() => cartStore.getProducts);
const count = computed(() => cartStore.getTotalItems);

watch(
    () => user.value,
    (newUser) => {
        user.value = newUser;
    },
);

const logout = async () => {
    try {
        const res = await axios.post('/logout');
        if (res.status !== 200) {
            console.log('Error');
        }
        user.value = null;
    } catch (error) {
        console.log('Error:', error);
    }
};

const product_pages: { title: string; category: string; description: string }[] = [
    {
        title: 'Golang',
        category: 'go',
        description: 'Shop for golang related products!',
    },
    {
        title: 'Csharp',
        category: 'cs',
        description: 'Shop for Csharp related products!',
    },
    {
        title: 'PHP',
        category: 'php',
        description: 'Shop for PHP related products!',
    },
    {
        title: 'Typescript',
        category: 'ts',
        description: 'Shop for Typescript related products!',
    },
];

const navigation: { title: string; url: string }[] = [];
</script>

<template>
    <Head :title="title">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <div class="mx-auto flex max-w-5xl items-center justify-between border-b p-2">
        <NavigationMenu>
            <NavigationMenuList>
                <a href="/" class="me-3">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/2367px-Vue.js_Logo_2.svg.png" class="w-6" />
                </a>
                <NavigationMenuItem>
                    <NavigationMenuTrigger>Products</NavigationMenuTrigger>
                    <NavigationMenuContent>
                        <ul class="grid w-[400px] gap-3 p-4 md:w-[500px] md:grid-cols-2 lg:w-[600px]">
                            <li v-for="product in product_pages" :key="product.title">
                                <NavigationMenuLink as-child>
                                    <Link
                                        :href="route('products') + '?categories=' + product.category"
                                        class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground"
                                    >
                                        <div class="text-sm font-medium leading-none">{{ product.title }}</div>
                                        <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                            {{ product.description }}
                                        </p>
                                    </Link>
                                </NavigationMenuLink>
                            </li>
                        </ul>
                    </NavigationMenuContent>
                </NavigationMenuItem>
                <NavigationMenuItem>
                    <a v-for="nav in navigation" :class="navigationMenuTriggerStyle()" :key="nav.title">
                        {{ nav.title }}
                    </a>
                </NavigationMenuItem>
            </NavigationMenuList>
        </NavigationMenu>

        <NavigationMenu v-if="!user">
            <NavigationMenuList>
                <NavigationMenuItem>
                    <NavigationMenuLink
                        class="gap-2 bg-gray-800 text-white transition-all hover:gap-4 hover:bg-gray-900 hover:text-white hover:transition-all active:bg-gray-900 active:text-white"
                        :href="route('register')"
                        :class="navigationMenuTriggerStyle()"
                    >
                        Get Started
                        <ArrowRightIcon class="size-4" />
                    </NavigationMenuLink>
                </NavigationMenuItem>
            </NavigationMenuList>
        </NavigationMenu>
        <NavigationMenu v-else>
            <NavigationMenuList>
                <NavigationMenuItem>
                    <NavigationMenuTrigger class="gap-1"><UserIcon class="size-4" /> Account</NavigationMenuTrigger>
                    <NavigationMenuContent>
                        <ul class="flex w-[200px] flex-col gap-3 p-4 md:w-[200px] lg:w-[200px]">
                            <li>
                                <NavigationMenuLink>
                                    <Link :href="route('orders')"
                                        class="text-center block w-full select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground"
                                    >
                                        <div class="text-sm font-medium leading-none">Your Orders</div>
                                    </Link>
                                </NavigationMenuLink>
                            </li>
                            <li>
                                <NavigationMenuLink>
                                    <button
                                        @click="logout"
                                        class="block w-full select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground"
                                    >
                                        <div class="text-sm font-medium leading-none">Log out</div>
                                    </button>
                                </NavigationMenuLink>
                            </li>
                        </ul>
                    </NavigationMenuContent>
                </NavigationMenuItem>
                <NavigationMenuItem v-if="count() > 0">
                    <NavigationMenuTrigger class="gap-2 relative"><ShoppingCartIcon class="size-4" /> Cart <p class="absolute top-0 left-0 text-xs px-1 text-white bg-green-400 rounded-full">{{count()}}</p></NavigationMenuTrigger>
                    <NavigationMenuContent class="p-2">
                        <ul class="flex w-[300px] flex-col gap-3 p-4 md:w-[300px] lg:w-[300px]">
                            <li class="flex items-center justify-between" v-for="product in cart()" :key="product.name">
                                <div class="flex items-center gap-4">
                                    <img
                                        src="https://m.media-amazon.com/images/I/51oxjgxm4WL.jpg"
                                        alt="Product"
                                        class="h-12 w-12 rounded-md object-cover"
                                    />
                                    <div>
                                        <div class="text-sm font-medium">{{ product.name }}</div>
                                        <div class="text-xs text-muted-foreground">x{{ product.quantity }} • £{{ product.price * product.quantity }}</div>
                                    </div>
                                </div>
                                <button class="text-red-500 transition hover:text-red-600" @click="() => cartStore.removeProduct(product.id)">
                                    <XCircleIcon class="h-5 w-5" />
                                </button>
                            </li>
                        </ul>
                        <Link :href="route('checkout')">
                            <Button class="w-full bg-green-500 hover:bg-green-600">Checkout</Button>
                        </Link>
                    </NavigationMenuContent>
                </NavigationMenuItem>
            </NavigationMenuList>
        </NavigationMenu>
    </div>
    <div class="mx-auto my-3 flex max-w-5xl flex-col gap-3 p-2">
        <slot />
    </div>
</template>
