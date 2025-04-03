<script setup>
import { ref } from 'vue';

const dishes = ref([
    { img: "1.jpg" },
    { img: "2.jpg" },
    { img: "3.jpg" },
    { img: "4.jpg" },
])
</script>

<template>
    <div class="lg:h-screen lg:flex justify-center items-center flex-col">
        <div class="text-center py-6">
            <p class="font-bold text-2xl lg:text-5xl font-[Dancing_Script]">Our Chief's Special Picks</p>
            <p class="font-regular text-xs lg:text-sm font-[Rethink_Sans]">Try our most loved dishes, crafter with passion and fresh ingredients.</p>
        </div>
        <div class="flex overflow-x-auto snap-x snap-mandatory scrollbar-hide md:grid md:grid-cols-4 md:gap-4 
            md:place-items-center py-5 md:overflow-visible">
            <div v-for="(dish, index) in dishes" :key="index" class="px-2 flex-shrink-0 w-full h-100 md:w-auto md:h-full">
                <img :src="'/Images/' + dish.img" alt="Dish" class="w-full h-full object-cover rounded">
            </div>
        </div>
    </div>
</template>

<!-- md:w-auto md:h-full -->