<script setup>
import { router } from '@inertiajs/vue3';

function gotoReservation() {
    router.get('/reservation');
}

</script>

<template>
    <button class="p-2 text-xs rounded w-full sm:w-48 md:w-56 lg:w-64 lg:p-3 bg-[#FFC72C] text-black font-bold font-[Rethink_Sans] cursor-pointer" @click="gotoReservation">Reserve Table</button>
</template>