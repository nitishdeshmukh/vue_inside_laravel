<script setup>
import { usePage } from "@inertiajs/vue3";
const page = usePage();
</script>

<template>
    <div>
        <div
            v-if="page.props.flash.success"
            class="bg-green-700 text-white p-3 mb-3 text-center text-sm font-semibold"
        >
            {{ page.props.flash.success }}
        </div>
        <div
            v-if="page.props.flash.error"
            class="bg-red-700 text-white p-3 mb-3 text-center text-sm font-semibold"
        >
            {{ page.props.flash.error }}
        </div>
        <div
            v-if="page.props.flash.errors?.length"
            class="bg-red-700 text-white p-3 mb-3 text-center text-sm font-semibold"
        >
            <div v-for="errorBag in page.props.flash.errors">
                <span v-for="error in errorBag">{{ error }}</span>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
