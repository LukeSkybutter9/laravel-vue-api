<template>
    <div class="bg-white rounded-lg max-w-lg mx-auto">
        <form @submit.prevent="postArticulos" class="space-y-4">
            <div>
                <label for="name" class="text-md font-medium text-gray-700">Nombre:</label>
                <input type="text" id="name" v-model="formData.name"
                    class="mt-1 p-2 w-full border-gray-100 rounded-md shadow-sm">
            </div>
            <div>
                <label for="description" class="text-md font-medium text-gray-700">Descripción:</label>
                <input type="text" id="description" v-model="formData.description"
                    class="mt-1 p-2 w-full border-gray-100 rounded-md shadow-sm">
            </div>
            <div>
                <label for="price" class="text-md font-medium text-gray-700">Precio:</label>
                <input type="number" id="price" v-model="formData.price"
                    class="mt-1 p-2 w-full border-gray-100 rounded-md shadow-sm" min="1" step="1" required>
            </div>
            <div>
                <label for="quantity" class="text-md font-medium text-gray-700">Cantidad:</label>
                <input type="number" id="quantity" v-model="formData.quantity"
                    class="mt-1 p-2 w-full border-gray-100 rounded-md shadow-sm" min="1" step="1" required>
            </div>
            <div>
                <label for="image" class="text-md font-medium text-gray-700">Imagen:</label>
                <input type="file" id="image" @change="handleFileUpload"
                    class="mt-1 w-full text-sm text-gray-900 border border-gray-100 rounded-lg cursor-pointer">
            </div>
            <div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 ">
                    Enviar al carrito
                </button>
            </div>
            <div class="">
                <button 
                    type="button" 
                    class="w-full bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600"
                    @click="eliminarArticulos()"
                >
                    Eliminar del carrito
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "FormComponent",
        data(){
            return {
                formData: {
                    name: "",
                    description: "",
                    price: 0,
                    quantity: 1,
                    image: null,
                },
            };
        },
        methods:{
            handleFileUpload(event) {
                this.formData.image = event.target.files[0]; // Guardar el archivo
            },
            async postArticulos() {
                try {
                    const formData = new FormData();
                    formData.append('name', this.formData.name);
                    formData.append('description', this.formData.description);
                    formData.append('price', this.formData.price);
                    formData.append('quantity', this.formData.quantity);
                    if (this.formData.image) {
                        formData.append('image', this.formData.image);
                    }

                    const response = await axios.post('http://127.0.0.1:8000/api/articulos', formData, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    });

                    console.log('Artículo guardado:', response.data);
                    
                    // Emitir evento al event bus
                    this.$eventBus.$emit('articuloGuardado');

                } catch (error) {
                    if (error.response) {
                        console.error('Error en la solicitud:', error.response.data);
                    } else {
                        console.error('Error desconocido:', error);
                    }
                }
            },
            async eliminarArticulos(){
                this.$eventBus.$emit('delete-selected');
            }
        }
    }
</script>

<style scoped>
option{
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

input{
    border: 1px solid #ddd;
}

input:focus{
    outline: none;
    border: 1px solid #0078d7;
}

@font-face {
    font-family: "San Francisco";
    font-weight: 400;
    src: url("https://applesocial.s3.amazonaws.com/assets/styles/fonts/sanfrancisco/sanfranciscodisplay-regular-webfont.woff");
}
</style>
