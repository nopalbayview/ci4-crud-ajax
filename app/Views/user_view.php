<!DOCTYPE html>
<html>
<head>
    <title>CRUD CI PAPAT PostgreSQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Kelola Daftar Pengguna</h2>
    <h5 align="center">Nouval Adibayu Kencono</h5>

    <div class="mb-3 d-flex flex-wrap align-items-center gap-2">
         <input type="text" id="search" class="form-control flex-grow-1" placeholder="Cari disini...">
        <button class="btn btn-primary" id="addNew">
            <i class="fa fa-plus me-2"></i>Tambah User
        </button>
    </div>

    <!-- Table -->
    <table class="table table-hover" id="userTable">
        <thead class="table-dark">
            <tr>
                <!--<th>ID</th>-->
                <th>Nama</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Umur</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div class="modal fade" id="userModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah User
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="userForm">
            <input type="hidden" id="user_id">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" id="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select id="gender" class="form-select" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Umur</label>
                <input type="number" id="umur" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function(){

    const userModal = new bootstrap.Modal(document.getElementById('userModal'));

    function fetchData(keyword = '') {
        $.getJSON('/users/fetch', { search: keyword }, function(users){
            let rows = '';
            users.forEach(user => {
                rows += `<tr>
                    <td>${user.nama}</td>
                    <td>${user.email}</td>
                    <td>${user.gender}</td>
                    <td>${user.umur}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit" data-id="${user.id}">Edit</button>
                        <button class="btn btn-danger btn-sm delete" data-id="${user.id}" data-nama="${user.nama}">Hapus</button>
                    </td>
                </tr>`;
            });
            $('#userTable tbody').html(rows);
        });
    }

    fetchData();

    $('#search').keyup(function(){
        fetchData($(this).val());
    });

    $('#addNew').click(function(){
        $('#userForm')[0].reset();
        $('#user_id').val('');
        $('.modal-title').text('Tambah User');
        userModal.show();
    });

    $('#userForm').submit(function(e){
        e.preventDefault();
        let id = $('#user_id').val();
        let url = id ? '/users/update/' + id : '/users/create';
        $.post(url, {
            nama: $('#nama').val(),
            email: $('#email').val(),
            gender: $('#gender').val(),
            umur: $('#umur').val()
        }, function(){
            userModal.hide();
            fetchData();
        });
    });

    $(document).on('click', '.edit', function(){
        let id = $(this).data('id');
        $.getJSON('/users/edit/' + id, function(user){
            $('#user_id').val(user.id);
            $('#nama').val(user.nama);
            $('#email').val(user.email);
            $('#gender').val(user.gender);
            $('#umur').val(user.umur);
            $('.modal-title').text('Edit User');
            userModal.show();
        });
    });

    $(document).on('click', '.delete', function(){
        let id = $(this).data('id');
        let nama = $(this).data('nama');
        if(!confirm(`Yakin hapus user "${nama}"?`)) return;
        $.post('/users/delete/' + id, { _method: 'DELETE' }, function(){
            fetchData();
        });
    });

});

</script>

</body>
</html>
