<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import Logout from '../Buttons/Logout.vue';

const page = usePage();

const adminLinks = [
    { name: "Dashboard", href: "/admin/dashboard" },
    { name: "Menu", href: "/admin/menu" },
    { name: "Orders", href: "/admin/orders" },
    { name: "About Us", href: "#" },
    { name: "Contact", href: "#" }
];
</script>

<template>
    <header class="w-full flex justify-between bg-[#A31621] text-white p-5 fixed z-50 mb-28">
        <Link href="/admin/dashboard" class="font-bold text-[1.3em] sm:text-xl md:text-2xl lg:text-3xl font-[Poppins] flex justify-center items-center">
            Dine<span class="text-[#FFC72C]">Ease</span>
        </Link>
        
        <nav class="flex items-center">
            <ul class="hidden md:flex justify-center items-center gap-3">
                <li v-for="(link, index) in adminLinks" :key="index" class="m-0">
                    <Link 
                        :href="link.href" 
                        class="font-[Rethink_Sans] hover:border-b"
                        :class="{ 'border-b-2 border-white': page.url === link.href }"
                    >
                        {{ link.name }}
                    </Link>
                </li>
                <Logout />
            </ul>
        </nav>
    </header>
</template>