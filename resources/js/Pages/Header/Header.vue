<script setup>
import { ref, watch, onBeforeUnmount, computed, watchEffect } from 'vue';
import { onClickOutside } from '@vueuse/core';
import { Link, usePage, router } from '@inertiajs/vue3';

import Login from '../Buttons/Login.vue';
import Logout from '../Buttons/Logout.vue';

// State to control the menu visibility
const isOpen = ref(false);
const menuRef = ref(null);
const page = usePage();

const showToast = ref(false)
const toastMessage = ref('')

const commonLinks = [
    { name: "Home", href: "/" },
    { name: "Menu", href: "/menu" },
    { name: "About Us", href: "#" },
    { name: "Contact", href: "#" },
];

const links = computed(() => {
    const links = [...commonLinks];
    if (usePage().props.auth.user) {
        links.splice(2, 0, 
            { name: "Reservation", href: "/reservation" },
            { name: "My Cart", href: "/cart" },
        );
    }
    return links;
});

const mobileLinks = computed(() => [...links.value]);

const isAuthenticated = computed(() => {
    return !!page.props.auth.user
})

watchEffect(() => {
    console.log('Current auth state:', isAuthenticated.value ? 'LOGGED IN' : 'LOGGED OUT')
})

const handleOrderNow = () => {
    console.log('Button clicked - Auth state:', isAuthenticated.value)
    if (!isAuthenticated.value) {
        showModal.value = true
    } else {
        alert("User is logged in")
    }
}
watchEffect(() => {
    const success = page.props.flash?.success;
    const message = page.props.flash?.message;

    console.log('Success:', success, 'Message:', message);

    if (success || message) {
        toastMessage.value = success || message;
        showToast.value = true;

        setTimeout(() => {
            showToast.value = false;
        }, 3000);
    }
});

</script>

<template>
    <div v-if="showToast" id="login-toast" class="fixed top-3 right-5 z-[9999] flex justify-center items-center max-w-xs p-4 text-[#62222a] border-2 border-[#A31621] bg-[#f8d7da] rounded-lg shadow" role="alert">
        <div class="text-sm font-medium font-[Poppins] flex gap-2">
            <div class="flex justify-center items-center">
                <i class="fas fa-check"></i>
            </div>
            {{ toastMessage }}
        </div>
    </div>
    <header class="w-full flex justify-between bg-[#A31621] text-white p-5 fixed z-50 mb-28">
        <Link href="/menu" class="font-bold text-[1.3em] sm:text-xl md:text-2xl lg:text-3xl font-[Poppins] flex justify-center items-center">
            Dine<span class="text-[#FFC72C]">Ease</span>
        </Link> 
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
                <Login v-if="!page.props.auth.user" />
                <form v-else @submit.prevent="logout">
                    <Logout />
                </form>
            </ul>
        </nav>
  </header>
  
  <!--Mobile Links-->
    <div ref="menuRef" class="px-5 absolute z-100 w-full top-15">
        <ul v-if="isOpen" class="my-3 space-y-2 md:hidden w-full flex justify-center items-center flex-col text-white bg-white/30 backdrop-blur-md rounded p-5">
            <li v-for="(mlink, index) in mobileLinks" :key="index" class="p-2">
                <Link :href="mlink.href" class="hover:border-b font-[Rethink_Sans]">{{ mlink.name }}</Link>
            </li>
            <Login v-if="!page.props.auth.user" />
            <form v-else @submit.prevent="logout">
                <Logout />
            </form>
        </ul>
    </div>
</template>