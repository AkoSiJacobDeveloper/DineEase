<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import Admin from '../MainLayout/Admin.vue';

const { props } = usePage();

// Helper function to get category name
const getCategoryName = (categoryId) => {
    const category = props.categories.find(c => c.id === categoryId);
    return category?.name || 'Uncategorized';
};
</script>

<template>
    <Admin>
        <main class="px-5 pt-[6rem] h-auto py-5 flex flex-col gap-3 font-[Poppins]">
            <div class="bg-white shadow-sm sticky top-0 z-10 p-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">Menu Management</h1>
                    <Link href="/admin/menu/create" class="bg-[#A31621] text-white px-4 py-2 rounded-lg hover:bg-[#8a1320] transition">
                        + Add New Item
                    </Link>
                </div>
            </div>

            <!-- Full Management Section -->
            <div class="">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold">All Menu Items</h2>
                    <div class="relative">
                        <input 
                            type="text" 
                            placeholder="Search items..." 
                            class="pl-8 pr-4 py-2 border rounded-lg w-64"
                        >
                    </div>
                </div>

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
                            <tr v-for="food in props.foods" :key="food.id">
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
                                            <div class="text-sm font-medium text-gray-900">{{ food.name }}</div>
                                            <div class="text-sm text-gray-500 line-clamp-1">{{ food.description }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ getCategoryName(food.category_id) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ₱{{ food.price.toFixed(2) }}
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
                                        <Link 
                                            :href="`/admin/menu/${food.id}/edit`" 
                                            class="text-blue-600 hover:text-blue-900"
                                        >
                                            Edit
                                        </Link>
                                        <button 
                                            @click="toggleStatus(food)" 
                                            class="text-yellow-600 hover:text-yellow-900"
                                        >
                                            {{ food.is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                        <button 
                                            @click="confirmDelete(food.id)" 
                                            class="text-red-600 hover:text-red-900"
                                        >
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