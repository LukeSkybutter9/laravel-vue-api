<template>
    <div class="container-tarjeta flex flex-col md:flex-row">
        <div class="tarjeta" 
        :class="{ 'selected': selectedIds.includes(articulo.id) }"  
        v-for="articulo in articulos" 
        :key="articulo.id"
        @click="toggleSelect(articulo.id)"
    >
                <img :src="'data:image/jpeg;base64,' + articulo.image" alt="Artículo" class="card-img " />
                <h3>{{ articulo.name }}</h3>
                <p>{{ articulo.content }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CardComponent",
        data(){
            return {
                articulos:[], //componente reactivo de las tarjetas
                selectedIds: [], //array reactivo de ids de las tarjetas seleccionadas
            };
        },
        mounted() {
            this.fetchArticulos(); //definicion de metodo usado para hacer la peticion a la api
            this.$eventBus.$on('articuloGuardado', this.fetchArticulos);
            this.$eventBus.$on('delete-selected', this.deleteSelected);
        },
        methods:{
            async fetchArticulos() {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/articulos'); //peticion a la api
                this.articulos = response.data;
            } catch (error) {
                console.error("Error fetching articulos:", error);
            }
        },
        toggleSelect(id) {
            // Alternar la selección de una tarjeta agregando el id al array selectedIds
            if (this.selectedIds.includes(id)) {
                this.selectedIds = this.selectedIds.filter(selectedId => selectedId !== id);
            } else {
                this.selectedIds.push(id);
            }
        },
        async deleteSelected() {
            try {
                // Realizar una petición DELETE para cada tarjeta seleccionada
                await Promise.all(this.selectedIds.map(async (id) => {
                    await axios.delete(`http://127.0.0.1:8000/api/articulos/${id}`);
                }));
                // Actualizar la lista de tarjetas
                this.articulos = this.articulos.filter(articulo => !this.selectedIds.includes(articulo.id));
                this.selectedIds = []; // Limpiar la selección
            } catch (error) {
                console.error("Error eliminando articulos:", error);
            }
        }
    }
}
</script>

<style scoped>
.container-tarjeta{
    display: flex;
    justify-content: center;
    gap: 1em;
}

.tarjeta {
    border: 1px solid #ddd;
    border-radius: 14px;
    padding: 33px;
    width: auto;
    height: 38vh;
    margin-bottom: 16px;
    display: flex;
    flex-direction: column;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.tarjeta:hover{
    transform: scale(1.05);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}

.tarjeta.selected {
    border: 2px solid #0078d7;
    box-shadow: 0 0 10px #0078d7;
}

.card-img {
    height: 13em;
    width: auto;
    margin-bottom: 16px;
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.tarjeta:hover .card-img{
    transform: scale(1.1);
}

</style>