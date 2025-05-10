<script setup>
const emit = defineEmits(['cart'])

const addToCart = () => {
    emit('cart')
}
</script>

<template>
    <div class="">
        <button class="h-full w-full p-3 bg-[#FFC72C] rounded flex justify-center items-center">
            <i class="fa-solid fa-cart-plus text-white"></i>
        </button>
    </div>
</template>