<script setup>
import { defineProps, ref, computed } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';

import App from '../MainLayout/App.vue';
import Order from '../Buttons/Order.vue';
import Modal from '../Modal/Modal.vue';
import Cart from '../Buttons/Cart.vue';
import CartModal from '../Modal/CartModal.vue';

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
    foods: {
        type: [Object, Array], // Allow Object (paginated) or Array (non-paginated)
        default: () => ({ data: [] }), // Default to empty paginated structure
    },
    currentCategory: {
        type: [String, Number],
        default: null,
    }
});

const formatPrice = (price) => {
    if (price === null || price === undefined) return '0.00';
    const num = typeof price === 'string' ? parseFloat(price) : price;
    return isNaN(num) ? '0.00' : num.toFixed(2);
};

const showModal = ref(false);
const isModalOpen = ref(false);
const page = usePage();

const handleAddToCart = () => {
    isModalOpen.value = true;
}

const closeModal = () => {
    isModalOpen.value = false;
};

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

// Pagination navigation
const goToPage = (url) => {
    if (url) {
        router.visit(url, {
            preserveState: true,
            preserveScroll: true,
            only: ['foods'],
        });
    }
};

// Computed property to handle foods data
const foodItems = computed(() => {
    return Array.isArray(props.foods) ? props.foods : (props.foods?.data || []);
});

// Computed pagination properties with defaults
const pagination = computed(() => ({
    current_page: props.foods?.current_page || 1,
    last_page: props.foods?.last_page || 1,
    prev_page_url: props.foods?.prev_page_url || null,
    next_page_url: props.foods?.next_page_url || null,
}));

const backToMenu = () => {
    router.visit('/menu');
};
</script>

<template>
    <App>
        <main class="px-5 pt-[6rem] h-auto py-5 flex flex-col gap-3">
            <div class="bg-white shadow-sm p-4 rounded">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800 font-[Poppins]">Menu</h1>
                </div>
            </div>
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

            <!-- Pagination Controls -->
            <section v-if="foodItems.length" class="flex justify-end items-center gap-2 pb-[8px]">
                <button
                    :disabled="!pagination.prev_page_url"
                    @click="goToPage(pagination.prev_page_url)"
                    class="px-4 py-2 bg-[#A31621] text-white rounded disabled:bg-gray-300 font-[Rethink_Sans]"
                >
                    Previous
                </button>
                <span class="text-sm font-[Rethink_Sans]">
                    Page {{ pagination.current_page }} of {{ pagination.last_page }}
                </span>
                <button
                    :disabled="!pagination.next_page_url"
                    @click="goToPage(pagination.next_page_url)"
                    class="px-4 py-2 bg-[#A31621] text-white rounded disabled:bg-gray-300 font-[Rethink_Sans]"
                >
                    Next
                </button>
            </section>

            <!-- Food Items -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div
                    v-for="food in foodItems"
                    :key="food.id"
                    class="w-full h-96 rounded shadow-md bg-white dish-container"
                >
                    <img
                        :src="food.image"
                        :alt="food.name"
                        class="w-full h-64 object-cover rounded-t-md mx-auto"
                    />
                    <div class="p-3 box-border">
                        <h3 class="text-base font-semibold font-[Poppins]">{{ food.name }}</h3>
                        <p class="text-xs text-gray-600 font-[Rethink_Sans] line-clamp-2">{{ food.description }}</p>
                        <p class="text-sm font-bold font-[Rethink_Sans]">₱{{ formatPrice(food.price) }}</p>
                        <div class="flex gap-1">
                            <Order class="w-5/6" @click="handleOrderNow(food.id)" />
                            <Cart class="w-1/6" @click="handleAddToCart" />
                        </div>
                        
                    </div>
                </div>
            </section>

            <!-- No Dishes Found -->
            <div v-if="!foodItems.length" class="text-center">
                <p class="text-gray-500 text-lg font-[Poppins]">
                    No Dishes Found!
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

        <div>
            <CartModal v-if="isModalOpen" @close="closeModal">
                <div class="p-4 flex flex-col justify-center">
                    <div class="flex flex-col justify-center items-center">
                        <img :src="'/Images/development.png'" alt="Development" class="w-60 h-60"/>
                        <div>
                            <h1 class="font-extrabold text-3xl font-[Poppins]">Oops! Sorry</h1>
                            <p class="font-[Rethink_Sans] mb-3 text-sm">This feature is currently under development. Stay tuned!</p>
                        </div>
                        <button @click="backToMenu" class="bg-[#A31621] text-white px-4 py-3 rounded w-full mt-3 font-[Poppins] font-normal hover:cursor-pointer">Okay</button>
                    </div>
                </div>
            </CartModal>
        </div>
    </App>
</template>

<style scoped>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>