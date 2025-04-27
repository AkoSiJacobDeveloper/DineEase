<script setup>
import { ref, computed } from 'vue';
import { usePage, router } from '@inertiajs/vue3';

import App from '../MainLayout/App.vue';
import Quantity from '../Buttons/Quantity.vue';
import OrderModal from '../Modal/OrderModal.vue';

const props = defineProps({
    food: Object,
    auth: Object
});

const isModalOpen = ref(false);
const paymentMethod = ref(null);

const openOrderModal = () => {
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
};

// const submitOrder = () => {
//     // Your final submit logic
//     console.log('Order confirmed and submitted!');
//     isModalOpen.value = false;
// };


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

const orderStatus = ref({
    success: false,
    message: ''
});

const submitOrder = async () => {
    if (!paymentMethod.value) {
        alert('Please select a payment method');
        return;
    }

    try {
        await router.post('/order', {
            food_id: orderItem.value.food.id,
            quantity: orderItem.value.quantity,
            price: orderItem.value.price,
            payment_method: paymentMethod.value
        }, {
            onSuccess: () => {
                console.log('Order submitted successfully');
                isModalOpen.value = false;
                // Let the server handle the redirect to order.confirmation
            },
            onError: (errors) => {
                console.error('Validation or server errors:', errors);
                alert('Order failed: ' + (Object.values(errors).join(', ') || 'Server error occurred'));
            }
        });
    } catch (error) {
        console.error('Unexpected error:', error);
        alert('Order failed. Please try again.');
    }
};
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
                                        <input 
                                            type="radio" 
                                            name="payment" 
                                            value="gcash" 
                                            class="hidden peer" 
                                            v-model="paymentMethod"
                                        >
                                        <img :src="'/Images/GCash-Logo.png'" alt="Gcash" class="w-full h-full object-cover p-5 peer-checked:border-2 peer-checked:opacity-100 opacity-70 rounded peer-checked:border-[#a31621]">
                                    </label>
                                    
                                    <!-- PayPal Option -->
                                    <label class="w-40 h-28 rounded payment shadow-lg cursor-pointer">
                                        <input 
                                            type="radio" 
                                            name="payment" 
                                            value="paypal" 
                                            class="hidden peer" 
                                            v-model="paymentMethod"
                                        >
                                        <img :src="'/Images/paypal.png'" alt="PayPal" class="w-full h-full object-cover p-5 peer-checked:border-2 peer-checked:opacity-100 rounded opacity-70 peer-checked:border-[#a31621]">
                                    </label>
                                </div>
                            </div>

                            <div class="flex flex-col box-border">
                                <label class="text-gray-600 font-[Rethink_Sans] text-sm">Cash on Pick-Up</label>

                                <label class="w-[160px] h-28 rounded payment shadow-lg cursor-pointer flex justify-center items-center peer-checked:border-2 peer-checked:border-[#a31621] box-border">
                                    <input 
                                        type="radio" 
                                        name="payment" 
                                        value="cash" 
                                        class="hidden peer"
                                        v-model="paymentMethod"
                                    >
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
                        <button @click="openOrderModal" class="px-6 py-2 bg-[#A31621] text-white rounded hover:bg-[#8a1020] font-[Rethink_Sans] cursor-pointer">
                            Confirm Order
                        </button>
                    </section>
                </section>
            </section>
        </main>

        <div>
            <OrderModal v-if="isModalOpen" @close="closeModal">
                <div class="flex flex-col gap-4 p-4">
                    <!-- Header Section -->
                    <div class="flex flex-col items-center gap-3 text-center">
                            <!-- <img :src="'/Images/question.png'" alt="Confirmation" class="h-30 w-30"> -->
                            <h1 class="text-2xl font-bold text-gray-800 font-[Poppins]">Confirm Your Order</h1>
                        </div>  
                    <!-- Order Summary -->
                    <section class="flex flex-col gap-1">
                        <div class="bg-gray-50 p-4 rounded  ">
                            <h2 class="font-semibold mb-3 text-gray-700 font-[Poppins]">Order Details:</h2>
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-700 text-sm font-semibold font-[Poppins]">{{ food.name }} (x{{ orderItem.quantity }})</span>
                                <span class="font-medium font-[Rethink_Sans]">{{ formatCurrency(orderItem.price) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="font-semibold text-gray-700 font-[Rethink_Sans]">Service Charge (5%)</span>
                                <span class="font-[Rethink_Sans]">{{ formatCurrency(order.service_charge) }}</span>
                            </div>
                            <div class="border-t my-2"></div>
                            <div class="flex justify-between font-semibold">
                                <span class="font-[Poppins]">Total Amount:</span>
                                <span class="text-[#A31621] font-[Rethink_Sans]">{{ formatCurrency(order.total) }}</span>
                            </div>
                        </div>

                        <!-- Payment Method Display -->
                        <div v-if="paymentMethod" class="gap-2 p-4 bg-blue-50 rounded flex justify-between">
                            <span class="text-sm text-gray-600 font-[Poppins] flex justify-center items-center">Payment Method:</span>
                            <span class="font-medium capitalize font-[Rethink_Sans]">{{ paymentMethod }}</span>
                        </div>
                        <div v-else class="text-sm text-red-500 p-2 bg-red-50 rounded">
                            Please select a payment method
                        </div>
                    </section>

                    <section>
                        <!-- Important Note -->
                        <div class="text-xs text-gray-500 italic my-2">
                            * Note: Orders require staff approval before processing. You'll receive a confirmation notification.
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3 pt-2">
                            <button 
                                @click="closeModal"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition font-[Poppins]"
                                >
                                Cancel
                            </button>
                            <button 
                                @click="submitOrder" 
                                :disabled="!paymentMethod"
                                :class="{
                                    'bg-[#A31621] hover:bg-[#8a1020]': paymentMethod,
                                    'bg-gray-300 cursor-not-allowed': !paymentMethod
                                }"
                                class="flex-1 px-4 py-2 text-white rounded-lg transition font-[Poppins]"
                                >
                                Confirm Order
                            </button>
                        </div>
                    </section>
                </div>
            </OrderModal>
        </div>
    </App>
</template>