<script setup>
import App from '../MainLayout/App.vue';
</script>

<template>
    <App>
        <main class="px-5 pt-[6rem] h-screen py-5 flex flex-col gap-3">
            <div class="bg-white shadow-sm p-4 rounded mb-1">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800 font-[Poppins]">My Cart</h1>
                </div>
            </div>
            <section class="shadow-sm bg-white rounded">
                <div class="flex justify-center flex-col items-center">
                    <img :src="'/Images/development.png'" alt="Hamburger" class="w-[30vw]"/>
                </div>
                <div class="flex flex-col justify-center items-center pb-5">
                    <h1 class="font-extrabold text-3xl font-[Poppins]">Oops! Sorry</h1>
                    <p class="font-[Rethink_Sans] mb-3 text-sm">This feature is currently under development. Stay tuned!</p>
                </div>
            </section>
        </main>
    </App>
</template>