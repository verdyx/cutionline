<?php

namespace App\Http\Livewire\Form;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EditEmployee extends Component
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
        $status,
        $telepon,
        $alamat,
        $hak_akses,
        $password,
        $employee;

    public $opt_gender,
        $opt_blood,
        $opt_religion,
        $opt_access;

    /**
     * Validation
     */

    protected $rules = [
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
        'password' => 'nullable|min:6',
    ];

    public function mount($id)
    {
        $this->employee = Employee::find($id);
        $this->nama = $this->employee->user->name;
        $this->nip = $this->employee->user->username;
        $this->hak_akses  = $this->employee->user->role;
        $this->jenis_kelamin = $this->employee->gender;
        $this->jabatan = $this->employee->position;
        $this->pangkat = $this->employee->rank;
        $this->unit_kerja = $this->employee->work_unit;
        $this->masa_kerja = $this->employee->years_of_service;
        $this->inti = $this->employee->is_core;
        $this->tanggal_lahir = $this->employee->birthday;
        $this->tempat_lahir = $this->employee->birthplace;
        $this->golongan_darah = $this->employee->blood_types;
        $this->agama = $this->employee->religion;
        $this->telepon = $this->employee->phone;
        $this->alamat = $this->employee->address;

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
        Validator::make(
            ['nip' => $this->nip],
            ['nip' => 'required|unique:users,username,' . $this->employee->user->id,],
            [
                'nip.required' => ':attribute wajib diisi',
                'nip.unique' => ':attribute sudah dipakai',
            ]
        )->validate();

        $user = User::find($this->employee->user_id);
        $employee = Employee::find($this->employee->id);

        if ($this->password) {
            $user->password = bcrypt($this->password);
            $user->show_password = $this->password;
        }

        $user->name = $this->nama;
        $user->username = $this->nip;
        $user->role = $this->hak_akses;
        $user->save();

        $employee->user_id = $user->id;
        $employee->gender = $this->jenis_kelamin;
        $employee->position = $this->jabatan;
        $employee->rank = $this->pangkat;
        $employee->years_of_service = $this->masa_kerja;
        $employee->work_unit = $this->unit_kerja;
        $employee->is_core = $this->inti;
        $employee->birthday = $this->tanggal_lahir;
        $employee->birthplace = $this->tempat_lahir;
        $employee->blood_types = $this->golongan_darah;
        $employee->religion = $this->agama;
        $employee->phone = $this->telepon;
        $employee->address = $this->alamat;
        $employee->save();

        session()->flash('success', 'Pegawai berhasil diperbarui');
        return redirect()->route('admin.employee');
    }

    public function render()
    {
        return view('livewire.form.edit-employee')->layout('layouts.dashboard');
    }
}
