<template>
    <div class="border-solid border-4 border-red-500 w-28">
        <h4>{{ name }}</h4>
        <h4>{{ message }}</h4>
        <h4>{{ propData }}</h4>
        <h4>{{ propName }}</h4>
        <h4>{{ isTrue }}</h4>
        <h4>{{ foodName }}</h4>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                name: "component1",
                message: "hello from component1",
            }
        },
        //props: ['propData', 'propName', 'isTrue']
        props: {
            propData: {
                type: String,
                required: true,
            },
            propName: String,
            isTrue: {
                type: Boolean,
                required: false,
                default: false,
            },
            foodName: {
                required: false,
            }
        }
    }
</script>