<script setup>

import OrderNow from '../Buttons/OrderNow.vue';
import ReserveTable from '../Buttons/ReserveTable.vue';
</script>

<template>
    <div class="w-full h-screen bg-cover bg-center" style="background-image: url('/Images/restaurant.jpg'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="px-5 flex justify-center items-center flex-col h-screen text-white relative z-10">
            <div>
                <p class="font-extrabold text-3xl lg:text-6xl font-[Dancing_Script]">Delicious Meals, Just a Click Away!</p>
            </div>
            <div>
                <p class="font-regular text-xs lg:text-sm font-[Rethink_Sans]">Savor the taste of freshly prepared dishes. Order online or reserve a table at your convenience.</p>
            </div>
            <div class="flex justify-center gap-3 mt-3 w-full font-[Poppins]">
                <OrderNow />
                <ReserveTable />
            </div>
        </div>
    </div>
</template>