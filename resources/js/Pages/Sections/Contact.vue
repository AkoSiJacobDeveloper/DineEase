<script setup>
import { ref } from 'vue';

import { PhoneArrowDownLeftIcon, InboxIcon, MapPinIcon } from '@heroicons/vue/24/solid';
import Submit from '../Buttons/Submit.vue';
</script>

<template>
    <div class="lg:h-screen lg:flex justify-center items-center flex-col py-5">
        <div class="text-center py-6">
            <p class="font-bold text-2xl lg:text-5xl font-[Dancing_Script]">Visit Us? Or Get In Touch</p>
            <p class="font-regular text-xs lg:text-sm font-[Rethink_Sans]">Need assistance? We're here to help</p>
        </div>
        <div class="w-full h-full lg:w-[60vw] lg:h-[60vh] rounded flex flex-col lg:flex lg:flex-row bg-[#fff] shadow-lg lg:shadow:2xl">
            <div class="w-full h-96 lg:h-full lg:w-1/3 rounded  bg-[#A31621] p-4 flex flex-col justify-around text-white">
                <div class="flex justify-center flex-col text-center lg:text-start">
                    <p class="font-[Poppins] text-3xl lg:text-3xl font-bold">Contact Us</p>
                    <p class="font-[Rethink_Sans] text-sm lg:text-xs">Have Questions? We're Here to Help!</p>
                </div>
                <div class="flex justify-center lg:justify-start">
                    <div class="flex flex-col gap-3 justify-center text-center">
                        <div class="flex gap-2">
                            <PhoneArrowDownLeftIcon class="h-6 w-6" />
                            <p class="m-0 font-[Rethink_Sans] text-xs flex justify-center items-center">+63 XXX XXX XXXX</p>
                        </div>
                        <div class="flex gap-2">
                            <InboxIcon class="h-6 w-6" />
                            <p class="m-0 font-[Rethink_Sans] text-xs flex justify-center items-center">dinease@gmail.com</p>
                        </div>
                        <div class="flex gap-2">
                            <MapPinIcon class="h-6 w-6" />
                            <p class="m-0 font-[Rethink_Sans] text-xs flex justify-center items-center">Tubigon, Bohol</p>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="flex gap-2 justify-center lg:justify-start">
                    <i class="fa-brands fa-facebook fa-lg"></i>
                    <i class="fa-brands fa-twitter fa-lg"></i>
                    <i class="fa-brands fa-square-instagram fa-lg"></i>
                </div>
            </div>
            <div class="w-full h-96 lg:w-2/3 lg:h-full p-4">
                <form action="">
                    <label class="block font-[Poppins] font-bold" for="fullname">Full Name</label>
                    <input class="border w-full p-3 rounded font-[Rethink_Sans]" type="text" name="fullname" id="fullname" placeholder="John Doe" required>

                    <label class="block font-[Poppins] font-bold" for="emailaddress">Email Address</label>
                    <input class="border w-full p-3 rounded font-[Rethink_Sans]" type="email" name="emailaddress" id="emailaddress" placeholder="johndoe@gmail.com" required>

                    <label class="block font-[Poppins] font-bold" for="message">Message</label>
                    <textarea class="p-3 rounded resize-none border w-full box-border h-32 lg:h-48" name="message" id="message" placeholder="Type your message here..."></textarea>

                    <Submit />
                </form>
            </div>
        </div>
    </div>
</template>