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
                                        <select class="js-example-basic-single" name="nip" id="nip" style="max-height:100%">
                                            <option disabled selected>Pilih NIP</option>
                                            @foreach ($employees as $item)
                                                <option value="{{ $item->id }}" {{ old('nip') == $item->id ? 'selected' : ''}}>{{ $item->username }} - {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('nip') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row @error('N2') has-danger @enderror">
                                    <label class="col-sm-2 col-form-label">N2</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="N2" min="0" class="form-control" value="{{ old('N2') }}">
                                        @error('N2') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row @error('n1') has-danger @enderror">
                                    <label class="col-sm-2 col-form-label">N1</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="N1" min="0" class="form-control" value="{{ old('n1') }}">
                                        @error('n1') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row @error('n') has-danger @enderror">
                                    <label class="col-sm-2 col-form-label">N</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="N" min="0" class="form-control" value="{{ old('n') }}">
                                        @error('n') <span class="error">{{ $message }}</span> @enderror
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
                                <th>Jabatan</th>
                                <th>N2</th>
                                <th>N1</th>
                                <th>N</th>
                                <th style="max-width: 50px">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($leaves as $item)
                            <tr>
                                <td> {{ $item->employee->username }} </td>
                                <td> {{ $item->employee->name }} </td>
                                <td> {{ $item->employee->position }}</td>
                                <td> {{ $item->N2 }} </td>
                                <td> {{ $item->N1 }} </td>
                                <td> {{ $item->N }} </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal{{ $item->id }}"><i class="mdi mdi-refresh"></i></button>
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
                        <h5 class="modal-title mt-0" id="myModalLabel">Reset data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin mereset data cuti pegawai <b>{{ $item->employee->name }}</b> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tidak</button>
                        <form action="{{ route('admin.reset.leave.employee', $item->id) }}" method="POST">
                            @method('put')
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
                allowClear: true,
                placeholder :'Pilih NIP',
                width: '100%'
            });
        });
    </script>
    @endpush
</x-dashboard-layout>

