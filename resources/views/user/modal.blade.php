<!-- Modal -->
<div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="form-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formAction" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="post" id="form-method">
                <div class="modal-header">
                    <span class="modal-title" id="form-modal-title">Form Modal</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control">
                        @error('name')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control">
                        @error('email')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option>Direktur</option>
                            @foreach (['Teknologi Geologi', 'Teknologi Pertambangan', 'Teknologi Metalurgi'] as $role)
                            <option>Kaprodi {{ $role }}</option>
                            @endforeach
                            @foreach (['Teknologi Geologi', 'Teknologi Pertambangan', 'Teknologi Metalurgi'] as $role)
                            <option>Admin {{ $role }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
