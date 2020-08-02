@extends('layouts.main')

@isset($proposal->id)
    @section('title', 'Edit '.$proposal->name)
@else
    @section('title', 'Add New Proposal')
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
                    @isset($proposal->id)
                        {{$proposal->name}}
                    @else
                        New Proposal
                    @endisset
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" action="{{isset($proposal->id) ? route('proposals.update', $proposal->id) : route('proposals.store')}}" method="post" enctype="multipart/form-data">
            @isset($proposal->id)
                @method('PUT')
            @else
                @method('POST')
            @endisset
            @csrf
            <div class="kt-portlet__body">
                <div class="kt-section kt-section--first">
                    <h3 class="kt-section__title">1. Proposal Info:</h3>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Company:</label>
                            <div class="col-lg-6">
                                <select class="form-control @error('name') is-invalid @enderror" name="company">
                                    @foreach($companies as $company)
                                        <option @if(isset($proposal->id) && $proposal->company_id == $company->id) selected @endisset value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Theme:</label>
                            <div class="col-lg-6">
                                <select class="form-control @error('name') is-invalid @enderror" name="theme">
                                    @foreach($themes as $theme)
                                        <option @if(isset($theme->id) && $theme->company_id == $theme->id) selected @endisset value="{{$theme->id}}">{{$theme->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Name:</label>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Enter full name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $proposal->name) }}" required autocomplete="name" autofocus>
                                <span class="form-text text-muted">Please enter the full proposal name</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                    <h3 class="kt-section__title">3. Settings Info:</h3>
                    <div class="kt-section__body">
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{route('proposals.index')}}">
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
    <script src="{{asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}" type="text/javascript"></script>

    <script src="{{asset('assets/js/pages/crud/forms/editors/ckeditor-classic.js')}}" type="text/javascript"></script>

@endpush
