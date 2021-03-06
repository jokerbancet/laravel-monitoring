<div class="modal fade" id="modalChangePassword" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" id="form-change-password">
                @csrf
                @method('put')
                <div class="modal-header">
                    <span class="modal-title" id="modalDetailLabel">Ganti Password Mahasiswa <span id="mahasiswa-nama"></span></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Password Baru</label>
                        <input type="text" name="password" class="form-control">
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

@push('js')
    <script>
        function changePasswordModal(user){
            let passwords = {
                'mahasiswa': 'passwordmahasiswa',
                'dosenpembimbing' : 'passworddosen',
                'pembimbingindustri': 'passworddpi'
            };
            let password = passwords[user.role];
            if(user.hasOwnProperty('is_hrd')&&user.is_hrd){
                password = 'passwordhrd';
            }
            Swal.fire({
                title: 'Apakah yakin ingin reset password?',
                text: 'Password Default: '+password,
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya',
            }).then(result => {
                if(result.isConfirmed){
                    $('#form-change-password').attr('action', `/user/${user.id}/reset-password`).submit()
                }
            })
            // $('#user-nama').text(user.nama)
            // $('#modalChangePassword').modal('toggle')
        }
    </script>
@endpush