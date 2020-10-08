<x-slot name="header">
    <div class="col-sm-6">
        <h4 class="page-title">Dashboard</h4>
    </div>
</x-slot>

<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-heading p-4">
                <div class="mini-stat-icon float-right">
                    <i class="mdi mdi-cube-outline bg-primary text-white"></i>
                </div>
                <div>
                    <h5 class="font-16">Total cuti</h5>
                </div>
                <h3 class="mt-4">{{ $cuti }}</h3>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-heading p-4">
                <div class="mini-stat-icon float-right">
                    <i class="mdi mdi-check-bold bg-success text-white"></i>
                </div>
                <div>
                    <h5 class="font-16">Total Approve</h5>
                </div>
                <h3 class="mt-4">{{ $approve }}</h3>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-heading p-4">
                <div class="mini-stat-icon float-right">
                    <i class="mdi mdi-pause bg-warning text-white"></i>
                </div>
                <div>
                    <h5 class="font-16">Total Waiting</h5>
                </div>
                <h3 class="mt-4">{{ $waiting }}</h3>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-heading p-4">
                @if (auth()->user()->role == "Admin")
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-face bg-danger text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Total Pegawai</h5>
                    </div>
                    <h3 class="mt-4">{{ $pegawai }}</h3>
                @else
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-file-remove bg-danger text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Total Ditolak</h5>
                    </div>
                    <h3 class="mt-4">{{ $refuse }}</h3>
                @endif
            </div>
        </div>
    </div>
</div>

@push('css')
    <!-- DataTables -->
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css ') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js')
<!-- Required datatable js -->
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Buttons examples -->
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>

<!-- Responsive examples -->
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script data-turbolinks-eval="false" src="{{ asset('assets/pages/datatables.init.js') }}"></script>
@endpush
