<template>
    <div class="image-section" @click="selectImage">
        <img v-if="image" :src="image" alt="">
        <i v-else class="fa fa-upload upload-icon"></i>
        <input ref="imageUploadInput" type="file" style="display: none" name="file" v-on:change="onFileChange" accept="image/*">
    </div>
</template>

<script>
    export default {
        props: [
            'index',
        ],
        data: function(){
            return {
            }
        },
        computed: {
            section () {
                return this.$store.state.sections[this.index]
            },
            image () {
                return this.$store.state.sections[this.index].image
            },
        },
        methods: {
            selectImage(){
                this.$refs.imageUploadInput.click()
            },
            onFileChange(e) {
                const file = e.target.files[0];
                let image = URL.createObjectURL(file);
                console.log(image)
                this.$store.commit('updateSection', {index: this.index, image})
            }
        }
    }
</script>
