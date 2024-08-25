<script>
import { useForm } from '@inertiajs/vue3';
import Datepicker from 'vue3-datepicker';

export default {
    props:{
        post: Object,
        hasPostId: Boolean,

    },
    components:{
        Datepicker
    },
    data(){
        return {
            form: useForm({
                title: this.post?.title || "",
                author: this.post?.author|| "",
                // publication_date: this.post?.publication_date || "",
                publication_date: this.post?.publication_date ? new Date(this.post.publication_date) : "",
                description: this.post?.description || "",
            }),
            // to: new Date("2024-08-02"),
            // from: new Date("2024-02-16"),
        };
    },
    methods: {
        addPostHandler(){
            const date = new Date(this.form.publication_date);
            this.form.publication_date= `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`;
            this.form.post(route("post.add"));
        },
        updatePostHandler(){
            // console.log(this.post.publication_date);
            const date = new Date(this.form.publication_date);
            this.form.publication_date= `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`;
            this.form.put(route("post.update",this.post.id));
        }
    },
    // mounted(){
    //     console.log(this.post)
    //     console.log(this.hasPostId)
    //     // console.log(this.hasPostId ? alert("ABC") : alert("abc"))
    // }
}

</script>

<template>
    <div class="h-screen flex flex-col items-center justify-center">
        <div class="w-90 flex flex-col p-2 border-solid border-2  border-red-200">
            <span class="text-center text-lg text-red-400">Post</span>
            <div class="mb-4">
                <label for="title" class="p-2 text-white">Title</label>
                <input type="text"
                placeholder="Enter title"
                v-model="form.title"
                class="p-2 text-slate-950 w-full rounded-sm outline-none" id="title"
                >
                <div class="text-red-500">
                    {{ form.errors.title }}
                </div>
            </div>
            <div class="mb-4">
                <label for="author" class="p-2 text-white">Author</label>
                <input type="text"
                placeholder="Enter author name"
                v-model="form.author"
                class="p-2 text-slate-950 w-full rounded-sm outline-none" id="author"
                >
                <div class="text-red-500">
                    {{ form.errors.author}}
                </div>
            </div>
            <div class="mb-4">
                <label for="pdate" class="p-2 text-white">Publication Date</label>
                <datepicker 
                    placeholder="Enter date"
                    v-model="form.publication_date"
                    :clearable="true" class="datePicker p-2 text-slate-950 w-full rounded-sm outline-none">
                </datepicker>
                <div class="text-red-500">
                    {{ form.errors. publication_date}}
                </div>
            </div>
            <div class="mb-4">
                <label for="description" class="p-2 text-white">Write content here</label>
                <textarea type="text"
                placeholder="write here.."
                v-model="form.description"
                class="p-2 text-slate-950 w-full rounded-sm outline-none" id="description"
                ></textarea>
                <div class="text-red-500">
                    {{ form.errors. description}}
                </div>
            </div>

            <button type="submit" class="text-neutral-200 rounded-sm p-2 bg-sky-600"
            @click="hasPostId ? updatePostHandler() : addPostHandler()">{{ hasPostId ? 'Update' : 'Create' }} Post</button>
        </div>
        <div class="p-5">
            <a href="/posts" class="bg-blue-500 text-white p-2 m-2 text-center rounded-md">Post List</a>
            <a href="/" class="bg-blue-500 text-white p-2 m-2 text-center rounded-md">Home</a>
        </div>
    </div>
</template>
