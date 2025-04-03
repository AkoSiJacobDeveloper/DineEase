<script setup>
import { ref } from 'vue';

const testimonials = ref([
    { comment: "I love how easy it is to order my favorite meals! The interface is simple, and I received my food on time. Definitely using this again!", commenter: "Sophia Reyes"},
    { comment: "Booking a table has never been this easy. No more waiting in line—just a few clicks, and my spot is reserved", commenter: "Mark Villanueva"},
    { comment: "The delivery tracking feature is amazing. I knew exactly when my food would arrive. Highly recommend!", commenter: "Angela Cruz"},
    { comment: "I’m not very tech-savvy, but this website made ordering food so simple. Even my grandparents could use it!", commenter: "David Mendoza"}
])
</script>

<template>
    <div class="lg:h-screen lg:flex justify-center items-center flex-col">
        <div class="text-center py-6">
            <p class="font-bold text-2xl lg:text-5xl font-[Dancing_Script]">What Our Customer Says</p>
            <p class="font-regular text-xs lg:text-sm font-[Rethink_Sans]">Real Feedback from Food Lovers like you.</p>
        </div>
        <div class="flex overflow-x-auto snap-x snap-mandatory scrollbar-hide md:grid md:grid-cols-4 md:gap-4 md:place-items-center py-5 md:overflow-visible lg:grid-cols-2 lg:grid-rows-2">
            <div v-for="(testimonial, index) in testimonials" :key="index" class="shadow-lg lg:shadow-2xl px-2 flex-shrink-0 w-full   h-full md:w-auto md:h-full bg-[#fff] rounded">
                <div class="flex justify-center items-center flex-col h-90 gap-5 p-2 lg:h-60 lg:w-80">
                    <div class="h-40 flex justify-center items-center">
                        <p class="font-[Rethink_Sans] italic">{{ testimonial.comment }}</p>
                    </div>
                    <p class="font-bold font-[Poppins] text-center">
                        {{ testimonial.commenter }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>