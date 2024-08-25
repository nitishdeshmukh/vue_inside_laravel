<script>
import { useForm } from "@inertiajs/vue3";

export default {
    components: {
    },
    data() {
        return {
            form: useForm({
                title: "",
                text: "",
            }),
        };
    },
    methods: {
        addNoteHandler() {
            this.form.post(route("note.add"));
        },
    },
};
</script>

<template>
    <div class="h-screen flex items-center justify-center">
        <div class="w-80 flex flex-col">
            <div class="inputContainer mb-4">
                <input
                    type="text"
                    placeholder="Title"
                    v-model="form.title"
                    class="p-2 bg-gray-200 text-black outline-none rounded-sm w-full"
                />
                <div v-if="form.errors.title" class="text-red-500">
                    {{ form.errors.title }}
                </div>
            </div>

            <div class="inputContainer mb-4">
                <input
                    type="text"
                    placeholder="Text"
                    v-model="form.text"
                    class="p-2 bg-gray-200 text-black outline-none rounded-sm w-full"
                />
                <div v-if="form.errors.text" class="text-red-500">
                    {{ form.errors.text }}
                </div>
            </div>
            <button
                class="p-2 bg-teal-600 text-white outline-none mb-3 rounded-sm"
                @click="addNoteHandler"
            >
                Add Note
            </button>
        </div>
    </div>
</template>

<!-- <style scoped>
.form {
    width: 20rem;
}
.createNote {
    height: 100vh;
}
</style> -->
