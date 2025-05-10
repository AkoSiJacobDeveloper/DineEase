<script setup>
import { router } from '@inertiajs/vue3'

const emit = defineEmits(['order'])

const orderNow = () => {
    emit('order')
}

</script>

<template>
    <div class="">
        <button class="w-full p-3 bg-[#A31621] text-white text-sm font-[Poppins] rounded hover:cursor-pointer">Order Now</button>
    </div>
</template> 