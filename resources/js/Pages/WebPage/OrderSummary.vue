<script setup>
import { ref, computed } from 'vue';
import { usePage, router } from '@inertiajs/vue3';

import App from '../MainLayout/App.vue';
import Quantity from '../Buttons/Quantity.vue';

const props = defineProps({
    food: Object,
    auth: Object
});

const orderItem = ref({
    food: props.food,
    quantity: 1,
    price: props.food.price,
});

// Currency formatter
const formatCurrency = (value) => {
    return '₱' + Number(value).toFixed(2);
};

// Calculate order summary values
const order = computed(() => {
    const subtotal = Number(orderItem.value.price);
    const serviceCharge = Number(subtotal * 0.05); // 5% service charge
    const total = Number(subtotal + serviceCharge);
    
    return {
        subtotal,
        service_charge: serviceCharge,
        total
    };
});

const updateQuantity = (newQuantity) => {
    orderItem.value.quantity = newQuantity;
    orderItem.value.price = props.food.price * newQuantity;
};

const confirmOrder = async () => {
    try {
        await router.post('/order', {
            food_id: orderItem.value.food.id,
            quantity: orderItem.value.quantity,
            price: orderItem.value.price,
            subtotal: order.value.subtotal,
            service_charge: order.value.service_charge,
            total: order.value.total
        });
    } catch (error) {
        console.error('Order Failed!', error)
    }
}
</script>

<template>
    <App>
        <main class="px-5 pt-[6rem] h-auto lg:h-screen py-5 flex justify-center" v-if="food">
            <section class="rounded-lg flex flex-col gap-5 md:flex-row p-10 w-screen mx-auto">
                <div class="w-full md:h-[70vh] lg:h-full md:w-1/3 flex-col order-container">
                    <div class="h-9/12 rounded-t">
                        <img :src="food.image" :alt="food.name" class="w-full h-full object-cover rounded-t" />
                    </div>
                    <div class="h-3/12 p-3 shadow-lg lg:flex items-center justify-evenly rounded-b box-border">
                        <div class="mb-2 ">
                            <h2 class="text-xl md:text-base lg:text-2xl font-bold font-[Poppins]">{{ food.name }}</h2>
                            <p class="text-xs md:text-[0.5em] lg:text-sm text-gray-600 font-[Rethink_Sans]">{{ food.description }}</p>
                            <p class="text-xs md:text-sm lg:text-lg font-bold text-[#A31621] font-[Rethink_Sans]">
                                <span class="currency-value">{{ (food.price) }}</span>
                            </p>
                        </div>
                        <Quantity :item="orderItem" @update-quantity="updateQuantity" />
                    </div>
                </div>
                
                <section class="p-6 shadow-lg w-full md:w-2/3 rounded order-container">
                    <p class="text-lg lg:text-2xl font-bold mb-6 font-[Poppins]">Order Summary</p>
                    <section class="flex flex-col gap-2 mb-10">
                        <div class="flex justify-between">
                            <p class="font-normal text-gray-600 font-[Rethink_Sans] text-xs lg:text-base">Quantity</p>
                            <p class="font-bold font-[Rethink_Sans] text-xs lg:text-lg">x {{ orderItem.quantity }}</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="font-normal text-gray-600 font-[Rethink_Sans] text-xs lg:text-base">Subtotal</p>
                            <p class="font-bold font-[Rethink_Sans] text-xs lg:text-lg">    
                                <span class="currency-value">{{ Number(order.subtotal).toFixed(2) }}</span>
                            </p>
                        </div>
                        <div class="flex justify-between">
                            <p class="font-normal text-gray-600 font-[Rethink_Sans] text-xs lg:text-base">Service Charge (5%)</p>
                            <p class="font-bold font-[Rethink_Sans] text-xs lg:text-lg">
                                <span class="currency-value">{{ Number(order.service_charge) }}</span>
                            </p>
                        </div>
                        <hr class="border-2">
                        <div class="flex justify-between">
                            <p class="font-semibold font-[Rethink_Sans] text-xs lg:text-base">Total Amount</p>
                            <p class="font-bold font-[Rethink_Sans] text-xs lg:text-lg">
                                <span class="currency-value">{{ Number(order.total) }}</span>
                            </p>
                        </div>
                    </section>

                    <section class="my-5">
                        <p class="lg:text-2xl font-bold mb-6 font-[Poppins]">Payment Method</p>
                        <div class="flex gap-10">
                            <div class="flex flex-col">
                                <label class="text-gray-600 font-[Rethink_Sans] text-sm">E-Wallet</label>
                                <div class="flex gap-2">
                                    <!-- GCash Option -->
                                    <label class="w-40 h-28 rounded payment shadow-lg cursor-pointer">
                                    <input type="radio" name="payment" value="gcash" class="hidden peer">
                                        <img :src="'/Images/GCash-Logo.png'" alt="Gcash" class="w-full h-full object-cover p-5 peer-checked:border-2 peer-checked:opacity-100 opacity-70 rounded  peer-checked:border-[#a31621]">
                                    </label>
                                    
                                    <!-- PayPal Option -->
                                    <label class="w-40 h-28 rounded payment shadow-lg cursor-pointer">
                                    <input type="radio" name="payment" value="paypal" class="hidden peer">
                                        <img :src="'/Images/paypal.png'" alt="PayPal" class="w-full h-full object-cover p-5 peer-checked:border-2 peer-checked:opacity-100 rounded opacity-70 peer-checked:border-[#a31621]">
                                    </label>
                                </div>
                            </div>

                            <div class="flex flex-col box-border">
                                <label class="text-gray-600 font-[Rethink_Sans] text-sm">Cash on Pick-Up</label>

                                <label class="w-[160px] h-28 rounded payment shadow-lg  cursor-pointer flex justify-center items-center peer-checked:border-2 peer-checked:border-[#a31621] box-border">
                                    <input type="radio" name="payment" value="cash" class="hidden peer">
                                    <i class="fa-solid fa-hand-holding-dollar w-full h-full object-cover text-6xl p-6 text-center text-[#a31621] peer-checked:opacity-100 rounded opacity-70 peer-checked:border-2 peer-checked:border-[#a31621]"></i>
                                </label>
                            </div>
                        </div>
                    </section>
            
                    <section class="flex justify-between mt-5">
                        <button 
                            @click="router.visit('/menu')"
                            class="px-4 py-2 border border-[#A31621] text-[#A31621] rounded hover:bg-gray-100 font-[Rethink_Sans]"
                        >
                            Back to Menu
                        </button>
                        <button 
                            @click="confirmOrder"
                            class="px-6 py-2 bg-[#A31621] text-white rounded hover:bg-[#8a1020] font-[Rethink_Sans]"
                        >
                            Confirm Order
                        </button>
                    </section>
                </section>
            </section>
        </main>
    </App>
</template>