import 'es6-promise/auto'
import Vuex from 'vuex'
import CKEditor from '@ckeditor/ckeditor5-vue'
import draggable from 'vuedraggable'

Vue.use(Vuex)
Vue.use( CKEditor );

const TEXT_DEFAULT= '<h2 style="margin-left:0px;">What is Lorem Ipsum?</h2><p style="margin-left:0px;"><strong>Lorem Ipsum</strong><span style="background-color:rgb(255,255,255);color:rgb(0,0,0);"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy</span></p>'
const store = new Vuex.Store({
    state: {
        "sections": [
            {
                type: "new",
                text: TEXT_DEFAULT,
                image: "",
                video: "",
            },
        ]
    },
    mutations: {
        addSection(state, index){
            console.log("Adding a section after index ", index)
            let newSection = {
                type: "new",
                text: TEXT_DEFAULT,
                image: "",
                video: "",
            }
            state.sections.splice(index + 1, 0, newSection)
        },
        setSectionType(state, payload){
            console.log(payload.index)
            Vue.set(state.sections, payload.index, {...state.sections[payload.index], type: payload.type})
        },
        deleteSection(state, index){
            if(state.sections.length != 1){
                console.log("Removing the section with index ", index)
                state.sections.splice(index, 1)
            }
        },
        updateSection(state, payload){
            Vue.set(state.sections, payload.index, {...state.sections[payload.index], ...payload})
        },
        sortSections(state, value){
            state.sections= value
        }
    }
})
const app = new Vue({
    el: '#app',
    store,
    components: {
        draggable,
    },
    computed: {
        sections: {
            get() {
                return this.$store.state.sections
            },
            set(value) {
                console.log(value)
                this.$store.commit('sortSections', value)
            }
        }
    },
});
