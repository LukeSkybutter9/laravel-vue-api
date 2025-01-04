<template>
    <div class="container">
        <ul v-if="tarjetas.length">
            <li v-for="tarjeta in tarjetas" :key="tarjeta.id">{{ tarjeta.nombre }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                tarjetas:[
                {id:1, nombre:"Tarjeta 1"},
                {id:2, nombre:"Tarjeta 2"},
                {id:3, nombre:"Tarjeta 3"},
                ]
            };
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>