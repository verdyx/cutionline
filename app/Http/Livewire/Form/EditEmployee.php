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
        $jabatan,
        $pangkat,
        $tmt_cpns,
        $ketua,
        $telepon,
        $atasan,
        $hak_akses,
        $password,
        $employee;

    public $opt_access, $opt_boss;

    /**
     * Validation
     */

    protected $rules = [
        'nama' => 'required',
        'jabatan' => 'required',
        'pangkat' => 'required',
        'tmt_cpns' => 'required',
        'ketua' => 'nullable|unique:employees,is_leader',
        'telepon' => 'required',
        'hak_akses' => 'required',
        'password' => 'nullable|min:6',
    ];

    protected $messages = [
        'ketua.unique' => 'Ketua telah dipilih, hanya boleh memilih 1 ketua.',
    ];

    public function mount($id)
    {
        $this->employee = Employee::find($id);
        $this->nama = $this->employee->user->name;
        $this->nip = $this->employee->user->username;
        $this->hak_akses  = $this->employee->user->role;
        $this->jabatan = $this->employee->position;
        $this->pangkat = $this->employee->rank;
        $this->tmt_cpns = $this->employee->tmt_cpns;
        $this->ketua = $this->employee->is_leader;
        $this->atasan = $this->employee->boss_id;
        $this->telepon = $this->employee->phone;

        $this->opt_access = [
            'admin',
            'pegawai'
        ];
        $this->opt_boss = User::all();
    }

    public function submit()
    {
        $this->validate();
        Validator::make(
            ['nip' => $this->nip],
            ['nip' => 'required|unique:users,username,' . $this->employee->user->id,],
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
        $employee->position = $this->jabatan;
        $employee->rank = $this->pangkat;
        $employee->tmt_cpns = $this->tmt_cpns;
        $employee->is_leader = $this->ketua;
        $employee->boss_id = $this->atasan;
        $employee->phone = $this->telepon;
        $employee->save();

        session()->flash('success', 'Pegawai berhasil diperbarui');
        return redirect()->route('admin.employee');
    }

    public function render()
    {
        return view('livewire.form.edit-employee')->layout('layouts.dashboard');
    }
}
