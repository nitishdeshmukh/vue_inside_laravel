<template>
    <form @submit.prevent="additem" class="text-center">
        <label for="name" class="text-white">Enter Name:</label><br/>
        <input type="text" name="name" id="name" v-model="itemName"><br/>
        <label for="number" class="text-white">Enter Number of Items:</label><br/>
        <input type="number" name="number" id="number" v-model="itemNumber"><br/>
        <button type="submit" class="rounded bg-red-400 p-2 m-5">Add Items</button>
    </form>
<!-- <h2>
    {{ itemName }} :  {{ itemNumber }}
</h2> -->
    <div class="text-whijte text-center">
        <ul>
            <li v-for="item in shopingList">
                {{ item.name }}
                {{ item.number }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                itemName: null,
                itemNumber: null,
                shopingList: [
                    {name: null, number: null}
                ]
            }
        },
        mounted() {
            alert("Mounted");
        },
        created() {
            alert("Created");
        },
        beforeCreate(){
            alert("BEFORE CREATE");
        },
        beforeMount(){
            alert("before mount");
        },
        methods:{
            additem(){
                let item = {
                    name: this.itemName,
                    number: this.itemNumber
                }
                this.shopingList.push(item)
                // this.itemName = null,
                // this.itemNumber = null
            }
        }
    }

</script>