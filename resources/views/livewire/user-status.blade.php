<x-dashboard-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h4 class="page-title">Ubah Status User</h4>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-md-6">
            <div class="card m-b-30">
                <div class="card-body">
                    <p class="text-center">Ubah status user <b>{{ $user->name }}</b></p>
                    <div class="row">
                        <div class="col-sm-6">
                            <form action="{{ route('admin.user.status.change', ['id' => $user->id, 'status' => 1]) }}" method="POST">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-success w-100">Aktif</button>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            <form action="{{ route('admin.user.status.change', ['id' => $user->id, 'status' => 0]) }}" method="POST">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-danger w-100">Tidak Aktif</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</x-dashboard-layout>

