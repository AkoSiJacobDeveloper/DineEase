<script setup>
import { defineProps } from "vue";

import App from "../MainLayout/App.vue";
import Search from "../Buttons/Search.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
    foods: {
        type: Array,
        required: true,
    },
});

console.log(props.categories);
</script>

<template>
    <App>
        <main class="px-5 pt-[6rem] h-screen flex flex-col gap-5">
            <section>
                <form action="#">
                    <div
                        class="flex items-center gap-3 p-2 md:p-3 bg-white rounded"
                        style="
                            box-shadow: 6px 6px 12px #ebebeb,
                                -6px -6px 12px #ffffff;
                        "
                    >
                        <input
                            class="w-full p-1 font-[Poppins] outline-0"
                            type="text"
                            name="query"
                            placeholder="Search"
                        />
                        <i class="fa-solid fa-xmark fa-lg"></i>
                        <Search />
                    </div>
                </form>
            </section>

            <!-- Filter Buttons -->
            <section class="w-full">
                <p class="m-0 font-[Poppins] text-xs">Filter</p>
                <div
                    class="flex gap-2 overflow-x-auto snap-x snap-mandatory scrollbar-hide"
                >
                    <Link
                        href="/menu/"
                        class="border p-3 min-w-[120px] md:flex-1 rounded font-[Rethink_Sans] hover:bg-[#A31621] hover:border-0 hover:text-white transition duration-300 ease-in-out"
                    >
                        All
                    </Link>
                    <Link
                        v-for="category in props.categories"
                        :key="category.id"
                        :href="'/menu/' + category.id"
                        class="border p-3 min-w-[120px] md:flex-1 rounded font-[Rethink_Sans] hover:bg-[#A31621] hover:border-0 hover:text-white transition duration-300 ease-in-out"
                    >
                        {{ category.name }}
                    </Link>
                </div>
            </section>

            <section>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
                >
                    <div
                        v-for="food in props.foods"
                        :key="food.id"
                        class="p-4 border rounded shadow"
                    >
                        <img
                            :src="'/images/' + food.image"
                            :alt="food.name"
                            class="w-full h-40 object-cover rounded"
                        />
                        <h3 class="text-lg font-bold mt-2">{{ food.name }}</h3>
                        <p class="text-sm text-gray-500">
                            {{ food.description }}
                        </p>
                        <p class="text-lg font-bold mt-1">₱{{ food.price }}</p>
                    </div>
                </div>
            </section>
        </main>
    </App>
</template>

<!-- <section>
                <h1>Menu</h1>
                    <div v-if="foods.length > 0">
                    <div v-for="food in foods" :key="food.id">
                        <h2>{{ food.name }}</h2>
                        <p>{{ food.description }}</p>
                        <p>Price: ₱{{ food.price }}</p>
                    </div>
                    </div>
                    <div v-else>
                    <p>No food available.</p>
                    </div>
            </section> -->
