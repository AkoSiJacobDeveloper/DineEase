<script setup>
import { ref } from 'vue';

const steps = ref([
    { heading: "Browse the Menu", img: "Order.png", description: "Explore delicious dishes with images and description" },
    { heading: "Add to Cart", img: "add.png", description: "Select your favorite meals and customize as needed."},
    { heading: "Checkout", img: "checkout.png", description: "Enter your details, choose a payment method, and confirn your order"},
    { heading: "Enjoy Your Meal", img: "enjoy.png", description: "Pick up your order or wait for delivery."}
])
</script>

<template>
    <div class="lg:h-screen lg:flex justify-center items-center flex-col">
        <div class="text-center py-6">
            <p class="font-bold text-2xl lg:text-5xl font-[Dancing_Script]">How It Works?</p>
            <p class="font-regular text-xs lg:text-sm font-[Rethink_Sans]">Ordering your favorite meal or booking a table has never been easier</p>
        </div>
        <div class="flex overflow-x-auto snap-x snap-mandatory scrollbar-hide md:grid md:grid-cols-4 md:gap-4 
            md:place-items-center py-5 md:overflow-visible">
            <div v-for="(step, index) in steps" :key="index" class="px-2 flex-shrink-0 w-full h-full md:w-auto md:h-full">
                <div class="flex justify-center items-center flex-col rounded p-4 h-100 lg:h-full bg-[#fff] shadow-lg lg:shadow-2xl">
                    <h1 class="text-lg text-center font-bold font-[Rethink_Sans]">{{ step.heading }}</h1>
                    <img :src="'/Images/' + step.img" alt="Step" class="h-[50vh] rounded">
                    <p class="text-center text-xs font-[Rethink_Sans]">{{ step.description }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- md:w-auto md:h-full -->