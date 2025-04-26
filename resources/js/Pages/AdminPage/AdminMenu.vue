<script setup>
// import { ref, onMounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
// import axios from 'axios';
import Admin from '../MainLayout/Admin.vue';

const { foods, categories } = usePage().props

const getCategoryName = (categoryId) => {
    if (!categories) return 'Loading...';
    const category = categories.find(c => c.id === categoryId);
    return category ? category.name : 'Uncategorized';
};

const formatPrice = (price) => {
    // Handle null/undefined cases
    if (price === null || price === undefined) return '0.00';
    
    // Convert string to number if needed
    const num = typeof price === 'string' ? parseFloat(price) : price;
    
    // Safely format the number
    return isNaN(num) ? '0.00' : num.toFixed(2);
};



</script>

<template>
    <Admin>
        <main class="px-5 pt-[6rem] h-auto py-5 flex flex-col gap-3 font-[Poppins]">
            <div class="bg-white shadow-sm p-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">Menu</h1>
                    <Link href="/admin/menu/create" class="bg-[#A31621] text-white px-4 py-2 rounded-lg hover:bg-[#8a1320] transition">
                        <i class="fa-solid fa-plus-circle mr-1"></i>
                        Add New Item
                    </Link>
                </div>
            </div>

            <!-- Full Management Section -->
            <div class="">
                <!-- Admin Menu Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Iterate over the foods array to display data -->
                            <tr v-for="food in foods" :key="food.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img 
                                                class="h-10 w-10 rounded-full object-cover" 
                                                :src="food.image" 
                                                :alt="food.name"
                                            >
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">{{ food.name }}</div>
                                            <div class="text-sm text-gray-500 line-clamp-1 font-[Rethink_Sans]">{{ food.description }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-[Rethink_Sans]">
                                    {{ getCategoryName(food.category_id) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-[Rethink_Sans]">
                                    ₱{{ formatPrice(food.price) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span 
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" 
                                        :class="food.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                    >
                                        {{ food.is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <Link :href="`/admin/menu/${food.id}/edit`" class="flex-1 text-white bg-[#2196F3] text-center rounded p-2"
                                        >
                                            <i class="fa-solid fa-pen mr-1"></i>
                                            Edit
                                            
                                        </Link>
                                        <button @click="toggleStatus(food)"class="flex-1 text-white bg-[#FFC72C] rounded p-2">
                                            <i class="fa-solid fa-circle-check mr-1"></i>
                                            {{ food.is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                        <button @click="confirmDelete(food.id)" class="text-white flex-1 bg-[#A31621] rounded p-2"
                                        >
                                            <i class="fa-solid fa-trash mr-1"></i>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </Admin>
</template>