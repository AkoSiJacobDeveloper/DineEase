<script setup>
import { ref, computed } from 'vue';

import App from '../MainLayout/App.vue';

const props = defineProps({
    order: Object,
    success: String
});

// Currency formatter
const formatCurrency = (value) => {
    return '₱' + Number(value).toFixed(2);
};

const formattedPaymentMethod = computed(() => {
    if (!props.order.payment_method) return '';
    return props.order.payment_method.charAt(0).toUpperCase() + props.order.payment_method.slice(1).toLowerCase();
});

const formattedStatus = computed(() => {
    if (!props.order.status) return '';
    return props.order.status.charAt(0).toUpperCase() + props.order.status.slice(1).toLowerCase();
});
</script>

<template>
    <App>
        <main class="px-5 pt-[6rem] h-screen py-5 flex justify-center items-center">
            <section class="p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <h1 class="text-3xl font-bold mb-6 font-[Poppins] text-center">Order Confirmation</h1>
                <div class="mb-2 p-4 bg-[#d1e7dd] rounded">
                    <p v-if="success" class="text-[#0f5132] font-[Rethink_Sans]">{{ success }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded">
                    <h2 class="font-semibold mb-3 text-gray-700 font-[Poppins]">Order Details:</h2>
                    <div class="flex justify-between mb-1">
                        <span class="text-gray-700 font-[Rethink_Sans]">Order Number:</span>
                        <span class="font-medium font-[Rethink_Sans]">{{ order.order_number }}</span>
                    </div>
                    <div class="flex justify-between mb-1">
                        <span class="text-gray-700 font-[Rethink_Sans]">Items:</span>
                        <span class="font-medium font-[Rethink_Sans]">
                            <span v-for="item in order.items" :key="item.id" class="block">
                                {{ item.quantity }}x {{ item.food.name }} ({{ formatCurrency(item.price) }})
                            </span>
                        </span>
                    </div>
                    <div class="flex justify-between mb-1">
                        <span class="text-gray-700 font-[Poppins]">Subtotal:</span>
                        <span class="font-medium font-[Rethink_Sans]">{{ formatCurrency(order.subtotal) }}</span>
                    </div>
                    <div class="flex justify-between mb-1">
                        <span class="text-gray-700 font-[Poppins]">Service Charge:</span>
                        <span class="font-medium font-[Rethink_Sans]">{{ formatCurrency(order.service_charge) }}</span>
                    </div>
                    <div class="flex justify-between mb-1">
                        <span class="text-gray-700 font-[Poppins]">Payment Method:</span>
                        <span class="font-medium font-[Rethink_Sans]">{{ formattedPaymentMethod }}</span>
                    </div>
                    <div class="flex justify-between mb-1">
                        <span class="text-gray-700 font-[Poppins]">Status:</span>
                        <span class="font-medium font-[Rethink_Sans]">{{ formattedStatus }}</span>
                    </div>
                    <div class="border-t my-2"></div>
                    <div class="flex justify-between font-semibold">
                        <span class="font-[Poppins]">Total:</span>
                        <span class="text-[#A31621] font-[Rethink_Sans]">{{ formatCurrency(order.total) }}</span>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button
                        @click="$inertia.visit('/menu')"
                        class="mt-4 px-6 py-2 bg-[#A31621] text-white rounded hover:bg-[#8a1020] font-[Rethink_Sans]"
                    >
                        Back to Menu
                    </button>
                </div>
            </section>
        </main>
    </App>
</template>