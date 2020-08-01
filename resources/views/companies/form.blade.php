@extends('layouts.main')

@isset($company->id)
    @section('title', 'Edit '.$company->name)
@else
    @section('title', 'Add New Company')
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
                    New Company
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" action="{{isset($company->id) ? route('companies.update', $company->id) : route('companies.store')}}" method="post" enctype="multipart/form-data">
            @isset($company->id)
                @method('PUT')
            @else
                @method('POST')
            @endisset
            @csrf
            <div class="kt-portlet__body">
                <div class="kt-section kt-section--first">
                    <h3 class="kt-section__title">1. Company Info:</h3>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Company Logo</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                                    <div class="kt-avatar__holder" style="background-image: url({{isset($company->id) ? $company->getFirstMediaUrl('logo') : asset('assets/media/users/100_1.jpg')}})"></div>
                                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change Company Logo">
                                        <i class="fa fa-pen"></i>
                                        <input type="file" name="logo" accept=".png, .jpg, .jpeg">
                                    </label>
{{--                                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel logo"><i class="fa fa-times"></i></span>--}}
                                </div>
                                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Name:</label>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Enter full name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $company->name) }}" required autocomplete="name" autofocus>
                                <span class="form-text text-muted">Please enter the full company name</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Company Website:</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-link"></i></span></div>
                                    <input type="url" placeholder="Enter company website" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website', $company->website) }}" required autocomplete="website">
                                </div>
                                <span class="form-text text-muted">Please enter your company main website</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                    <h3 class="kt-section__title">2. Contact Info:</h3>
                    <div class="kt-section__body">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Email:</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                    <input type="email" placeholder="Enter company email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $company->email) }}" autocomplete="email">
                                </div>
                                <span class="form-text text-muted">Please enter your company main email</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Phone</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                    <input type="text" placeholder="Phone number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $company->phone) }}" autocomplete="phone">
                                </div>
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
                            <a href="{{route('companies.index')}}">
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
    <script src="{{asset('assets/js/pages/crud/file-upload/ktavatar.js')}}" type="text/javascript"></script>

@endpush
