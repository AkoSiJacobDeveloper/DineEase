<script setup>
import { ref, onMounted} from 'vue'; // use to control the visibility of the menu
import { onClickOutside } from '@vueuse/core';
import { Link, usePage } from '@inertiajs/vue3';

import Login from '../Buttons/Login.vue';

// State to control the menu visibility
const isOpen = ref(false);

// Function to toggle menu
const toggleMenu = () => {
    isOpen.value = !isOpen.value;
}

// Close menu by clicking outside
const menuRef = ref(null);
onClickOutside(menuRef, () => {
    isOpen.value = false;
})



const links = ref([
    { name: "Home", href: "/" },
    { name: "Menu", href: "/menu" },
    { name: "Reservations", href: "#" },
    { name: "About Us", href: "#" },
    { name: "Contact", href: "#" },
])

const mobileLinks = ref([
    { name: "Home", href: "/" },
    { name: "Menu", href: "/menu" },
    { name: "Reservations", href: "#" },
    { name: "About Us", href: "#" },
    { name: "Contact", href: "#" },
])
</script>

<template>
    <header class="w-full flex justify-between bg-[#A31621] text-white p-5 fixed z-50 mb-28  ">
        <Link href="/menu" class="font-bold text-[1.3em] sm:text-xl md:text-2xl lg:text-3xl font-[Poppins] flex justify-center items-center">Dine<span class="text-[#FFC72C]">Ease</span></Link> 
        <nav class="flex justify-center items-center">
            <button @click="toggleMenu" class="md:hidden focus:outline-none">
                <svg
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16m-7 6h7"
                    ></path>
                </svg>
            </button>
            <!--Desktop Links-->
            <ul class="hidden md:flex justify-center items-center gap-3">
                <li v-for="(link, index) in links" :key="index" class="m-0">
                    <Link :href="link.href" class="hover:border-b font-[Rethink_Sans]">{{ link.name }}</Link>
                </li>
                <Login />
            </ul>
        </nav>
    </header>
    
    <!--Mobile Links-->
    <div ref="menuRef" class="px-5 absolute z-100 w-full top-15">
        <ul v-if="isOpen" class="my-3 space-y-2 md:hidden w-full flex justify-center items-center flex-col text-white bg-white/30 backdrop-blur-md rounded p-5">
            <li v-for="(mlink, index) in mobileLinks" :key="index" class="p-2">
                <Link :href="mlink.href" class="hover:border-b font-[Rethink_Sans]">{{ mlink.name }}</Link>
            </li>
            <Login />
        </ul>
    </div>
</template>