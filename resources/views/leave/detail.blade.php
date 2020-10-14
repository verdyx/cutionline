<x-dashboard-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h4 class="page-title">Approval Cuti</h4>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    {{-- @if (auth()->user()->role == "admin")
                    <form action="{{ route('admin.approve.update', $leave->id) }}" method="POST" autocomplete="off">
                    @else --}}
                    <form action="{{ route('employee.leave.acc', $leave->id) }}" method="POST" autocomplete="off">
                    {{-- @endif --}}
                        @method('put')
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2">NIP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $leave->employee->username }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $leave->employee->name }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">Tanggal Cuti</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $leave->from_date->translatedFormat('d F Y') }} - {{ $leave->to_date->translatedFormat('d F Y') }} ({{ $leave->number_of_days }} hari)" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">Jenis Cuti</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $leave->kind_of_leave }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">Alamat Cuti</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $leave->address }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">Alasan Cuti</label>
                            <div class="col-sm-10">
                                <textarea readonly class="form-control" cols="30" rows="10">{{ $leave->reason }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row @error('approval') has-danger @enderror">
                            <label class="col-sm-2">Approval</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="approval" id="approval">
                                    <option disabled selected>Pilih</option>
                                    @foreach ($opt_acc as $item)
                                        <option value="{{ $item }}" {{ old('approval') == $item ? 'selected' : ''}}>{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('approval') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group row @error('nomor_surat') has-danger @enderror">
                            <label class="col-sm-2">Nomor Surat</label>
                            <div class="col-sm-10">
                                <input type="text" name="nomor_surat" class="form-control">
                                <small>Ikuti panduan</small><br>
                                @error('nomor_surat') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label class="col-sm-2"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
        {{-- <div class="col-4">
            <div class="card card-body">
                <h4 class="card-title font-16">Panduan</h4>
                <p class="card-subtitle">
                    <ul>
                        <li>Nomor surat</li>
                        <p>
                            W29.U / <b class="text-danger">xxx</b> / KP.05.2 / X / {{ Carbon\Carbon::now()->year }}<br>
                            <div class="text-secondary">Isi yang berwarna merah saja pada form <b>Nomor Surat</b></div>
                        </p>
                    </ul>
                </p>
            </div>
        </div> --}}
    </div> <!-- end row -->
</x-dashboard-layout>

