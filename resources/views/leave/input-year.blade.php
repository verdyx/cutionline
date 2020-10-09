<x-dashboard-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h4 class="page-title">Form Cuti Tahunan</h4>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-sm-8">
            <x-validation/>
            <form method="POST" action="{{ route('employee.create.leave.year') }}" autocomplete="off">
                @csrf
                <div class="card card-body mb-3">
                    <div class="form-group row @error('tanggal_awal') has-danger @enderror">
                        <label class="col-sm-2 col-form-label">Tanggal Awal</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" value="{{ old('tanggal_awal') }}" name="tanggal_awal" placeholder="Awal" />
                            @error('tanggal_awal') <span class="error">{{ $message }}</span><br> @enderror
                        </div>
                    </div>
                    <div class="form-group row @error('tanggal_akhir') has-danger @enderror">
                        <label class="col-sm-2 col-form-label">Tanggal Awal</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}" placeholder="Akhir" />
                            @error('tanggal_akhir') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group row @error('tahun') has-danger @enderror">
                        <label class="col-sm-2 col-form-label">Tahun Cuti</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="tahun">
                                <option selected disabled>Pilih</option>
                                @foreach ($tahun_cuti as $item)
                                    <option value="{{ $item->id }}" {{ old('tahun') == $item->id ? 'selected' : ''}}>{{ $item->leave_year }}</option>
                                @endforeach
                            </select>
                            @error('tahun') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group row @error('alasan') has-danger @enderror">
                        <label class="col-sm-2 col-form-label">Alasan</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" name="alasan" placeholder="Masukkan alasan" cols="30" rows="10">{{ old('alasan') }}</textarea>
                            @error('alasan') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Ajukan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div> <!-- end col -->
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title font-16 mb-4">Sisa Cuti</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sisa (hari)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tahun_cuti as $item)
                            <tr>
                                <th>{{ $item->leave_year }}</th>
                                <td>{{ $item->day }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</x-dashboard-layout>
