<x-dashboard-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h4 class="page-title">Form Cuti</h4>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <x-validation/>
            <form action="" method="POST" autocomplete="off">
                @csrf
                <div class="card card-body mb-3">
                    <div class="form-group row @error('tanggal_awal') has-danger @enderror">
                        <label class="col-sm-2 col-form-label">Tanggal Awal</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal_awal"  value="{{ old('tanggal_awal') }}" placeholder="Awal" />
                            @error('tanggal_awal') <span class="error">{{ $message }}</span><br> @enderror
                        </div>
                    </div>
                    <div class="form-group row @error('tanggal_akhir') has-danger @enderror">
                        <label class="col-sm-2 col-form-label">Tanggal Akhir</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal_akhir"  value="{{ old('tanggal_akhir') }}" placeholder="Akhir" />
                            @error('tanggal_akhir') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group row @error('jenis_cuti') has-danger @enderror">
                        <label class="col-sm-2 col-form-label">Jenis Cuti</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis_cuti">
                                <option selected disabled>Pilih</option>
                                @foreach ($opt_cuti as $item)
                                    <option value="{{ $item }}" {{ old('jenis_cuti') == $item ? 'selected' : ''}}>{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('jenis_cuti') <span class="error">{{ $message }}</span> @enderror
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
    </div> <!-- end row -->
</x-dashboard-layout>
