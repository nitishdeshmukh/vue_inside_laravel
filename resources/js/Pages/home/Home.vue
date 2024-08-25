<script setup>
import { Link } from "@inertiajs/vue3";
import { appStore } from "../../Store/app_store";
const appStr = appStore();
</script>

<template>
    <div class="h-screen flex items-center justify-center gap-3">
        <p
            @click="appStr.showAlert()"
            class="p-2 text-gray-300 bg-red-700 rounded-sm cursor-pointer"
        >
            Show Info
        </p>
        <Link
            :href="route('note.create.page')"
            class="p-2 text-white bg-green-600 rounded-sm cursor-pointer"
            >Create Note Here!</Link
        >
        <Link
            :href="route('post.create.page')"
            class="p-2 text-white bg-blue-500 rounded-sm cursor-pointer"
            >Create Post Here!</Link>
    </div>
</template>

