<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';

// import { defineProps } from 'vue';

import App from '../MainLayout/App.vue';
import Search from '../Buttons/Search.vue';

const filters = ref([
    { name: "All" },
    { name: "Main Course" },
    { name: "Appetizers" },
    { name: "Side Dish" },
    { name: "Salads" },
    { name: "Soups" },
    { name: "Desserts" },
    { name: "Beverages" }
])
const props =   defineProps({
    foods:Array, // Dawaton niya ang foods from backend(Laravel) hangtud sa frontend(vue) aron madisplay sa menu page
});



// // Sample food data from backend
const foods = ref([...props.foods]);

// Track which filter is selected
const selectedFilter = ref("All");

// Function to filter foods
const filteredFoods = computed(() => {
    if (selectedFilter.value === "All") {
        return foods.value;
    } else {
        return foods.value.filter(food => food.category === selectedFilter.value);
    }
});

// Function to set the selected filter
const selectFilter = (filterName) => {
    selectedFilter.value = filterName;
};

// // Fetch data from Laravel API
// const fetchFoods = async () => {
//     try {
//         const response = await axios.get('http://localhost:8000/api/foods');
//         console.log("Foods Fetched:", response.data);
//         foods.value = response.data; // Store the fetched data

//          // Check if data is received correctly
//         if (foods.value.length > 0) {
//             console.log("Sample Food Item:", foods.value[0]); // See the actual structure
//         } else {
//             console.warn("No foods received from API!");
//         }
//     } catch (error) {
//         console.error("Error fetching foods:", error);
//     }
// };

// // Run fetchFoods() when page loads
// onMounted(fetchFoods);

</script>

<template>
    <App>
        <main class="px-5 pt-[6rem] h-screen flex flex-col gap-5">
            <section>
                <form action="#">
                    <div class="flex items-center gap-3 p-2 md:p-3 bg-white rounded" style="box-shadow: 6px 6px 12px #ebebeb,-6px -6px 12px #ffffff;">
                        <input class="w-full p-1 font-[Poppins] outline-0" type="text" name="query" placeholder="Search">
                        <i class="fa-solid fa-xmark fa-lg"></i>
                        <Search />
                    </div>
                </form>
            </section>

            <!-- Filter Buttons -->
            <section class="w-full">
                <p class="m-0 font-[Poppins] text-xs">Filter</p>
                <div class="flex gap-2 overflow-x-auto snap-x snap-mandatory scrollbar-hide">
                    <button v-for="(filter, index) in filters" 
                    :key="index" 
                    @click="selectFilter(filter.name)"
                    class="border p-3 min-w-[120px] md:flex-1 rounded font-[Rethink_Sans] hover:bg-[#A31621] hover:border-0 hover:text-white transition duration-300 ease-in-out">
                    {{ filter.name }}
                    </button>
                </div>
            </section>

            <!-- Display Filtered Foods -->
             <!-- <ul>
                <li v-for="(item) in foods" :key="item.id">
                    <p>{{ item.name }}</p>
                </li>
             </ul> -->
            <section>
                <div v-if="filteredFoods.length === 0">
                    <p>No foods found in this category.</p>
                </div>
                <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div v-for="food in filteredFoods" :key="food.id" class="p-4 border rounded shadow">
                        <img :src="'/images/' + food.image" :alt="food.name" class="w-full h-40 object-cover rounded">
                        <h3 class="text-lg font-bold mt-2">{{ food.name }}</h3>
                        <p class="text-sm text-gray-500">{{ food.description }}</p>
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