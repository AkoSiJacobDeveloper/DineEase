<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'; // Inertia Validation and Submission
import { Head } from '@inertiajs/vue3';

import App from '../MainLayout/App.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('signup'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <App>
        <Head title="Sign Up" />
        <main class="h-auto flex">
            <div class="w-2/3">
                <img :src="'/Images/sideimg.jpeg'" alt="Signup" class="">
            </div>
            <div class="w-1/3 flex justify-center items-center gap-10 p-5">
                <div class="h-auto flex flex-col justify-center gap-10 bg-white rounded shadow-md py-10 px-10 mt-16">
                    <div>
                        <p class="font-bold text-[1.3em] sm:text-xl md:text-2xl lg:text-3xl font-[Poppins] flex justify-center items-center text-[#A31621] mb-10">
                            Dine<span class="text-[#FFC72C]">Ease</span>
                        </p>
                        <h1 class="text-lg font-bold font-[Poppins] text-center">Sign Up</h1>
                        <p class="text-xs font-[Rethink_Sans] text-center">Sign up to order your favorite dishes and reserve a table in seconds!</p>
                    </div>
                    <form @submit.prevent="submit">
                        <div class="flex flex-col justify-center">
                            <label class="font-semibold font-[Poppins] text-xs" for="email">Full Name</label>
                            <input v-model="form.name" type="text" placeholder="John Doe" class="bg-white rounded shadow-md p-3 mb-3 font-[Rethink_Sans] placeholder:text-xs text-xs"  :class="{ 'border-red-500': form.errors.email }">
                            <p v-if="form.errors.name" class="text-red-500 text-xs font-[Rethink_Sans]">
                                {{ form.errors.name }}
                            </p>

                            <label class="font-semibold font-[Poppins] text-xs" for="email">Email Address</label>
                            <input v-model="form.email" type="text" placeholder="johndoe@gmail.com" class="bg-white rounded shadow-md p-3 mb-3 font-[Rethink_Sans] placeholder:text-xs text-xs"  :class="{ 'border-red-500': form.errors.email }">
                            <p v-if="form.errors.email" class="text-red-500 text-xs font-[Rethink_Sans]">
                                {{ form.errors.email }}
                            </p>
                            
                            <div class="flex w-full gap-2">
                                <div class="flex flex-col">
                                    <label class="font-semibold font-[Poppins] text-xs" for="email">Password</label>
                                    <input v-model="form.password" type="password" placeholder="Password" class="bg-white rounded shadow-md w-full p-3 mb-3 font-[Rethink_Sans] placeholder:text-xs text-xs"  :class="{ 'border-red-500': form.errors.password }">
                                    <p v-if="form.errors.password" class="text-red-500 text-xs font-[Rethink_Sans]">
                                        {{ form.errors.password }}
                                    </p>
                                </div>
                                
                                <div class="flex flex-col">
                                    <label class="font-semibold font-[Poppins] text-xs" for="email">Confirm Password</label>
                                    <input v-model="form.password_confirmation" type="password" placeholder="Confirm Password" class="bg-white rounded shadow-md w-full p-3 mb-3 font-[Rethink_Sans] placeholder:text-xs text-xs"  :class="{ 'border-red-500': form.errors.password_confirmation }">
                                    <p v-if="form.errors.password_confirmation" class="text-red-500 text-xs font-[Rethink_Sans]">
                                        {{ form.errors.password_confirmation }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-1 mb-5">
                                <input type="checkbox" id="agree" name="agree" value="agree" class="custom-checkbox" >
                                <label class="font-[Rethink_Sans] text-xs" for="remember-me">I agree to the Terms & Conditions</label>
                            </div>

                            <button type="submit" class="text-white text-sm p-3 rounded font-[Poppins] bg-[#A31621]" :disabled="form.processing">Signup</button>
                        </div>
                    </form>
                    <div class="flex justify-center">
                        <p class="font-[Rethink_Sans] text-xs">I have already an account <Link href="/login"><span class="text-[#A31621] font-bold">Login</span></Link></p>
                    </div>
                </div>
            </div>
        </main>
    </App>
</template>