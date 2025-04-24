<script setup>
import AdminHeader from '../Header/AdminHeader.vue';
import Footer from '../Sections/Footer.vue';
</script>

<template>
    <div class="w-full">
        <AdminHeader />
        <main class="bg-[#fcf7f8]">
            <slot></slot>
        </main>
        <footer class="px-5 bg-[#A31621]">
            <Footer />
        </footer>
    </div>
</template>