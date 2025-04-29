<script setup>
import { defineProps, ref, onMounted, onUnmounted, reactive, computed } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';
import App from '../MainLayout/App.vue';
import Search from '../Buttons/Search.vue';
import Order from '../Buttons/Order.vue';
import Modal from '../Modal/Modal.vue';

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
    foods: {
        type: Array,
        required: true,
    },
    currentCategory: {
        type: [String, Number],
        default: null,
    }
});

const headings = ref([
    { headlines: 'Main Course' },
    { headlines: 'Appetizers' },
    { headlines: 'Side Dish' },
    { headlines: 'Salads' },
    { headlines: 'Soups' },
    { headlines: 'Desserts' },
    { headlines: 'Beverages' },
]);

const categories = ref([
    { id: 1, name: 'Main Course', details: 'Hearty and satisfying dishes crafted to be the centerpiece of your meal, featuring rich flavors and wholesome ingredients.' },
]);

const getCategoryName = (categoryId) => {
    const category = props.categories.find(c => c.id === categoryId);
    return category ? category.name.toLowerCase() : 'Dishes';
};

const formatPrice = (price) => {
    if (price === null || price === undefined) return '0.00';
    const num = typeof price === 'string' ? parseFloat(price) : price;
    return isNaN(num) ? '0.00' : num.toFixed(2);
};

const isLargeScreen = ref(false);
const scrollContainers = reactive({});
const scrollContainer = ref(null);

const updateScreenSize = () => {
    isLargeScreen.value = window.innerWidth > 768;
};

const scrollLeft = (categoryId) => {
    const container = scrollContainers[categoryId];
    if (container) {
        container.scrollBy({ left: -300, behavior: 'smooth' });
    }
};

const scrollRight = (categoryId) => {
    const container = scrollContainers[categoryId];
    if (container) {
        container.scrollBy({ left: 300, behavior: 'smooth' });
    }
};

const scrollLefts = () => {
    if (scrollContainer.value) {
        scrollContainer.scrollBy({ left: -300, behavior: 'smooth' });
    }
};

const scrollRights = () => {
    if (scrollContainer.value) {
        scrollContainer.scrollBy({ left: 300, behavior: 'smooth' });
    }
};

onMounted(() => {
    updateScreenSize();
    window.addEventListener('resize', updateScreenSize);
});

onUnmounted(() => {
    window.removeEventListener('resize', updateScreenSize);
});

const showModal = ref(false);
const page = usePage();

const isAuthenticated = computed(() => {
    return !!page.props.auth?.user;
});

const handleOrderNow = (foodId) => {
    if (!isAuthenticated.value) {
        showModal.value = true;
        return;
    }

    router.visit(route('order.show', { food: foodId }), {
        method: 'get',
        preserveState: true,
        preserveScroll: true,
        onError: (error) => {
            console.error('Navigation error:', error);
        }
    });
};

const goToLogin = () => {
    router.visit('/login');
};
</script>

