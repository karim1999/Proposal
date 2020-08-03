@extends('layouts.main')

@section('title', 'Sections')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            <div class="alert-text">
                {{ session('status') }}
            </div>
        </div>
    @endif

    <div class="row">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        {{$proposal->name}} >> Sections
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <div class="dropdown">
                                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Add
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a href="{{route('proposal-section.create', ["proposal" => $proposal->id, "type" => "text"])}}" class="dropdown-item">
                                        <i class="fa fa-file-alt"></i>
                                        Text
                                    </a>
                                    <a href="{{route('proposal-section.create', ["proposal" => $proposal->id, "type" => "image"])}}" class="dropdown-item">
                                        <i class="fa fa-file-image"></i>
                                        Image
                                    </a>
                                    <a href="{{route('proposal-section.create', ["proposal" => $proposal->id, "type" => "video"])}}" class="dropdown-item">
                                        <i class="fa fa-file-video"></i>
                                        Video
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>Proposal</th>
                        <th>Section Name</th>
                        <th>Section Type</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sections as $section)
                        <form action="{{route('proposal-section.destroy', ["proposal" => $proposal->id, "proposal_section" => $section->id])}}" method="post">
                            @method('DELETE')
                            @csrf
                            <tr>
                                <td>{{$section->id}}</td>
                                <td>{{$section->proposal->name}}</td>
                                <td>{{$section->name}}</td>
                                <td>{{$section->type}}</td>
                                <td>{{$section->created_at}}</td>
                                <td>
                                    <button type="submit" class="btn btn-danger btn-icon" data-toggle="kt-popover" data-placement="top" data-content="Delete">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <a href="{{route('proposal-section.edit', ["proposal" => $proposal->id, "proposal_section" => $section->id])}}">
                                        <button type="button" class="btn btn-outline-brand btn-icon" data-toggle="kt-popover" data-placement="top" data-content="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        </form>
                    @endforeach
                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
@endpush
