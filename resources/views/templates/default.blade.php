@extends('layouts.template')

@section('title', 'Sections')
@section('content')
    <div id="app">
        <draggable v-model="sections">
            <transition-group name="slideDown"  enter-active-class="slideInDown" leave-active-class="slideOutUp">
                <div v-for="(section, index) in sections" :key="index" class="section">
                    <button v-if="sections.length != 1" @click="$store.commit('deleteSection', index)" class="control-btn delete-button">
                        <i class="fa fa-times-circle"></i>
                    </button>
                    <button @click="$store.commit('addSection', index)" class="control-btn add-button">
                        <i class="fa fa-plus-circle"></i>
                    </button>
                    <template v-if="section.type == 'new'">
                        <new-section :index="index" />
                    </template>
                    <template v-else-if="section.type == 'text'">
                        <text-section :index="index"/>
                    </template>
                    <template v-else-if="section.type == 'image'">
                        <image-section :index="index"/>
                    </template>
                    <template v-else-if="section.type == 'video'">
                        <video-section :index="index"/>
                    </template>
                    <template v-else-if="section.type == 'embed'">
                        <embed-section :index="index"/>
                    </template>
                </div>
            </transition-group>
        </draggable>
    </div>
@endsection
@push('scripts')
@endpush
