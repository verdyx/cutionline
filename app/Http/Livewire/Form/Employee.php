<?php

namespace App\Http\Livewire\Form;

use App\Models\Employee as ModelsEmployee;
use App\Models\User;
use Livewire\Component;

class Employee extends Component
{

    public
        $nip,
        $nama,
        $jenis_kelamin,
        $jabatan,
        $pangkat,
        $unit_kerja,
        $masa_kerja,
        $inti,
        $tempat_lahir,
        $tanggal_lahir,
        $golongan_darah,
        $agama,
        $telepon,
        $alamat,
        $hak_akses,
        $password;

    public $opt_gender,
        $opt_blood,
        $opt_religion,
        $opt_status,
        $opt_access;

    /**
     * Validation
     */

    protected $rules = [
        'nip' => 'required|unique:users,username',
        'nama' => 'required',
        'jenis_kelamin' => 'required',
        'jabatan' => 'required',
        'pangkat' => 'required',
        'unit_kerja' => 'required',
        'masa_kerja' => 'required',
        'inti' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required|date',
        'golongan_darah' => 'required',
        'agama' => 'required',
        'telepon' => 'required',
        'alamat' => 'required',
        'hak_akses' => 'required',
        'password' => 'required|min:6',
    ];

    public function mount()
    {
        $this->opt_access = [
            'Admin',
            'Pegawai'
        ];

        $this->opt_gender = [
            'Laki-Laki',
            'Perempuan'
        ];

        $this->opt_religion = [
            'Islam',
            'Kristen',
            'Katolik',
            'Hindu',
            'Budha',
            'Kepercayaan Lain'
        ];

        $this->opt_blood = [
            'A',
            'B',
            'AB',
            'O'
        ];
    }

    public function submit()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->nama,
            'username' => $this->nip,
            'show_password' => $this->password,
            'password' => bcrypt($this->password),
            'is_active' => 1,
            'position' => $this->hak_akses
        ]);

        ModelsEmployee::create([
            'user_id' => $user->id,
            'gender' => $this->jenis_kelamin,
            'position' => $this->jabatan,
            'rank' => $this->pangkat,
            'work_unit' => $this->unit_kerja,
            'years_of_service' => $this->masa_kerja,
            'is_core' => $this->inti,
            'birthday' => $this->tanggal_lahir,
            'birthplace' => $this->tempat_lahir,
            'blood_types' => $this->golongan_darah,
            'religion' => $this->agama,
            'phone' => $this->telepon,
            'address' => $this->alamat,
        ]);

        session()->flash('success', 'Pegawai berhasil dibuat');
        return redirect()->route('admin.employee');
    }

    public function render()
    {
        return view('livewire.form.employee')->layout('layouts.dashboard');
    }
}
