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
                <input type="hidden" id="id" name="id">
            <div class="mb-3">
            <label>Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" required> 
            </div>
            <div class="mb-3">
                <label>Email</label>
            <input type="email" id="email" name="email" class="form-control" required> 
            </div>
            <div class="mb-3">
                <label>Gender</label>
            <select id="gender" name="gender" class="form-select" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            </div>
            <div class="mb-3">
                <label>Umur</label>
                <input type="number" id="umur" name="umur" class="form-control" required> 
            </div>
        <button type="submit" class="btn btn-success">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>

function fetchUsers(query = null) {
    query = $('#search').val();
    $.ajax({
        url: '/users/fetch?query=' + encodeURIComponent(query), // Encode query
        method: 'GET',
        success: function(data){
            let rows = '';
            try {
                let users = (typeof data === 'string') ? JSON.parse(data) : data;
                users.forEach(u => {
                    rows += `
                        <tr>
                            <td>${u.nama}</td>
                            <td>${u.email}</td>
                            <td>${u.gender}</td>
                            <td>${u.umur}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit" data-id="${u.id}">Edit</button>
                                <button class="btn btn-danger btn-sm delete" data-id="${u.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                });
            } catch(err) {
                console.error("JSON error:", err);
                rows = '<tr><td colspan="5" class="text-center">Error loading data</td></tr>';
            }
            $('#userTable tbody').html(rows);
        },
        error: function(xhr){
            console.error(xhr.responseText);
            $('#userTable tbody').html('<tr><td colspan="5">Failed to load data</td></tr>');
        }
    });
}

$(document).ready(function(){
    fetchUsers();

    // Handler untuk button Tambah User (ditambahkan)
    $('#addNew').click(function(){
        $('#userForm')[0].reset();
        $('#id').val('');
        $('#userModal').modal('show');
    });

    // Pencarian real-time (ditambahkan)
    $('#search').on('input', function(){
        fetchUsers();
    });

    // Submit form (tetap, tapi perbaiki response handling)
    $('#userForm').submit(function(e){
        e.preventDefault();
        let id = $('#id').val();
        let url = id ? `/users/update/${id}` : '/users/store';
        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize(),
            success: function(res){
                try {
                    let r = (typeof res === 'string') ? JSON.parse(res) : res;
                    if(r.status === 'success') {
                        $('#userForm')[0].reset();
                        $('#id').val('');
                        $('#userModal').modal('hide'); // Tutup modal
                        fetchUsers();
                    } else {
                        alert('Error: ' + (r.errors ? JSON.stringify(r.errors) : r.message));
                    }
                } catch(err){
                    console.error(err);
                    alert('Server error');
                }
            },
            error: function(xhr){
                console.error(xhr.responseText);
                alert('Error request');
            }
        });
    });

    $(document).on('click', '.edit', function(){
        let id = $(this).data('id');
        $.ajax({
            url: `/users/edit/${id}`,
            method: 'GET',
            success: function(data){
                try {
                    let u = (typeof data === 'string') ? JSON.parse(data) : data;
                    $('#id').val(u.id);
                    $('#nama').val(u.nama);
                    $('#email').val(u.email);
                    $('#gender').val(u.gender);
                    $('#umur').val(u.umur);
                    $('#userModal').modal('show'); // Buka modal untuk edit
                } catch(err){
                    console.error(err);
                    alert('Error loading user data');
                }
            },
            error: function(xhr){
                console.error(xhr.responseText);
                alert('Error fetching user');
            }
        });
    });

    // Delete (ubah method ke POST sesuai routes)
    $(document).on('click', '.delete', function(){
        let id = $(this).data('id');
        if(!confirm("Yakin hapus user?")) return;
        $.ajax({
            url: `/users/delete/${id}`,
            method: 'POST', // Ubah dari DELETE ke POST
            success: function(res){
                try {
                    let r = (typeof res === 'string') ? JSON.parse(res) : res;
                    if(r.status === 'success') {
                        fetchUsers();
                    } else {
                        alert('Error: ' + r.message);
                    }
                } catch(err){
                    console.error(err);
                    alert('Server error');
                }
            },
            error: function(xhr){
                console.error(xhr.responseText);
                alert('Server error');
            }
        });
    });
});

</script>
</body>
</html>
