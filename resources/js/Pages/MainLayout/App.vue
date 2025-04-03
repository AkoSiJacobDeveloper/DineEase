<script setup>
import { ref } from 'vue';

import Header from '../Header/Header.vue';
import Footer from '../Sections/Footer.vue';
</script>

<template>
    <div class="w-full">
        <Header />
        <main class="bg-[#fcf7f8]">
            <slot></slot>
        </main>
        <footer class="px-5 bg-[#A31621]">
            <Footer />
        </footer>
    </div>
</template>