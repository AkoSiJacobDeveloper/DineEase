<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

import App from '../MainLayout/App.vue';
</script>

<template>
    <App>
        <main class="px-5 pt-[7rem] h-auto py-10 flex justify-center">
            <div class="w-[30vw] flex flex-col justify-center gap-5 py-10 px-10 bg-white rounded shadow-md">
                <div>
                    <h1 class="text-3xl font-bold font-[Poppins]">Signup</h1>
                    <p class="text-sm font-[Rethink_Sans]">Sign up to order your favorite dishes and reserve a table in seconds!</p>
                </div>
                <form action="#" >
                    <div class="flex flex-col justify-center">
                        <label class="font-semibold font-[Poppins] text-xs" for="email">Full Name</label>
                        <input type="text" placeholder="John Doe" class="bg-white rounded shadow-md p-3 mb-3 font-[Rethink_Sans] placeholder:text-xs">

                        <label class="font-semibold font-[Poppins] text-xs" for="email">Email Address</label>
                        <input type="text" placeholder="johndoe@gmail.com" class="bg-white rounded shadow-md p-3 mb-3 font-[Rethink_Sans] placeholder:text-xs">

                        <label class="font-semibold font-[Poppins] text-xs" for="email">Username</label>
                        <input type="text" placeholder="Johndoe" class="bg-white rounded shadow-md p-3 mb-3 font-[Rethink_Sans] placeholder:text-xs">

                        
                        <div class="flex w-full gap-2">
                            <div class="flex flex-col">
                                <label class="font-semibold font-[Poppins] text-xs" for="email">Password</label>
                                <input type="password" placeholder="Password" class="bg-white rounded shadow-md w-full p-3 mb-3 font-[Rethink_Sans] placeholder:text-xs">
                            </div>
                            
                            <div class="flex flex-col">
                                <label class="font-semibold font-[Poppins] text-xs" for="email">Confirm Password</label>
                                <input type="password" placeholder="Confirm Password" class="bg-white rounded shadow-md w-full p-3 mb-3 font-[Rethink_Sans] placeholder:text-xs">
                            </div>
                        </div>

                        <div class="flex gap-1 mb-5">
                            <input type="checkbox" id="agree" name="agree" value="agree" class="custom-checkbox">
                            <label class="font-[Rethink_Sans] text-xs" for="remember-me">I agree to the Terms & Conditions</label>
                        </div>

                        <button class="text-white p-4 rounded font-[Poppins] bg-[#A31621]">Login</button>
                    </div>
                </form>
                <div class="flex justify-center">
                    <p class="font-[Rethink_Sans] text-xs">I have already an account <Link href="/login"><span class="text-[#A31621] font-bold">Login</span></Link></p>
                </div>
            </div>
            <div>
                <img :src="'/Images/signup.png'" alt="Signup" class="hidden lg:block w-[35vw] h-[80vh]">
            </div>
        </main>
    </App>
</template>