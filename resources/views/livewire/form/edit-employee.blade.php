<x-slot name="header">
    <div class="col-sm-6">
        <h4 class="page-title">Ubah Data Pegawai</h4>
    </div>
</x-slot>

<div class="row">
    <div class="col-12">
        <form wire:submit.prevent="submit">
            <div class="card card-body mb-3">
                <h4 class="font-16"><strong>Data Pegawai</strong></h4>
                <div class="form-group row @error('inti') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">Pegawai Inti?</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model="inti" id="inti" value="1">
                            <label class="form-check-label" for="inti">
                                Iya
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model="inti" id="bukaninti" value="0">
                            <label class="form-check-label" for="bukaninti">
                                Bukan
                            </label>
                        </div>
                        <small>Orang yang bisa menandatangani surat cuti</small><br>
                        @error('inti') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
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
                <div class="form-group row @error('jenis_kelamin') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select class="form-control" wire:model="jenis_kelamin">
                            <option selected>Pilih</option>
                            @foreach ($opt_gender as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('jenis_kelamin') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row @error('jabatan') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" wire:model="jabatan">
                        @error('jabatan') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row @error('pangkat') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">Pangkat</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" wire:model="pangkat">
                        @error('pangkat') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row @error('unit_kerja') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">Unit Kerja</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" wire:model="unit_kerja">
                        @error('unit_kerja') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row @error('masa_kerja') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">Masa Kerja</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" wire:model="masa_kerja">
                        @error('masa_kerja') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="text" wire:model="tempat_lahir">
                        @error('tempat_lahir') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-sm-7">
                        <input class="form-control" type="date" wire:model="tanggal_lahir">
                        @error('tanggal_lahir') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row @error('golongan_darah') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">Golongan Darah</label>
                    <div class="col-sm-10">
                        <select class="form-control" wire:model="golongan_darah">
                            <option selected>Pilih</option>
                            @foreach ($opt_blood as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('golongan_darah') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row @error('agama') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">Agama</label>
                    <div class="col-sm-10">
                        <select class="form-control" wire:model="agama">
                            <option selected>Pilih</option>
                            @foreach ($opt_religion as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('agama') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row @error('telepon') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">No Telepon</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" wire:model="telepon">
                        @error('telepon') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="form-group row @error('alamat') has-danger @enderror">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea wire:model="alamat" cols="30" rows="10" class="form-control"></textarea>
                        @error('alamat') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="card card-body mb-3">
                <h4 class="font-16"><strong>Data Login</strong></h4>
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
