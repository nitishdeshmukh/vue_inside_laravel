<template>
    <form @submit.prevent="addItems" class="">
        <label class="text-white">Order Here:</label><br/>

        <label for="dinner" class="text-white "> <input type="radio" name="radioBtn" value="Dinner" id="dinner" v-model="itemType" class=""> Dinner</label><br/>

        <label for="drink" class="text-white "> <input type="radio" name="radioBtn" value="Drink" id="drink" v-model="itemType" class=""> Drink</label><br/>

        <label for="dessert" class="text-white "> <input type="radio" name="radioBtn" value="Dessert" id="dessert" v-model="itemType" class=""> Dessert</label><br/>

        <label for="snack" class="text-white "> <input type="radio" name="radioBtn" value="Snack" id="snack" v-model="itemType" class=""> Snack</label><br/>

        <div class="text-slate-400 " v-show="itemType">
        
        <select name="" id="" v-model="itemName" @change="assign($event)">
            <option value="" selected disabled>select item</option>

            <option v-for="item in preDefItems" v-show="item.type === itemType" :value="item.name" :url="item.imgUrl">{{ item.name }}</option>
            
        </select>
        <div v-show="itemUrl">
            <img :src="itemUrl" :alt="itemUrl">
        </div>
    
        <div v-show="itemName">

            <input type="text" v-model="itemNumber" placeholder="How many?">

        </div>

    </div>

        <button class="rounded text-white bg-orange-800 p-2 m-5">Order</button>

    </form>

    <div class="text-white bg-neutral-900 h-auto p-4 w-60">

        <h4>Your Order:</h4>

        <!-- {{ itemNumber }} : {{ itemType }} : {{ itemName }} -->
        <div class="text-white">{{ order }}</div>

    </div>
</template>

<script>
    export default {
        data(){
            return{
                itemName: null,
                itemType: null,
                itemUrl: null,
                itemNumber:null,
                preDefItems: [
                    { name: 'Burrito', type: 'Dinner', imgUrl: 'img_burrito.svg' },
                    { name: 'Pizza', type: 'Dinner', imgUrl: 'img_pizza.svg' },
                    { name: 'Pho Soup', type: 'Dinner', imgUrl: 'img_soup.svg' },
                    { name: 'Spaghetti', type: 'Dinner', imgUrl: 'img_spaghetti.svg' },
                    { name: 'Fish', type: 'Dinner', imgUrl: 'img_fish.svg' },
                    { name: 'Cake', type: 'Dessert', imgUrl: 'img_cake.svg' },
                    { name: 'Rice', type: 'Dinner', imgUrl: 'img_rice.svg' },
                    { name: 'Salad', type: 'Dinner', imgUrl: 'img_salad.svg' },
                    { name: 'Coke', type: 'Drink', imgUrl: 'img_soda.svg' },
                    { name: 'Green Soda', type: 'Drink', imgUrl: 'img_greenSoda.svg' },
                    { name: 'Doughnut', type: 'Dessert', imgUrl: 'img_doughnut.svg' },
                    { name: 'Ice Cream', type: 'Dessert', imgUrl: 'img_iceCream.svg' },
                    { name: 'Lemonade', type: 'Drink', imgUrl: 'img_lemonade.svg' },
                    { name: 'Pancakes', type: 'Dessert', imgUrl: 'img_pancakes.svg' },
                    { name: 'Water', type: 'Drink', imgUrl: 'img_water.svg' }
                ],
                order: {}
            }
        },
        methods : {
            addItems(){
                this.order.name = this.itemName
                this.order.number = this.itemNumber
                this.order.type= this.itemType
                this.order.Url= this.itemUrl
            },
            assign(e){
                this.itemUrl = e.target.options[e.target.selectedIndex].getAttribute('url')
            }
        }
    }
</script>