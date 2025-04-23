<script setup>
import { ref } from 'vue';

const props = defineProps({
    item: Object,  
})

const emit = defineEmits(['update-quantity']);

const quantity = ref(props.item?.quantity || 1);

const increaseQuantity = () => {
    quantity.value++;
    emit('update-quantity', quantity.value);
};

const decreaseQuantity = () => {
    if(quantity.value > 1) {
        quantity.value--;
        emit('update-quantity', quantity.value);
    }
};
</script>

<template>
    <div class="flex lg:p-3">
        <button class="bg-gray-300 rounded w-[5vw] h-[4vh] md:w-[3vw] md:h-[4vh] lg:w-[2vw] lg:h-[5vh]" @click="decreaseQuantity(item)">
            <i class="fa-solid fa-minus text-white text-xs"></i>
        </button>
        <div class="p-3 md:p-1 w-[5vw] h-[4vh] md:w-[3vw] md:h-[4vh] lg:w-[2vw] lg:h-[5vh] flex justify-center items-center">
            <span class="m-0 font-[Poppins] text-xs">{{ quantity }}</span>
        </div>
        <button class="bg-gray-300 rounded w-[5vw] h-[4vh] md:w-[3vw] md:h-[4vh] lg:w-[2vw] lg:h-[5vh] font-bold" @click="increaseQuantity(item)">
            <i class="fa-solid fa-add text-white"></i>
        </button>
    </div>
</template>