<x-dashboard-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h4 class="page-title">Riwayat Cuti</h4>
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
                                <th>Jenis Cuti</th>
                                @if (auth()->user()->role == "admin")
                                <th>Nama</th>
                                @endif
                                <th>Dari Tanggal</th>
                                <th>Sampai Tanggal</th>
                                <th>Tgl. Pengajuan</th>
                                <th>Persetujuan</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($leaves as $item)
                            <tr>
                                <td> {{ $item->kind_of_leave }} </td>
                                @if (auth()->user()->role == "admin")
                                <td> {{ $item->user->name }}</td>
                                @endif
                                <td> {{ $item->from_date->translatedFormat('d F Y') }} </td>
                                <td> {{ $item->to_date->translatedFormat('d F Y') }} </td>
                                <td> {{ $item->created_at->translatedFormat('d F Y') }} </td>
                                <td>
                                    @if ($item->status_boss && $item->status_leader)
                                    {{ $item->status_leader }} (Ketua)
                                    @elseif($item->status_boss)
                                    {{ $item->status_boss }} (Atasan)
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex d-inline">
                                        <a href="{{ route('employee.edit.leave', $item->id) }}" class="btn btn-sm mr-1 btn-primary waves-effect waves-light"><i class="mdi mdi-grease-pencil"></i></a>
                                        <div class="dropdown mr-1">
                                            <button class="btn btn-sm btn-success waves-effect waves-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-printer"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @if ($item->status_boss == "Disetujui" && $item->status_leader == "Disetujui")
                                                <a href="{{ route('leave.print.letter', $item->id) }}" class="dropdown-item">Surat Izin</a>
                                                @endif
                                                <a href="{{ route('leave.print.req', $item->id) }}" class="dropdown-item">Formulir</a>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm mr-1 btn-danger waves-effect waves-light" data-toggle="modal" data-target="#myModal{{ $item->id }}"><i class="mdi mdi-trash-can"></i></button>
                                    </div>
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
    @foreach ($leaves as $item)
        <div id="myModal{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Hapus pengajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin menghapus pengajuan cuti ini ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tidak</button>
                        <form action="{{ route('employee.destroy.leave', $item->id) }}" method="POST">
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

