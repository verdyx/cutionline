<x-dashboard-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h4 class="page-title">Approval Cuti</h4>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-8">
            <div class="card m-b-30">
                <div class="card-body">
                    <form action="{{ route('admin.approve.update', $leave->id) }}" method="POST" autocomplete="off">
                        @method('put')
                        @csrf
                        <div class="row">
                            <label class="col-sm-2">NIP</label>
                            <div class="col-sm-10">
                                <p>: {{ $leave->user->username }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2">Nama</label>
                            <div class="col-sm-10">
                                <p>: {{ $leave->user->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2">Tanggal Cuti</label>
                            <div class="col-sm-10">
                                <p>: {{ $leave->from_date->translatedFormat('d F Y') }} - {{ $leave->to_date->translatedFormat('d F Y') }} ({{ $leave->number_of_days }} hari)</p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2">Jenis Cuti</label>
                            <div class="col-sm-10">
                                <p>: {{ $leave->kind_of_leave }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2">Alasan Cuti</label>
                            <div class="col-sm-10">
                                <p>: {{ $leave->reason }}</p>
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
                        <div class="form-group row @error('nomor_surat') has-danger @enderror">
                            <label class="col-sm-2">Nomor Surat</label>
                            <div class="col-sm-10">
                                <input type="text" name="nomor_surat" class="form-control">
                                <small>Ikuti panduan</small><br>
                                @error('nomor_surat') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2">Penandatangan</label>
                            <div class="form-group @error('penandatangan') has-danger @enderror col-sm-4">
                                <select class="form-control" name="penandatangan">
                                    <option disabled selected>Pilih</option>
                                    @foreach ($opt_sign as $item)
                                        <option value="{{ $item->user_id }}" {{ old('penandatangan') == $item->user_id ? 'selected' : ''}}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('penandatangan') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <label class="col-sm-2">Sebagai</label>
                            <div class="form-group @error('sebagai') has-danger @enderror col-sm-4">
                                <input type="text" name="sebagai" class="form-control">
                                @error('sebagai') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
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
        <div class="col-4">
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
        </div>
    </div> <!-- end row -->
</x-dashboard-layout>

