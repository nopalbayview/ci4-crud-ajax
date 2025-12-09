<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh;">
<div class="card shadow p-4" style="width:350px;">
<h4 class="text-center mb-3">Login</h4>
<form action="/login/process" method="post">
<input type="text" class="form-control mb-3" name="username" placeholder="Username" required>
<input type="password" class="form-control mb-3" name="password" placeholder="Password" required>
<button class="btn btn-primary w-100">Login</button>
</form>
<?php if(session()->getFlashdata('error')): ?>
<div class="alert alert-danger mt-3"> <?= session()->getFlashdata('error'); ?> </div>
<?php endif; ?>
</div>
</body>
</html>