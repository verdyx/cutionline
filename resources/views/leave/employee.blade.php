<x-dashboard-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h4 class="page-title">Data Cuti Tahunan</h4>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <x-validation/>
            <button class="btn btn-primary mo-mb-2 mb-3 collapsed" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Tambah data cuti tahunan
            </button>
            <div class="collapse mb-3" id="collapseExample" style="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card card-body mt-3 mb-0">
                            <form action="{{ route('admin.create.leave.employee') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="form-group row @error('nip') has-danger @enderror">
                                    <label class="col-sm-2 col-form-label">NIP</label>
                                    <div class="col-sm-10">
                                        <select class="w-100 js-example-basic-single" name="nip" id="nip">
                                            <option disabled selected>Pilih NIP</option>
                                            @foreach ($employees as $item)
                                                <option value="{{ $item->id }}">{{ $item->user->username }}</option>
                                            @endforeach
                                        </select>
                                        @error('nip') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row @error('hari') has-danger @enderror">
                                    <label class="col-sm-2 col-form-label">Hari</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="hari" min="1" class="form-control" placeholder="Masukkan jumlah hari" value="{{ old('hari') }}">
                                        @error('hari') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row @error('tahun') has-danger @enderror">
                                    <label class="col-sm-2 col-form-label">Tahun Cuti</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="tahun" placeholder="Masukkan tahun cuti" value="{{ old('tahun') }}">
                                        @error('tahun') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row @error('tahun') has-danger @enderror">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card m-b-30">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Sisa Cuti</th>
                                <th>Tahun</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($leaves as $item)
                            <tr>
                                <td> {{ $item->employee->username }} </td>
                                <td> {{ $item->employee->name }} </td>
                                <td> {{ $item->day }} </td>
                                <td> {{ $item->leave_year }} </td>
                                <td>
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
    @foreach ($leaves as $item)
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
                        <p>Anda yakin menghapus data cuti pegawai <b>{{ $item->employee->name }}</b> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tidak</button>
                        <form action="{{ route('admin.destroy.leave.employee', $item->id) }}" method="POST">
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                allowClear: true
            });
        });
    </script>
    @endpush
</x-dashboard-layout>

