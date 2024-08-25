<script>
import { router } from "@inertiajs/vue3";
import { useForm } from '@inertiajs/vue3';
export default{
    props:{
        postList: Object,
    },
    data(){
        return {
            form: useForm({
                postTitle:"",
                postAuthor:"",
                postPublicationDate:"",
                anyThing:"",
            }),
        }
    },
    methods: {
        deletePostHandler(postId){
            // console.log(postId);
            router.delete(route("post.delete", postId));
        },
        editPostHandler(postId){
            // console.log(postId);
            router.get(route("post.edit", postId));
        },
        searchHandler(){
            this.form.get(route("post.list"));
            // console.log(this.form.search);
            // console.log(this.props.post);
        }
    },
    mounted(){
        // console.log(this.postList);
    }
};

</script>

<template>

    <section class="mx-auto w-full max-w-7xl px-4 py-4">
        <div class="mt-6 flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="flex justify-center items-center text-white text-lg min-w-full py-4">
                        Post List
                    </div>
                    <div class="flex justify-center items-center py-2 ">
                        <a href="/post/create" class="bg-blue-500 text-white p-2 m-2 text-center rounded-md">Back</a>
                        <input 
                        type="text"
                        placeholder="Search By Title" 
                        class="text-slate-400 p-2 md:rounded-lg border-none m-2"
                        v-model="form.postTitle">
                        <input 
                        type="text"
                        placeholder="Search By Author" 
                        class="text-slate-400 p-2 md:rounded-lg border-none m-2"
                        v-model="form.postAuthor">
                        <input
                        type="text"
                        placeholder="Search By PublicationDate" 
                        class="text-slate-400 p-2 md:rounded-lg border-none m-2"
                        v-model="form.postPublicationDate">
                        <input 
                        type="text"
                        placeholder="Search ..." 
                        class="text-slate-400 p-2 md:rounded-lg border-none m-2"
                        v-model="form.anyThing">
                        <button @click="searchHandler" class="bg-green-500 text-white p-2 m-2 text-center rounded-md">Search</button>
                    </div>
                    <div class="overflow-hidden  md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class=" px-8 py-3.5  text-gray-900 text-center">
                                        id
                                    </th>
                                    <th scope="col" class=" px-12 py-3.5 text-gray-900 text-center">
                                        Title
                                    </th>
                                    <th scope="col" class=" px-4 py-3.5 text-center  text-gray-900">
                                        Author
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-center  text-gray-900">
                                        Publication Date
                                    </th>
                                    <th scope="col" class=" relative px-4 py-3 content-end text-center">
                                        <span class="text-gray-900">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-for="post in postList.data" class="divide-y divide-gray-200 bg-white ">
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-4 text-center ">
                                        <div class="ml-4">
                                            <div class="text-gray-900 ">
                                                <!-- id -->
                                                {{ post.id }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-12 py-4 text-center">
                                        <!-- title   -->
                                        {{ post.title }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-center">
                                        <span class="inline-flex ">
                                            <!-- author name -->
                                            {{ post.author }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-center">
                                        <!-- publication date -->
                                        {{ post.publication_date }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-center">
                                        <a href="#" class="text-white p-2 m-2 text-center rounded-md bg-red-600" @click="deletePostHandler(post.id)">
                                            Delete
                                        </a>
                                        <a href="#" class="text-white p-2 m-2 text-center rounded-md bg-blue-500" @click="editPostHandler(post.id)">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-4 flex justify-center items-center space-x-2">
                            <a 
                                v-for="link in postList.links" 
                                :key="link.label" 
                                :href="link.url" 
                                class="text-blue-500 hover:text-blue-700 px-4 py-2 rounded-md"
                                v-html="link.label"
                            ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>