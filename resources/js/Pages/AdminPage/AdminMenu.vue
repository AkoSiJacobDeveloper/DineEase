<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

import Admin from '../MainLayout/Admin.vue';
import EditModal from '../Modal/EditModal.vue';
import AddModal from '../Modal/AddModal.vue';

const { foods, categories } = usePage().props;

const getCategoryName = (categoryId) => {
    if (!categories) return 'Loading...';
    const category = categories.find(c => c.id === categoryId);
    return category ? category.name : 'Uncategorized';
};

const formatPrice = (price) => {
    if (price === null || price === undefined) return '0.00';
    const num = typeof price === 'string' ? parseFloat(price) : price;
    return isNaN(num) ? '0.00' : num.toFixed(2);
};

const isEditModalOpen = ref(false);
const isAddModalOpen = ref(false);
const selectedFood = ref(null);
const newFood = ref({
    name: '',
    description: '',
    category_id: '',
    price: '',
    image: null
});

const openEditModal = (food) => {
    selectedFood.value = { ...food }; // Clone to avoid mutating props
    isEditModalOpen.value = true;
};

const openAddModal = () => {
    isAddModalOpen.value = true;
    newFood.value = { name: '', description: '', category_id: '', price: '', image: null }; // Reset form
};

const closeEditModal = () => {
    isEditModalOpen.value = false;
    selectedFood.value = null;
};

const closeAddModal = () => {
    isAddModalOpen.value = false;
};

const saveChanges = (updatedFood) => {
    const payload = {
        name: updatedFood.name,
        description: updatedFood.description || '',
        price: updatedFood.price
    };
    console.log('Saving payload:', payload);
    Inertia.patch(`/admin/menu/${updatedFood.id}`, payload, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: (page) => {
            console.log('Update success:', page.props);
            const success = page.props.flash?.success;
            if (success) {
                alert(success);
            }
            closeEditModal();
        },
        onError: (errors) => {
            console.error('Update errors:', errors);
            alert('Failed to update dish: ' + Object.values(errors).join(', '));
        }
    });
};

const addNewDish = () => {
    const formData = new FormData();
    formData.append('name', newFood.value.name);
    formData.append('description', newFood.value.description || '');
    formData.append('category_id', newFood.value.category_id);
    formData.append('price', newFood.value.price);
    if (newFood.value.image) {
        formData.append('image', newFood.value.image);
    }

    for (let [key, value] of formData.entries()) {
        console.log(`${key}:`, value);
    }

    Inertia.post('/admin/menu', formData, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: (page) => {
            console.log('Add dish success:', page.props);
            const success = page.props.flash?.success;
            if (success) {
                alert(success);
            }
            closeAddModal();
        },
        onError: (errors) => {
            console.error('Add dish errors:', errors);
            alert('Failed to add dish: ' + Object.values(errors).join(', '));
        }
    });
};

const handleImageChange = (event) => {
    newFood.value.image = event.target.files[0] || null;
    console.log('Selected image:', newFood.value.image);
};

const confirmDelete = (foodId) => {
    if (confirm('Are you sure you want to delete this dish?')) {
        Inertia.delete(`/admin/menu/${foodId}`, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: (page) => {
                console.log('Delete success:', page.props);
                const success = page.props.flash?.success;
                if (success) {
                    alert(success);
                }
            },
            onError: (errors) => {
                console.error('Delete errors:', errors);
                alert('Failed to delete dish: ' + Object.values(errors).join(', '));
            }
        });
    }
};
</script>

