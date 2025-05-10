<script setup>
import Admin from '../MainLayout/Admin.vue';
</script>

<template>
    <Admin>
        <main class="px-5 pt-[6rem] h-auto py-5 flex flex-col gap-3">
            <div class="bg-white shadow-sm p-4 rounded mb-1">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800 font-[Poppins]">About Us</h1>
                </div>
            </div>
            <section class="shadow-sm bg-white rounded flex h-[75vh] mb-10">
                <div class="w-[50vw] p-4 flex justify-center items-center flex-col gap-5">
                    <h1 class="mb-5 font-[Poppins] text-3xl font-bold">About</h1>
                    <p class="font-[Rethink_Sans] text-lg">
                        <span class="font-extrabold">DineEase</span>
                        is a modern and user-centered food ordering system built to streamline the way customers interact with restaurants. Whether customers want to dine in, or take out. <span class="font-extrabold">DineEase</span> offers a smooth and convenient experience by allowing them to browse menus, or place orders. The platform not only benefits customers with its easy-to-use interface but also helps restaurant staff manage and process orders efficiently. By reducing manual work and organizing transactions digitally, <span class="font-extrabold">DineEase</span> bridges the gap between customers and food service providers, ensuring fast, accurate, and satisfying service.
                    </p>
                </div>
                <div class="w-[50vw] bg-[#A31621] flex justify-center items-center">
                    <p class="font-bold text-[1.3em] sm:text-xl md:text-2xl lg:text-8xl font-[Poppins] flex justify-center items-center text-white">Dine<span class="text-[#FFC72C]">Ease</span>
                    </p> 
                </div>
            </section>
            <section class="shadow-sm bg-white rounded flex h-[80vh] my-15">
                <div class="w-[50vw]">
                    <img :src="'/Images/sideimg.jpeg'" alt="Login" class="h-full">
                </div>
                <div class="w-[50vw] p-4 flex justify-center items-center flex-col gap-5">
                    <h1 class="mb-5 font-[Poppins] text-3xl font-bold">Menu</h1>
                    <p class="font-[Rethink_Sans] text-lg">
                        The Menus section in DineEase is designed to give customers a clear and interactive view of the food offerings available at the restaurant. Each menu item is carefully categorized — such as appetizers, main dishes, beverages, and desserts — making it easier for users to browse and choose what they want to order.
                        With high-quality images, detailed descriptions, and real-time availability, the Menus section enhances the ordering experience by helping customers make informed decisions. Customers can also customize their orders (e.g., adding toppings or choosing portion sizes) before adding items to their cart.
                        For restaurant staff, the menu management system provides a simple way to update items, adjust pricing, and control visibility — all through an intuitive admin panel. This ensures that the menu always reflects the latest offerings and availability.
                    </p>
                </div>
                
            </section>
            <section class="shadow-sm bg-white rounded flex h-[80vh] mb-15">
                <div class="w-[50vw] p-4 flex justify-center items-center flex-col gap-5">
                    <h1 class="mb-5 font-[Poppins] text-3xl font-bold">Mission</h1>
                    <p class="font-[Rethink_Sans] text-lg">
                        Our mission is to revolutionize the traditional food ordering process by providing a digital solution that is fast, reliable, and accessible. DineEase aims to enhance the overall dining experience by empowering customers with control over their orders while assisting restaurant staff with a more organized and effective order management system.
                        We are committed to creating a seamless and enjoyable process from the moment a customer places an order to the moment it’s served — all through the power of technology.
                    </p>
                </div>
                <div class="w-[50vw]">
                    <img :src="'/Images/sideimg3.webp'" alt="Login" class="h-full">
                </div>
            </section>
            <section class="shadow-sm bg-white rounded flex h-[80vh] mt-10">
                <div class="w-[50vw]">
                    <img :src="'/Images/sideimg2.jpeg'" alt="Login" class="h-full">
                </div>
                <div class="w-[50vw] p-4 flex justify-center items-center flex-col gap-5">
                    <h1 class="mb-5 font-[Poppins] text-3xl font-bold">Vision</h1>
                    <p class="font-[Rethink_Sans] text-lg">
                        Our vision is to become a trusted leader in digital food ordering platforms by continuously improving how people connect with food services. We aim to support restaurants in transitioning to smarter systems while giving users an effortless and enjoyable way to order meals.
                        DineEase envisions a future where every dining experience — whether casual or formal — is made easier, faster, and more satisfying through innovation, simplicity, and user-focused design.
                    </p>
                </div>
            </section>
        </main>
    </Admin>
</template>