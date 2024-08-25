<template>
    <div class="flex flex-col justify-center items-center ">
        <h1 class="text-slate-500">{{count}}</h1>
        <button class="rounded bg-red-400 p-2 my-3 text-neutral-50"@click="increment">increment</button>
        <button class="rounded bg-red-400 p-2 my-3 text-neutral-50"@click="decrement">decrement</button>
    </div>
    <div class="flex justify-center items-center flex-col">
        <img v-bind:src="url" alt="random image" class="h-30 w-20 ">
        <div :class="className" class="text-white">shorthand of v-bind => : </div>
        <div v-if="condition1" class="text-white">Condition1 : true</div>
        <div v-else-if="condition2" class="text-white">condition2 : true</div>
        <div v-else class="text-white">condition1 and condition2  : false</div>
        <div v-if="text.includes('some')" class="text-white">The text includes the word 'some'</div>
        <div v-show="showDiv" class="text-white">This div tag can be hidden</div>
        <ul class="text-white">
            <li v-for="(element, index) in arr">{{index}}: {{ element }}</li>
        </ul>
        <!-- <ul>
            <img v-for="img in images" :src="img">
        </ul> -->
            <!-- <img :src="this.clickedImg" alt="images">
            <ul>
                <li v-for="food in manyFoods" @click = "this.getImg(food.url)" class="text-white">{{ food.name }}</li>
            </ul> -->

            <img :src="imgUrl" alt="images">
            <ul>
                <li v-for="food in manyFoods" @click = "imgUrl = food.url" class="text-white">{{ food.name }}</li>
            </ul>

            
    </div>

    <!-- <div class=""></div> -->
</template>
<script>
    export default{
        data(){
            return {
                imgUrl: "",
                clickedImg:'',
                count: 0,
                url: "https://picsum.photos/200",
                className: "m-5 h-auto w-40 text-center rounded bg-yellow-700 text-amber-950",
                condition1: false,
                condition2: true,
                text: "some random text",
                showDiv: true,
                arr: ["f1", "gt", "rider", "sp", "st"],
                images: ["https://picsum.photos/200", "https://picsum.photos/200/300/?blur", "https://picsum.photos/200/300.jpg", "https://picsum.photos/id/237/200/300"],
                manyFoods: [
                    {name: 'Burrito', url: 'https://picsum.photos/200'},
                    {name: 'Salad', url: 'https://picsum.photos/200/300/?blur'},
                    {name: 'Cake', url: 'https://picsum.photos/200/300.jpg'},
                    {name: 'Soup', url: 'https://picsum.photos/id/237/200/300'}
                ],
            }
        },
        methods: {
            getImg(img){
                this.clickedImg=img
            },
            increment (){
                this.count++;
            },
            decrement (){
                this.count--;
            },
        },
    };
</script>

