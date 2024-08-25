<template>
    <!-- <div class="text-center">
        <label>Select date</label>
        <datepicker v-model="typeable"  typeable/>
    </div> -->
    <br/>
    <div class="text-center">
        <label class="text-white">Select date</label>
        <datepicker v-model="picked" 
        :upperLimit="to"
        :lowerLimit="from"
        :weekweekStartsOn="2"
        :clearable="false"/>
    </div>
    <!-- <div>{{ to }}</div>
    <div>{{ from }}</div> -->
</template>

<script>
import Datepicker from 'vue3-datepicker';

export default {
    components: {
        Datepicker
    },
    data(){
        return {
            picked: new Date("2024-05-28"),
            to: new Date("2024-08-02"),
            from: new Date("2024-02-16"),
        }
    }
}
</script>