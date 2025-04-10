<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const goToLogin = () => {
    router.visit('/login');
}
</script>

<template>
    <button class="p-2 rounded w-full sm:w-24 bg-[#FFC72C] font-bold font-[Rethink_Sans] hover:cursor-pointer" @click="goToLogin">Login</button>
</template>