<template>
    <Admin>
        <main class="px-5 pt-[6rem] h-auto py-5 flex flex-col gap-3 font-[Poppins]">
            <div class="bg-white shadow-sm p-4 rounded">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">Menu</h1>
                    <button @click="openAddModal" class="bg-[#A31621] text-white px-4 py-2 rounded-lg hover:bg-[#8a1320] transition">
                        <i class="fa-solid fa-plus-circle mr-1"></i>
                        Add New Dish
                    </button>
                </div>
            </div>

            <!-- Full Management Section -->
            <div>
                <!-- Admin Menu Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dish</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="food in foods" :key="food.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img 
                                                class="h-10 w-10 rounded-full object-cover" 
                                                :src="food.image || '/images/placeholder.jpg'" 
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
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button @click="openEditModal(food)" class="cursor-pointer flex-1 text-white bg-[#FFC72C] text-center rounded p-2">
                                            <i class="fa-solid fa-pen mr-1"></i>
                                            Edit
                                        </button>
                                        <button @click="confirmDelete(food.id)" class="cursor-pointer text-white flex-1 bg-[#A31621] hover:bg-[#8a1320] transition rounded p-2">
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

        <EditModal v-if="isEditModalOpen" @close="closeEditModal">
            <section>
                <h2 class="text-xl font-bold mb-4 font-[Poppins]">Edit Dish</h2>
                <form @submit.prevent="saveChanges(selectedFood)" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 text-left font-[Poppins]">Name</label>
                        <input
                            v-model="selectedFood.name"
                            type="text"
                            required
                            class="p-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 font-[Rethink_Sans]"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 text-left font-[Poppins]">Description</label>
                        <textarea
                            rows="6"
                            v-model="selectedFood.description"
                            class="resize-none p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-[56px] font-[Rethink_Sans]"
                        ></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 text-left font-[Poppins]">Price</label>
                        <input
                            v-model="selectedFood.price"
                            type="number"
                            step="0.01"
                            required
                            class="p-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 font-[Rethink_Sans]"
                        />
                    </div>
                    <div class="flex justify-end space-x-4">
                        <div class="flex gap-1">
                            <button
                                type="button"
                                @click="closeEditModal"
                                class="flex-1 px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 font-[Poppins] cursor-pointer"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="flex-1 px-4 py-2 bg-[#A31621] text-white rounded hover:bg-[#8a1320] font-[Poppins] cursor-pointer"
                            >
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </EditModal>

        <AddModal v-if="isAddModalOpen" @close="closeAddModal">
            <section>
                <h2 class="text-xl font-bold mb-4 font-[Poppins]">Add New Dish</h2>
                <form @submit.prevent="addNewDish" class="space-y-4">
                    <div class="flex gap-3">
                        <div class="flex flex-col flex-1">
                            <label class="block text-sm font-medium text-gray-700 text-left font-[Poppins]">Name</label>
                            <input
                                v-model="newFood.name"
                                type="text"
                                required
                                class="p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 font-[Rethink_Sans]"
                            />
                        </div>
                        <div class="flex flex-col flex-1">
                            <label class="block text-sm font-medium text-gray-700 text-left font-[Poppins]">Description</label>
                            <textarea
                                rows="2"
                                v-model="newFood.description"
                                class="resize-none p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-[48px] font-[Rethink_Sans]"
                            ></textarea>
                        </div>
                    </div>
                    
                    <div class="flex gap-3">
                        <div class="flex flex-col flex-1">
                            <label class="block text-sm font-medium text-gray-700 text-left font-[Poppins]">Category</label>
                            <select
                                v-model="newFood.category_id"
                                required
                                class="p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 font-[Rethink_Sans]"
                            >
                                <option value="" disabled>Select a category</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                        <div class="flex flex-col flex-1">
                            <label class="block text-sm font-medium text-gray-700 text-left font-[Poppins]">Price</label>
                            <input
                                v-model="newFood.price"
                                type="number"
                                step="0.01"
                                required
                                class="p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 font-[Rethink_Sans]"
                            />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 text-left font-[Poppins]">Dish Image</label>
                        <input
                            type="file"
                            accept="image/*"
                            @change="handleImageChange"
                            class="p-3 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 font-[Rethink_Sans]"
                        />
                    </div>
                    <div class="flex justify-end space-x-4">
                        <div class="flex gap-1">
                            <button
                                type="button"
                                @click="closeAddModal"
                                class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 font-[Poppins] cursor-pointer"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="px-4 py-2 bg-[#A31621] text-white rounded hover:bg-[#8a1320] font-[Poppins] cursor-pointer"
                            >
                                Add Dish
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </AddModal>
    </Admin>
</template>