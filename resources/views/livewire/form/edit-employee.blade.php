<x-slot name="header">
    <div class="col-sm-6">
        <h4 class="page-title">Ubah Data Pegawai</h4>
    </div>
</x-slot>

<div class="row">
    <div class="col-12">
        <form wire:submit.prevent="submit">
            <div class="card card-body mb-3">
                <h4 class="font-16"><strong>Data Pegawai</strong></h4><br>
                <div class="form-group row @error('nip') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" wire:model="nip" readonly>
                        @error('nip') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row @error('nama') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">Nama Pegawai</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" wire:model="nama">
                        @error('nama') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row @error('jabatan') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" wire:model="jabatan">
                        @error('jabatan') <span class="error">{{ $message }}</span> @enderror
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model="ketua" id="ketua" value="1">
                            <label for="ketua">
                                Ketua Institusi
                            </label>
                        </div>
                        @error('ketua') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row @error('pangkat') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">Pangkat</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" wire:model="pangkat">
                        @error('pangkat') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row @error('tmt_cpns') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">TMT CPNS</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" wire:model="tmt_cpns">
                        @error('tmt_cpns') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row @error('telepon') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">No Telepon</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" wire:model="telepon">
                        @error('telepon') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row @error('atasan') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">Atasan</label>
                    <div class="col-sm-10">
                        <select class="form-control" wire:model="atasan">
                            <option selected>Pilih</option>
                            @foreach ($opt_boss as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <small>Boleh dikosongi</small><br>
                        @error('atasan') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="card card-body mb-3">
                <h4 class="font-16"><strong>Data Login</strong></h4><br>
                <div class="form-group row @error('hak_akses') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">Hak akses</label>
                    <div class="col-sm-10">
                        <select class="form-control" wire:model="hak_akses">
                            <option selected>Pilih</option>
                            @foreach ($opt_access as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('hak_akses') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row @error('password') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">Ubah Password</label>
                    <div class="col-sm-10">
                        <input type="password" wire:model="password" class="form-control">
                        <small>Minimal 6 karakter, Kosongi apabila tidak ingin mengubah password</small>
                        @error('password') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- end col -->
</div> <!-- end row -->
