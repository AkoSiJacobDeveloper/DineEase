<script setup>

import Admin from '../MainLayout/Admin.vue';

</script>

<template>
    <Admin>
        <main class="px-5 pt-[6rem] h-auto py-5 flex flex-col gap-3 font-[Poppins]">
            <div class="bg-white shadow-sm p-4 rounded">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                </div>
            </div>
            <section class="shadow-sm bg-white rounded">
                <div class="flex justify-center flex-col items-center">
                    <img :src="'/Images/development.png'" alt="Hamburger" class="w-[31vw]"/>
                </div>
                <div class="flex flex-col justify-center items-center pb-5">
                    <h1 class="font-extrabold text-3xl font-[Poppins]">Oops! Sorry</h1>
                    <p class="font-[Rethink_Sans] mb-3 text-sm">This feature is currently under development. Stay tuned!</p>
                </div>
            </section>
        </main>
    </Admin>
</template>

