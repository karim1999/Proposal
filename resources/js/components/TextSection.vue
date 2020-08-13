<template>
    <div class="editor-container">
        <ckeditor :editor="editor" :value="text" @input="updateText" :config="editorConfig"></ckeditor>
    </div>
</template>

<script>
    require('./../ckeditor')
    export default {
        components: {
        },
        props: [
            'index',
        ],
        data: function(){
            return {
                editor: InlineEditor,
                editorConfig: {
                    toolbar: {
                        items: [
                            'heading',
                            '|',
                            'bold',
                            'italic',
                            'link',
                            // 'bulletedList',
                            // 'numberedList',
                            '|',
                            // 'indent',
                            // 'outdent',
                            // '|',
                            // 'imageUpload',
                            // 'blockQuote',
                            // 'insertTable',
                            'undo',
                            'redo',
                            'fontFamily',
                            'fontSize',
                            'fontColor',
                            'fontBackgroundColor',
                            'alignment',
                            // 'horizontalLine'
                        ]
                    },
                    language: 'en',
                    image: {
                        toolbar: [
                            'imageTextAlternative',
                            'imageStyle:full',
                            'imageStyle:side'
                        ]
                    },
                    table: {
                        contentToolbar: [
                            'tableColumn',
                            'tableRow',
                            'mergeTableCells',
                            'tableCellProperties',
                            'tableProperties'
                        ]
                    },
                }
            }
        },
        computed: {
            section () {
                return this.$store.state.sections[this.index]
            },
            text () {
                return this.$store.state.sections[this.index].text
            },
        },
        methods: {
            updateText(text){
                this.$store.commit('updateSection', {index: this.index, text})
            }
        }
    }
</script>
