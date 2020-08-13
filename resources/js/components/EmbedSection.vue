<template>
    <div class="new-section">
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
            }
        },
        methods: {
        }
    }
</script>
