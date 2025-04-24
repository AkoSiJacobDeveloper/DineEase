<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3'; // Inertia Validation and Submission
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

import App from "../MainLayout/App.vue";

const form = useForm({ // Form Handling
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <App>
        <Head title="Login" />
        <main class="px-5 pt-[7rem] h-auto py-10 flex justify-center">
            <div class="w-[30vw] flex flex-col justify-center gap-10 py-10 px-10 bg-white rounded shadow-md">
                <div>
                    <h1 class="text-3xl font-bold font-[Poppins]">Login</h1>
                    <p class="text-sm font-[Rethink_Sans]">Log in to place orders, reserve online, and enjoy a seamless dining experience.</p>
                </div>
                <!-- Prevent Default Form Submission -->
                <form @submit.prevent="submit"> 
                    <div class="flex flex-col justify-center">
                        <label class="font-semibold font-[Poppins] text-xs" for="email">Email</label>
                        <input v-model="form.email" type="text" placeholder="johndoe@gmail.com" class="bg-white rounded shadow-md p-4 mb-2 font-[Rethink_Sans] placeholder:text-xs text-xs":class="{ 'border-red-500': form.errors.email }">
                        <p v-if="form.errors.email" class="text-red-500 text-xs font-[Rethink_Sans]">
                            {{ form.errors.email }}
                        </p>

                        <label class="font-semibold font-[Poppins] text-xs" for="email">Password</label>
                        <input v-model="form.password" type="password" placeholder="Password" class="bg-white rounded shadow-md  p-4 mb-2 font-[Rethink_Sans] placeholder:text-xs text-xs":class="{ 'border-red-500': form.errors.email }">
                        <p v-if="form.errors.password" class="text-red-500 text-xs font-[Rethink_Sans]">
                            {{ form.errors.password }}
                        </p>

                        <div class="flex justify-between mb-10">
                            <div class="flex gap-1">
                                <input v-model="form.remember" type="checkbox" id="remember-me" name="remember-me" value="remember-me" class="custom-checkbox" required>
                                <label class="font-[Rethink_Sans] text-xs" for="remember-me">Remember me</label>
                            </div>
                            <Link :href="route('password.request')" class="font-[Rethink_Sans] text-xs text-[#A31621]">Forgot Password</Link>
                        </div>
                        <button class="text-white text-sm p-3 rounded mb-2 font-[Poppins] bg-[#A31621]" :disabled="form.processing">Login</button>
                    </div>
                </form>
                <div class="flex justify-center">
                    <p class="font-[Rethink_Sans] text-xs">Dont have an account? <Link href="/signup"><span class="text-[#A31621] font-bold">Sign Up</span></Link></p>
                </div>
            </div>
            <div>
                <img :src="'/Images/login.png'" alt="Login" class="hidden lg:block w-[35vw] h-[80vh]">
            </div>
        </main>
    </App>
</template>