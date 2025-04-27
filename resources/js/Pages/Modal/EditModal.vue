<script setup>
const emit = defineEmits(['close', 'save'])
</script>


<template>
    <div class="fixed inset-0 flex items-center justify-center z-50 modal-container">
        <div class="bg-white p-6 rounded-lg shadow-md w-96 h-[60vh] text-center">
            <div class="flex justify-end">
                <button class="hover:cursor-pointer" @click="$emit('close')">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <slot></slot>
        </div>
    </div>
</template>

