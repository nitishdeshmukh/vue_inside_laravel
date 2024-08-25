<script setup>
import { useForm } from "@inertiajs/vue3";
    const form = useForm({
        name: "",
        quantity: "",
        price:"",
    });

    const addProductHandler = () => {
        form.post(route("product.add"));
    };
</script>

<template>
    <div class="h-screen flex items-center justify-center">
        <div class="w-auto flex flex-col">
            <div class="container mb-4">
                <input
                    type="text"
                    placeholder="Enter name"
                    v-model="form.name"
                    class="p-2 bg-gray-200 text-black outline-none rounded-sm w-full"
                />
                <div v-if="form.errors.name" class="text-red-500">
                    {{ form.errors.name }}
                </div>
            </div>

            <div class="container mb-4">
                <input
                    type="text"
                    placeholder="Enter price"
                    v-model="form.price"
                    class="p-2 bg-gray-200 text-black outline-none rounded-sm w-full"
                />
                <div v-if="form.errors.price" class="text-red-500">
                    {{ form.errors.price }}
                </div>
            </div>

            <div class="container mb-4">
                <input
                    type="text"
                    placeholder="Enter quantity"
                    v-model="form.quantity"
                    class="p-2 bg-gray-200 text-black outline-none rounded-sm w-full"
                />
                <div v-if="form.errors.quantity" class="text-red-500">
                    {{ form.errors.quantity }}
                </div>
            </div>

            <button
                class="p-2 bg-teal-600 text-white outline-none mb-3 rounded-sm"
                @click="addProductHandler"
            >
                Add Product
            </button>
        </div>
    </div>
</template>