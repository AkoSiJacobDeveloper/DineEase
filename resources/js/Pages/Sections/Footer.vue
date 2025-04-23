<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const sections = ref([
  {
    title: 'Main',
    links: [
        { name: 'Home', url: '/' },
        { name: 'Reservation', url: '/reservation' },
        { name: 'Menu', url: '/menu' },
        { name: 'Order Now', url: '/order-now' },
        { name: 'Contact Us', url: '/contact' },
        ]
  },
  {
    title: 'Customer Support',
    links: [
        { name: 'FAQ', url: '/faq' },
        { name: 'Terms and Conditions', url: '/terms' },
        { name: 'Privacy Policy', url: '/privacy-policy' },
        { name: 'Chat with Support', url: '/chat-support' },
        ]
  },
  {
    title: 'Follow Us',
    links: [
        { name: 'Facebook', url: 'https://facebook.com' },
        { name: 'Twitter', url: 'https://twitter.com' },
        { name: 'Instagram', url: 'https://instagram.com' },
        ]
  }
])
</script>

<template>
    <div class="pb-5 text-white">
        <div class="flex flex-col md:flex-row justify-center items-center h-[50vh] gap-1 md:gap-6 lg:gap-10">
            <div class="flex justify-center items-center">
                <div class="flex flex-col gap-7  w-full p-3 justify-center">
                    <div class="">
                        <p class="text-lg lg:text-5xl font-bold font-[Poppins]">Dine<span class="text-[#FFC72C]">Ease</span></p>
                        <p class="font-[Rethink_Sans] text-xs lg:text-base">Bringing the best flavors to your table, whether you dine in or order online. Thank you for choosing us—where every meal is made with love and served with a smile!</p>
                    </div>
                    <div class="flex gap-2 lg:justify-start">
                        <i class="fa-brands fa-facebook fa-lg"></i>
                        <i class="fa-brands fa-twitter fa-lg"></i>
                        <i class="fa-brands fa-square-instagram fa-lg"></i>
                    </div>
                </div>
            </div>
            <div class="w-full flex">
                <div v-for="(section, index) in sections" :key="index" class="flex-grow-1 p-5">
                    <p class="font-bold font-[Poppins] text-xs lg:text-base">{{ section.title }}</p>
                    <ul>
                        <li v-for="(link, linkIndex) in section.links" :key="linkIndex" class="font-[Rethink_Sans] text-xs lg:text-base">
                            <router-link :to="link.url">{{ link.name }}</router-link>
                            <!-- <Link :to="link.url"> {{ link.name }}</Link> -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="mb-5">
        <p class="font-[Poppins] text-center text-xs font-normal">© 2025 DineEase. All Rights Reserved.</p>
    </div>
</template>