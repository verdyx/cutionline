<x-dashboard-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h4 class="page-title">Pegawai</h4>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-12">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            @endif
            <a href="{{ route('admin.form.employee') }}" class="btn btn-primary mb-3">
                <i class="mdi mdi-account-plus"></i> Tambah Pegawai
            </a>
            <div class="card m-b-30">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>No Telp</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($employees as $item)
                            <tr>
                                <td> {{ $item->user->username }} </td>
                                <td> {{ $item->user->name }} </td>
                                <td> {{ $item->position }} </td>
                                <td> {{ $item->phone }} </td>
                                <td>
                                    <a href="{{ route('admin.employee.detail', $item->id) }}" class="btn btn-primary"><i class="mdi mdi-account-edit"></i></a>
                                    <button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#myModal{{ $item->id }}"><i class="mdi mdi-trash-can"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    @push('modals')
    <!-- sample modal content -->
    <div>
    @foreach ($employees as $item)
        <div id="myModal{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Hapus data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin menghapus <b>{{ $item->user->name }}</b> dari data pegawai?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tidak</button>
                        <form action="{{ route('admin.employee.destroy', $item->user->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger waves-effect waves-light">Ya</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endforeach
    </div>

    @endpush

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
