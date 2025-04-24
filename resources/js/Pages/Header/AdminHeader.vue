<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import Logout from '../Buttons/Logout.vue';

const page = usePage();

const adminLinks = [
    { name: "Home", href: "/"},
    { name: "Menu", href: "/admin/menu"},
    { name: "Dashboard", href: "/admin/dashboard" },
    { name: "Orders", href: "/admin/orders" },
    { name: "About Us", href: "#" },
    { name: "Contact", href: "#" }
];

// const isAdmin = computed(() => page.props.auth.user?.is_admin === true);
</script>

<template>
        <header class="w-full flex justify-between bg-[#A31621] text-white p-5 fixed z-50 mb-28">
            <Link href="/admin/dashboard" class="font-bold text-[1.3em] sm:text-xl md:text-2xl lg:text-3xl font-[Poppins] flex justify-center items-center">
                Dine<span class="text-[#FFC72C]">Ease</span>
            </Link>
            
            <nav class="flex items-center">
                <ul class="hidden md:flex justify-center items-center gap-3">
                    <li v-for="(link, index) in adminLinks" :key="index" class="m-0">
                        <Link :href="link.href" class="hover:border-b font-[Rethink_Sans]">{{ link.name }}</Link>
                    </li>
                    <Logout />
                </ul>
            </nav>
        </header>
</template>