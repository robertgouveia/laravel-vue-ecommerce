import { defineStore } from 'pinia';
import { ref, Ref } from 'vue';

export interface CartProduct {
    id: number;
    name: string;
    price: number;
    quantity: number;
}

export const useCartStore = defineStore('cart', () => {
    const getCartCookie = (): string | null => {
        const match = document.cookie.match(/(?:(?:^|.*;\s*)cart\s*\=\s*([^;]*).*$)|^.*$/);
        return match ? match[1] : null;
    };

    const setCartCookie = (value: string): void => {
        const expires = new Date();
        expires.setFullYear(expires.getFullYear() + 1);
        document.cookie = `cart=${value};expires=${expires.toUTCString()};path=/`;
    };

    const cart: Ref<CartProduct[]> = ref(JSON.parse(getCartCookie() || '[]'));
    const getProducts = () => cart.value;
    const getTotalItems = () => cart.value.length;

    const addProduct = (product: CartProduct) => {
        const existingProduct = cart.value.find(p => p.id === product.id);
        if (existingProduct) {
            existingProduct.quantity++;
        } else {
            cart.value.push({ ...product, quantity: 1 });
        }

        setCartCookie(JSON.stringify(cart.value));
    }

    const removeProduct = (productId: number) => {
        const index = cart.value.findIndex(p => p.id === productId);
        if (index !== -1) {
            cart.value.splice(index, 1);
            setCartCookie(JSON.stringify(cart.value));
        }
    }

    const clearCart = () => {
        cart.value = [];
        setCartCookie(JSON.stringify(cart.value));
    }

    return {
        getProducts,
        getTotalItems,
        addProduct,
        removeProduct,
        clearCart,
    }
});
