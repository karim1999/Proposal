@extends('layouts.main')

@isset($section->id)
    @section('title', 'Edit '.$section->name)
@else
    @section('title', 'Add New Section')
@endisset
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="alert-text">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        </div>
    @endif
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @isset($section->id)
                        {{$section->name}}
                    @else
                        New Section
                    @endisset
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form id="uploadForm" class="kt-form kt-form--label-right" action="{{isset($section->id) ? route('proposal-section.update', ["proposal" => $proposal->id, "proposal_section" => $section->id]) : route('proposal-section.store', $proposal->id)}}" method="post" enctype="multipart/form-data">
            <input type="hidden" value="{{$type}}" name="type">
            @isset($section->id)
                @method('PUT')
            @else
                @method('POST')
            @endisset
            @csrf

            <div class="kt-portlet__body">
                <div class="kt-section kt-section--first">
                    <h3 class="kt-section__title">1. Section Info:</h3>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Name:</label>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Enter full name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $section->name) }}" required autocomplete="name" autofocus>
                                <span class="form-text text-muted">Please enter the full section name</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Content:</label>
                            <div class="col-lg-6">
                                @if($type == "text")
                                    <textarea name="content" id="kt-ckeditor-1">
                                        {!! old('content', $section->id ? $section->mediable->value : "") !!}
                                    </textarea>
                                @else
                                    <input type="file" placeholder="Add your file here" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}" required autocomplete="file" autofocus>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{route('proposal-section.index', $proposal->id)}}">
                                <button type="button" class="btn btn-secondary">Cancel</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--end::Form-->
    </div>

@endsection
@push('scripts')
    @if($type == "text")
        <script src="{{asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}" type="text/javascript"></script>
        <script>
            ClassicEditor
                .create( document.querySelector( '#kt-ckeditor-1' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );
        </script>
    @else
{{--        <script>--}}
{{--            var myDropzone = new Dropzone("#kt_dropzone_1", {--}}
{{--                autoProcessQueue: false,--}}
{{--                url: "/file/post"--}}
{{--            });--}}
{{--            $('#uploadForm').submit(function() {--}}
{{--                myDropzone.processQueue();--}}
{{--                return true;--}}
{{--            });--}}
{{--        </script>--}}
    @endif
@endpush
