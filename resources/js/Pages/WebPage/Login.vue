<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

import App from "../MainLayout/App.vue";

</script>

<template>
    <App>
        <main class="px-5 pt-[7rem] h-auto py-10 flex justify-center">
            <div class="w-[30vw] flex flex-col justify-center gap-10 py-10 px-10 bg-white rounded shadow-md">
                <div>
                    <h1 class="text-3xl font-bold font-[Poppins]">Login</h1>
                    <p class="text-sm font-[Rethink_Sans]">Log in to place orders, reserve online, and enjoy a seamless dining experience.</p>
                </div>
                <form action="#" >
                    <div class="flex flex-col justify-center">
                        <label class="font-semibold font-[Poppins] text-xs" for="email">Email</label>
                        <input type="text" placeholder="johndoe@gmail.com" class="bg-white rounded shadow-md p-4 mb-2 font-[Rethink_Sans] placeholder:text-xs">

                        <label class="font-semibold font-[Poppins] text-xs" for="email">Password</label>
                        <input type="password" placeholder="Password" class="bg-white rounded shadow-md  p-4 mb-2 font-[Rethink_Sans] placeholder:text-xs">
                        <div class="flex justify-between mb-10">
                            <div class="flex gap-1">
                                <input type="checkbox" id="remember-me" name="remember-me" value="remember-me" class="custom-checkbox">
                                <label class="font-[Rethink_Sans] text-xs" for="remember-me">Remember me</label>
                            </div>
                            <Link class="font-[Rethink_Sans] text-xs text-[#A31621]">Forgot Password</Link>
                        </div>
                        <button class="text-white p-4 rounded mb-2 font-[Poppins] bg-[#A31621]">Login</button>
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