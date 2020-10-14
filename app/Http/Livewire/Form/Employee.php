<?php

namespace App\Http\Livewire\Form;

use App\Models\Employee as ModelsEmployee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Employee extends Component
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
        $password;

    public $opt_access, $opt_boss;

    /**
     * Validation
     */

    protected $rules = [
        'nip' => 'required|unique:users,username',
        'nama' => 'required',
        'jabatan' => 'required',
        'pangkat' => 'required',
        'tmt_cpns' => 'required',
        'ketua' => 'nullable|unique:employees,is_leader',
        'telepon' => 'required',
        'atasan' => 'nullable',
        'hak_akses' => 'required',
        'password' => 'required|min:6',
    ];

    protected $messages = [
        'ketua.unique' => 'Ketua telah dipilih, hanya boleh memilih 1 ketua.',
    ];

    public function mount()
    {
        $this->opt_access = [
            'admin',
            'pegawai'
        ];

        $this->opt_boss = User::all();
    }

    public function submit()
    {

        $this->validate();

        if (!$this->ketua) {
            $this->ketua = 0;
        }

        if ($this->atasan == "Pilih") {
            $this->atasan = null;
        }

        DB::transaction(function () {
            $user = User::create([
                'name' => $this->nama,
                'username' => $this->nip,
                'show_password' => $this->password,
                'password' => bcrypt($this->password),
                'position' => $this->hak_akses
            ]);

            ModelsEmployee::create([
                'user_id' => $user->id,
                'position' => $this->jabatan,
                'rank' => $this->pangkat,
                'tmt_cpns' => $this->tmt_cpns,
                'is_leader' => $this->ketua,
                'boss_id' => $this->atasan,
                'phone' => $this->telepon,
            ]);
        });

        session()->flash('success', 'Pegawai berhasil dibuat');
        return redirect()->route('admin.employee');
    }

    public function render()
    {
        return view('livewire.form.employee')->layout('layouts.dashboard');
    }
}
