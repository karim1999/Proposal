<div class="kt-portlet kt-portlet--fit kt-portlet--head-noborder kt-portlet--height-fluid-half dashboard_label_{{$id}}">
    <div class="kt-portlet__head kt-portlet__space-x">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                {{$title}}
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body kt-portlet__body--fluid">
        <div class="kt-widget20">
            <div class="kt-widget20__content kt-portlet__space-x">
                <span class="kt-widget20__number kt-font-brand">{{$value}}</span>
                <span class="kt-widget20__desc">{{$label}}</span>
            </div>
            <div class="kt-widget20__chart" style="height:130px;">
                <canvas id="kt_chart_bandwidth1"></canvas>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        var portlet = new KTPortlet('.dashboard_label_{{$id}}', {
            bodyToggleSpeed: 400,
            tooltips: true,
            tools: {
                toggle: {
                    collapse: 'Collapse',
                    expand: 'Expand'
                },
                reload: 'Reload',
                remove: 'Remove',
                fullscreen: {
                    on: 'Fullscreen',
                    off: 'Exit Fullscreen'
                }
            },
            sticky: {
                offset: 300,
                zIndex: 101
            }
        });
    </script>
@endpush
