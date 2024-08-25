<script>
import Component1 from './Component1.vue';
export default {
    components:{
        Component1
    },
    data(){
        return{
            foods: ['f2', 'f3', 'f4', 'f5']
        }
    }
}

</script>
<template>
    <div class="text-white">
        <Component1  prop-name="updated name" prop-data="note1" :is-True="true"/>
        <p>end</p>
        <Component1  prop-data="updated data" :is-True="false"/>
        <p>end</p>
        <Component1  prop-data="updated data" :is-True="true"/>
        <p>end</p>
        <Component1  prop-data="not4" />
        <p>end</p>
        <Component1 v-for="food in foods" :food-name="food" prop-data="data23"/>
        <p>end</p>
    </div>
</template>