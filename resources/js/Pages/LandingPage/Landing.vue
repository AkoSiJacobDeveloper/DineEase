<script setup>
import { ref } from 'vue';

import Hero from '../Sections/Hero.vue';
import Featured from '../Sections/Featured.vue';
import HowItWorks from '../Sections/HowItWorks.vue';
import Testimonial from '../Sections/Testimonial.vue';
import Contact from '../Sections/Contact.vue';
import App from '../MainLayout/App.vue';
</script>


<template>
    <App>
        <div class="w-full">
            <Hero />
            <main class="px-5 bg-[#fcf7f8]">
                <Featured />
                <HowItWorks />
                <Testimonial />
                <Contact />
            </main>
        </div>
    </App>
</template>