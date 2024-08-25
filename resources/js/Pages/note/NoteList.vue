<script setup>
import Vue3EasyDataTable from "vue3-easy-data-table";
import "vue3-easy-data-table/dist/style.css";
import { router } from "@inertiajs/vue3";
import ResponseDiv from "./ResponseDiv.vue";

const props = defineProps({
    noteList: Object,
});

const headers = [
    { text: "TITLE", value: "title", sortable: true },
    { text: "TEXT", value: "text", sortable: true },
    { text: "ACTIONS", value: "act", sortable: false, width: 300 },
];

console.log(props.noteList);

const deleteNoteHandler = (noteId) => {
    router.delete(route("note.delete", noteId));
};
</script>
<template>
    <div class="noteList">
        <ResponseDiv />
        <div class="tableContainer mx-auto mt-10">
            <Vue3EasyDataTable
                buttons-pagination
                table-class-name="customize-table"
                :headers="headers"
                :items="props.noteList"
                theme-color="#4c2f48"
            >
                <template #item-act="item">
                    <span
                        class="bg-red-800 px-2 py-1.5 text-white cursor-pointer rounded-sm"
                        @click="deleteNoteHandler(item.id)"
                        >Delete</span
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
