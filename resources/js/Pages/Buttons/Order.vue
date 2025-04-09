<script setup>
const emit = defineEmits(['order'])

const orderNow = () => {
  emit('order')
}
</script>

<template>
    <div class="flex w-full gap-1">
        <button class="w-4/5 p-3 bg-[#A31621] text-white text-sm font-[Poppins] rounded hover:cursor-pointer" @click="orderNow">Order Now</button>
        <button class="w-1/5 bg-[#FFC72C] rounded flex justify-center items-center">
            <i class="fa-solid fa-cart-plus text-white"></i>
        </button>
    </div>
</template> 