<template>
    <App>
        <main class="px-5 pt-[6rem] h-auto py-5 flex flex-col gap-3">
            <!-- Search Section -->
            <section class="md:py-3">
                <form action="#">
                    <div class="flex items-center rounded custom-shadow">
                        <input
                            class="w-full p-3 font-[Poppins] outline-none bg-white search placeholder-[#A31621]"
                            type="text"
                            name="query"
                            placeholder="Search"
                        />
                        <Search />
                    </div>
                </form>
            </section>

            <!-- Filter Buttons -->
            <section class="w-full">
                <p class="m-0 font-[Poppins] text-xs">Filter</p>
                <div class="flex gap-2 overflow-x-auto snap-x snap-mandatory scrollbar-hide pb-2">
                    <Link
                        href="/menu"
                        :class="[
                            'border p-3 min-w-[120px] md:flex-1 rounded font-[Rethink_Sans] hover:bg-[#A31621] hover:text-white hover:border-white transition duration-300 ease-in-out text-center',
                            !props.currentCategory ? 'bg-[#A31621] text-white' : 'bg-white'
                        ]"
                    >
                        All
                    </Link>
                    <Link
                        v-for="category in props.categories"
                        :key="category.id"
                        :href="'/menu/' + category.id"
                        :class="[
                            'border p-3 min-w-[120px] md:flex-1 rounded font-[Rethink_Sans] hover:bg-[#A31621] hover:text-white hover:border-white transition duration-300 ease-in-out text-center',
                            props.currentCategory == category.id ? 'bg-[#A31621] text-white' : 'bg-white'
                        ]"
                    >
                        {{ category.name }}
                    </Link>
                </div>
            </section>

            <!-- Food Items -->
            <section v-if="!props.currentCategory" v-for="category in props.categories" :key="category.id" class="space-y-3">
                <h2 class="text-4xl font-extrabold font-[Dancing_Script] m-0">{{ category.name }}</h2>
                <p class="font-[Rethink_Sans]">{{ category.description }}</p>
                <div class="flex gap-3">
                    <div :ref="el => scrollContainers[category.id] = el" class="flex gap-4 overflow-x-auto snap-x snap-mandatory scrollbar-hide pb-2">
                        <div class="flex justify-center items-center">
                            <div v-if="isLargeScreen" class="p-5 absolute left-6 flex justify-center btn-container rounded">
                                <button @click="() => scrollLeft(category.id)" class="scroll-btn z-50">
                                    <i class="fa-solid fa-caret-left text-2xl text-[#A31621]"></i>
                                </button>
                            </div>
                        </div>
                        <div v-for="food in props.foods.filter(f => f.category_id === category.id)" :key="food.id" class="min-w-[300px] max-w-[300px] h-96 flex-shrink-0 rounded shadow-md bg-white snap-start dish-container">
                            <img :src="food.image" :alt="food.name" class="w-full h-64 object-cover rounded-t-md mx-auto"/>
                            <div class="p-3 box-border">
                                <h1 class="text-base font-bold font-[Poppins]">{{ food.name }}</h1>
                                <p class="text-xs text-gray-600 font-[Rethink_Sans]">{{ food.description }}</p>
                                <h3 class="text-sm font-bold font-[Rethink_Sans]">
                                    ₱{{ formatPrice(food.price) }}
                                </h3>
                                <Order @click="handleOrderNow(food.id)" />
                            </div>
                        </div>
                        <div class="flex justify-center items-center">
                            <div v-if="isLargeScreen" class="p-5 absolute right-6 flex justify-center btn-container rounded">
                                <button @click="() => scrollRight(category.id)" class="scroll-btn z-50">
                                    <i class="fa-solid fa-caret-right text-2xl text-[#A31621]"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section v-else>
                <div class="flex gap-3">
                    <div ref="scrollContainer" class="flex gap-4 overflow-x-auto snap-x snap-mandatory scrollbar-hide pb-2">
                        <div class="flex justify-center items-center">
                            <div v-if="isLargeScreen" class="p-5 absolute left-6 flex justify-center btn-container rounded">
                                <button @click="scrollLefts" class="scroll-btn">
                                    <i class="fa-solid fa-caret-left text-2xl text-[#A31621]"></i>
                                </button>
                            </div>
                        </div>
                        <div v-for="food in props.foods" :key="food.id" class="min-w-[300px] max-w-[300px] h-96 flex-shrink-0 rounded shadow-md bg-white snap-start dish-container">
                            <img :src="food.image" :alt="food.name" class="w-full h-64 object-cover rounded-t-md mx-auto"/>
                            <div class="p-3 box-border">
                                <h3 class="text-base font-semibold font-[Poppins]">{{ food.name }}</h3>
                                <p class="text-xs text-gray-600 font-[Rethink_Sans]">{{ food.description }}</p>
                                <p class="text-sm font-bold font-[Rethink_Sans]">₱{{ formatPrice(food.price) }}</p>
                                <Order @click="handleOrderNow(food.id)" />
                            </div>
                        </div>
                        <div class="flex justify-center items-center">
                            <div v-if="isLargeScreen" class="p-5 absolute right-6 flex justify-center btn-container rounded">
                                <button @click="scrollRights" class="scroll-btn">
                                    <i class="fa-solid fa-caret-right text-2xl text-[#A31621]"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div v-if="props.foods.length === 0" class="text-center">
                <p class="text-gray-500 text-lg font-[Poppins]">
                    No {{ getCategoryName(props.currentCategory) }} Found!
                </p>
            </div>
        </main>

        <div>
            <Modal v-if="showModal" @close="showModal = false" @goToLogin="goToLogin">
                <div class="p-4 flex flex-col justify-center">
                    <div class="flex flex-col justify-center items-center">
                        <img :src="'/Images/hamburger.png'" alt="Hamburger" class="w-30 h-30"/>
                        <div>
                            <h1 class="font-extrabold text-3xl font-[Poppins]">Oops! Hungry?</h1>
                            <p class="font-[Rethink_Sans] mb-3">You need to log in first before adding this delicious meal to your cart!</p>
                        </div>
                        <button @click="goToLogin" class="bg-[#A31621] text-white px-4 py-3 rounded w-full mt-3 font-[Poppins] font-normal hover:cursor-pointer">Login</button>
                    </div>
                </div>
            </Modal>
        </div>
    </App>
</template>