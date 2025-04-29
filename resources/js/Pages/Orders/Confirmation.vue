<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

import App from '../MainLayout/App.vue';

const props = defineProps({
    order: Object,
    food: Object,
    flash: Object
});

// Currency formatter
const formatCurrency = (value) => {
    return '₱' + Number(value || 0).toFixed(2);
};

const formattedPaymentMethod = computed(() => {
    if (!props.order?.payment_method) return '';
    return props.order.payment_method.charAt(0).toUpperCase() + props.order.payment_method.slice(1).toLowerCase();
});

const formattedStatus = computed(() => {
    if (!props.order?.status) return '';
    return props.order.status.charAt(0).toUpperCase() + props.order.status.slice(1).toLowerCase();
});
</script>

<template>
    <App>
        <main class="px-5 pt-[6rem] h-screen py-5 flex justify-center items-center">
            <section class="p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <h1 class="text-3xl font-bold mb-6 font-[Poppins] text-center">Order Confirmation</h1>
                <p v-if="flash?.success" class="text-green-600 text-center mb-4 font-[Rethink_Sans]">{{ flash.success }}</p>
                <div class="bg-gray-50 p-4 rounded">
                    <h2 class="font-semibold mb-3 text-gray-700 font-[Poppins]">Order Details:</h2>
                    <div class="flex justify-between mb-1">
                        <span class="text-gray-700 font-[Rethink_Sans]">Order Number:</span>
                        <span class="font-medium font-[Rethink_Sans]">{{ order.order_number }}</span>
                    </div>
                    <div class="flex justify-between mb-1">
                        <span class="text-gray-700 font-[Rethink_Sans]">Item:</span>
                        <span class="font-medium font-[Rethink_Sans]">
                            <span v-if="food && order" class="block">
                                {{ order.quantity }}x {{ food.name }} ({{ formatCurrency(order.subtotal) }})
                            </span>
                            <span v-else class="block">No item details available</span>
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
                        @click="router.visit('/menu')"
                        class="mt-4 px-6 py-2 bg-[#A31621] text-white rounded hover:bg-[#8a1020] font-[Rethink_Sans] cursor-pointer"
                    >
                        Back to Menu
                    </button>
                </div>
            </section>
        </main>
    </App>
</template>