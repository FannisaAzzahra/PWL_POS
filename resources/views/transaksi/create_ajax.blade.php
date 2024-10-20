<form action="{{ url('/transaksi/ajax') }}" method="POST" id="form-tambah-transaksi">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>User ID</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Pilih Barang</option>
                        <!-- Contoh opsi barang, sesuaikan dengan data barang yang ada -->
                        <option value="1">User A</option>
                        <option value="2">User B</option>
                    </select>
                    <small id="error-user_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Pembeli</label>
                    <input type="text" name="pembeli" id="pembeli" class="form-control" required>
                    <small id="error-pembeli" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kode Transaksi</label>
                    <input type="text" name="transaksi_kode" id="transaksi_kode" class="form-control" required>
                    <small id="error-transaksi_kode" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Tanggal Transaksi</label>
                    <input type="date" name="transaksi_tanggal" id="transaksi_tanggal" class="form-control" required>
                    <small id="error-transaksi_tanggal" class="error-text form-text text-danger"></small>
                </div>
                <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form-tambah-transaksi").validate({
            rules: {
                pembeli: { required: true, minlength: 3, maxlength: 100 },
                transaksi_kode: { required: true, minlength: 3, maxlength: 10 },
                transaksi_tanggal: { required: true, date: true },
                user_id: { required: true }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataTransaksi.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
