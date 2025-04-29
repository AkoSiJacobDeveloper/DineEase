<script setup>
import { ref } from 'vue';
import Admin from '../MainLayout/Admin.vue';
import EditModal from '../Modal/EditModal.vue';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-vue3';

const props = defineProps({
    orders: Array
});

const page = usePage();
const successMessage = ref('');
const errorMessage = ref('');

// Watch for flash messages
successMessage.value = page.props.flash?.success || '';
errorMessage.value = page.props.flash?.error || '';

// Currency formatter
const formatCurrency = (value) => {
    return '₱' + Number(value).toFixed(2);
};

// Capitalize payment method and status
const formatText = (text) => {
    if (!text) return '';
    return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
};

// Status color mapping
const statusColor = (status) => {
    switch (status) {
        case 'completed':
            return 'text-green-600';
        case 'cancelled':
            return 'text-[#A31621]';
        default:
            return 'text-gray-500';
    }
};

// Handle confirm and reject actions
const updateStatus = async (orderId, action) => {
    try {
        await Inertia.post(`/admin/orders/${orderId}/${action}`, {}, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                console.log(`${action} successful`);
                successMessage.value = page.props.flash?.success || `${action} successful`;
                errorMessage.value = '';
                Inertia.reload({ only: ['orders', 'flash'] });
            },
            onError: (errors) => {
                console.error(`${action} failed:`, errors);
                errorMessage.value = page.props.flash?.error || `Failed to ${action} order`;
                successMessage.value = '';
            }
        });
    } catch (error) {
        console.error(`Failed to ${action} order:`, error);
        errorMessage.value = `Failed to ${action} order`;
    }
};

// Debug orders data
console.log('Orders:', props.orders);
</script>

<template>
    <Admin>
        <main class="px-5 pt-[6rem] h-auto py-5 flex flex-col gap-3 font-[Poppins]">
            <section class="bg-white shadow-sm p-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">Orders</h1>
                </div>
            </section>

            <section v-if="successMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ successMessage }}
            </section>
            <section v-if="errorMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                {{ errorMessage }}
            </section>
            
            <section>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="w-full table-auto border-collapse min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dish</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Method</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="order in orders" :key="order.order_number">
                                <td class="px-6 py-4 whitespace-nowrap flex">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img 
                                                class="h-10 w-10 rounded-full object-cover"
                                                :src="order.image" 
                                                alt="Dish Image"
                                                @error="console.error('Image failed to load:', order.image)"
                                            >
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">{{ order.dish_name }}</div>
                                            <div class="text-sm text-gray-500 line-clamp-1 font-[Rethink_Sans]">{{ order.description }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-[Rethink_Sans]">{{ order.user_email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-[Rethink_Sans]">{{ formatText(order.payment_method) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-[Rethink_Sans]">{{ formatCurrency(order.total) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-[Rethink_Sans]">{{ order.order_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-[Rethink_Sans]" :class="statusColor(order.status)">
                                    {{ formatText(order.status) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-[Rethink_Sans]">
                                    <div class="flex gap-1">
                                        <button 
                                            v-if="order.status === 'pending'"
                                            @click="updateStatus(order.id, 'confirm')"
                                            class="bg-[#FFC72C] hover:bg-[#e6b800] transition cursor-pointer text-white p-2 rounded flex-1"
                                        >
                                            <i class="fa-solid fa-circle-check mr-1"></i>
                                            Confirm
                                        </button>
                                        <button 
                                            v-if="order.status === 'pending'"
                                            @click="updateStatus(order.id, 'reject')"
                                            class="bg-[#A31621] hover:bg-[#8a1320] transition cursor-pointer text-white p-2 rounded flex-1"
                                        >
                                            <i class="fa-solid fa-trash mr-1"></i>
                                            Reject
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="!orders.length">
                                <td colspan="7" class="px-4 py-2 text-center font-[Rethink_Sans] text-gray-500">No orders found.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>

        <div>
            <EditModal v-if="isModalOpen" @close="closeModal" />
        </div>
    </Admin>
</template>