<template>
    <div class="new-section">
        <ul class="section-types-container">
            <li v-for="type in sectionTypes" @click="setType(type.value)">
                <img :src="type.image" alt="">
                <p>{{type.name}}</p>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: [
            'index',
        ],
        data: function(){
            return {
                "sectionTypes": [
                    {
                        name: "Text",
                        image: "/images/block-text.svg",
                        value: "text"
                    },
                    {
                        name: "Image",
                        image: "/images/block-image.svg",
                        value: "image"
                    },
                    {
                        name: "Video",
                        image: "/images/block-video.svg",
                        value: "video"
                    },
                    {
                        name: "Embed",
                        image: "/images/block-embed.svg",
                        value: "embed"
                    },
                ],
            }
        },
        computed: {
            section () {
                return this.$store.state.sections[this.index]
            }
        },
        methods: {
            setType(type){
                // console.log(this.index, type)
                this.$store.commit('setSectionType', {index: this.index, type})
            }
        }
    }
</script>
