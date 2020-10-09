<x-dashboard-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h4 class="page-title">Pre Approval Cuti</h4>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <x-validation/>
            <div class="card m-b-30">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No. Cuti</th>
                                <th>Nama</th>
                                <th>Tgl. Pengajuan</th>
                                <th>Jml. Hari</th>
                                <th>Dari Tanggal</th>
                                <th>Sampai Tanggal</th>
                                <th>Jenis Cuti</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($leaves as $item)
                            <tr>
                                <td> {{ $item->letter_number }} </td>
                                <td> {{ $item->user->name }} </td>
                                <td> {{ $item->created_at->translatedFormat('d F Y') }} </td>
                                <td> {{ $item->number_of_days }} </td>
                                <td> {{ $item->from_date->translatedFormat('d F Y') }} </td>
                                <td> {{ $item->to_date->translatedFormat('d F Y') }} </td>
                                <td> {{ $item->kind_of_leave }} </td>
                                <td>
                                    <a href="{{ route('admin.approve', $item->id) }}" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-file-document-edit-outline"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

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
    <script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <!-- Responsive examples -->
    <script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script data-turbolinks-eval="false" src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script data-turbolinks-eval="false" src="{{ asset('assets/pages/datatables.init.js') }}"></script>
    @endpush
</x-dashboard-layout>

