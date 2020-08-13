<template>
    <div class="video-section" @click="selectVideo">
        <video v-if="video" id="videoContainer" autoplay>
            <source :src="video">
            Your browser does not support HTML5 video.
        </video>
        <i v-else class="fa fa-upload upload-icon"></i>
        <input ref="videoUploadInput" type="file" name="file" style="display: none" v-on:change="onFileChange" accept="video/*">
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
            video () {
                return this.$store.state.sections[this.index].video
            },
        },
        methods: {
            selectVideo(){
                this.$refs.videoUploadInput.click()
            },
            onFileChange(e) {
                const file = e.target.files[0];
                let video = URL.createObjectURL(file);
                this.$store.commit('updateSection', {index: this.index, video})
                if(document.getElementById("videoContainer"))
                    document.getElementById("videoContainer").load();
            }
        }
    }
</script>
