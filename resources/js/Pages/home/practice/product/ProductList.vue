<script setup>
import Vue3EasyDataTable from "vue3-easy-data-table";
import "vue3-easy-data-table/dist/style.css";
import { router } from "@inertiajs/vue3";
import ResponseDiv from "./ResponseDiv.vue";

const props = defineProps({
    productList: Object,
});

const headers = [
    { text: "Name", value: "name", sortable: true },
    { text: "Quantity", value: "quantity", sortable: true },
    { text: "Price", value: "price", sortable: true },
    { text: "Actions", value: "act", sortable: false, width: 300 },
];

console.log(props.productList);

const deletePostHandler = (productId) => {
    router.delete(router("product.delete", productId));
};

const editProductHandler = (productId) => {
    router.edit(router("product.edit", productId));
};

</script>
<template>
    <div class="h-screen">
        <ResponseDiv />
        <div class="tableContainer mx-auto mt-10">
            <Vue3EasyDataTable
                buttons-pagination
                table-class-name="customize-table"
                :headers="headers"
                :items="props.productList"
                theme-color="#4c2f48"
            >
                <template #item-act="item" class="">
                    <span
                        class="bg-red-800 mx-4 px-2 py-1.5 text-white cursor-pointer rounded-sm"
                        @click="deletePostHandler(item.id)"
                        >Delete</span
                    >
                    <span
                        class="bg-red-800 mx-4 px-2 py-1.5 text-white cursor-pointer rounded-sm"
                        @click="editProductHandler(item.id)"
                        >Edit</span
                    >
                </template>
            </Vue3EasyDataTable>
        </div>
    </div>
</template>

<style scoped>
.noteList {
    height: 100vh;
}
.textContainer {
    transition: 0.2s ease;
}
.textContainer:hover {
    transform: scale(1.02);
}
.tableContainer {
    width: 50%;
    max-height: 30rem;
}
</style>
