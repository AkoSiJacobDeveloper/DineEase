<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import axios from 'axios';
import AppLayout from '../MainLayout/App.vue';

const { props } = usePage();
const tables = computed(() => props.tables || []);

const formFields = [
    { label: 'Full Name', id: 'name', type: 'text', placeholder: 'John Doe' },
    { label: 'Phone Number', id: 'phone', type: 'tel', placeholder: '09505478679' },
    { label: 'Email Address', id: 'email', type: 'email', placeholder: 'johndoe@gmail.com' },
    { label: 'Number of Guest', id: 'guests', type: 'number', min: 1, max: 20, placeholder: '1-20' }
];


const availableTables = computed(() => {
    return tables.value.filter(table => table.is_available);
});

const form = useForm({
    name: '',
    phone: '',
    email: '',
    guests: '',
    table_id: null, // Changed from 'table' to 'table_id' for consistency
    date: '',
    message: ''
});


function confirmOrder() {
    form.post(route('reservation.store'), {
        preserveScroll: true,
        onSuccess: () => {
            alert('Reservation successful. A confirmation email has been sent.');
            form.reset();
        },
        onError: (errors) => {
            if (errors.table) {
                alert(errors.table);
            }
        }
    });
}
</script>

<template>
    <AppLayout> <!-- Changed from <App> to <AppLayout> -->
        <main class="px-5 pt-[6rem] h-screen lg:h-screen py-5">
            <div class="bg-white shadow-sm p-4 rounded mb-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800 font-[Poppins]">Reservation</h1>
                </div>
            </div>
            <section class="">
                <div class="reservation-container shadow-sm bg-white rounded">
                    <!-- Removed any problematic comments -->
                    <div class="p-7">
                        <p class="text-lg lg:text-5xl font-extrabold font-[Dancing_Script]">
                            Your Table Is Just a Click Away
                        </p>
                        <p class="text-xs lg:text-sm font-[Rethink_Sans]">
                            Quick, easy reservations to make your dining stress-free and special.
                        </p>
                    </div>
                    <div class="px-5 pb-5 grid grid-cols-1 md:grid-cols-2">
                        <div class="p-2 flex flex-col gap-2">
                            <div v-for="field in formFields" :key="field.id">
                                <label class="block font-[Poppins]" :for="field.id">{{ field.label }}</label>
                                <input
                                    v-model="form[field.id]"
                                    class="block border p-3 w-full rounded font-[Rethink_Sans] outline-0 border-gray-300 focus:outline focus:outline-[#A31621]"
                                    :type="field.type"
                                    :id="field.id"
                                    :min="field.min"
                                    :max="field.max"
                                    :placeholder="field.placeholder"
                                />
                                <p v-if="form.errors[field.id]" class="text-red-500 text-sm mt-1">
                                    {{ form.errors[field.id] }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <div class="p-2">
                                <label class="block font-[Poppins]">Select Reservation Date</label>
                                <Datepicker v-model="form.date" />
                                <p v-if="form.errors.date" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.date }}
                                </p>
                            </div>
                            <div class="p-2">
                                <label for="table" class="font-[Poppins]">Choose an Available Table:</label>
                                <select
                                    id="table"
                                    v-model="form.table_id"
                                    class="rounded p-3 w-full border border-gray-300 focus:outline focus:outline-[#A31621] font-[Poppins]"
                                    >
                                    <option disabled :value="null">Select a table</option>
                                    <option
                                        v-for="table in availableTables"
                                        :key="table.id"
                                        :value="table.id"
                                    >
                                        {{ table.table_number }}
                                    </option>
                                </select>
                                <p v-if="form.errors.table" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.table }}
                                </p>
                            </div>
                            <div class="px-2 pt-2">
                                <label class="block font-[Poppins]" for="message">
                                    Special Request <span class="text-xs text-[#A31621]">[Optional]</span>
                                </label>
                                <textarea
                                    v-model="form.message"
                                    class="border border-gray-300 w-full resize-none bg-red p-3 lg:h-[17vh] rounded font-[Rethink_Sans] focus:outline focus:outline-[#A31621]"
                                    id="message"
                                    placeholder="Your message here..."
                                ></textarea>
                                <p v-if="form.errors.message" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.message }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end px-7 pb-7">
                        <button
                            @click="confirmOrder"
                            :disabled="form.processing"
                            class="p-3 bg-[#A31621] text-white rounded hover:bg-[#8a1020] font-[Rethink_Sans] disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span v-if="form.processing">Processing...</span>
                            <span v-else>Reserve Table</span>
                        </button>
                    </div>
                </div>
            </section>
        </main>
    </AppLayout>
</template>