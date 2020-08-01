@extends('layouts.main')

@section('title', 'Proposals')
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
                        Proposals
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{route('proposals.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                New Proposal
                            </a>
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
                        <th>Proposal Name</th>
                        <th>Owner</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($proposals as $proposal)
                        <form action="{{route('proposals.destroy', $proposal->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <tr>
                                <td>{{$proposal->id}}</td>
                                <td>{{$proposal->name}}</td>
                                <td>{{$proposal->user->name}}</td>
                                <td>{{$proposal->created_at}}</td>
                                <td>{{$proposal->id}}</td>
                                <td>
                                    <button type="submit" class="btn btn-danger btn-icon">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <a href="{{route('proposals.edit', $proposal->id)}}">
                                        <button type="button" class="btn btn-outline-brand btn-icon">
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
