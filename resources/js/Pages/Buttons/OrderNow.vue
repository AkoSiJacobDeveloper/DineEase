<script setup>
import { router } from '@inertiajs/vue3';

function gotoMenu() {
    router.get('/menu');
}

</script>

<template>
    <button class="p-2 text-xs rounded w-full sm:w-48  md:w-56 lg:w-64 bg-[#A31621] font-bold font-[Rethink_Sans cursor-pointer" @click="gotoMenu">Order Now</button>
</template>