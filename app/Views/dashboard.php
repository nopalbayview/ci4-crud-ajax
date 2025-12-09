<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MyApp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="/dashboard">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/siswa">CRUD Siswa</a></li>
        <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Content -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Welcome, <?= session()->get('username') ?></h1>
            <p class="lead">Dashboard MyApp - Kamu bisa mengelola data siswa dari sini</p>
            <a href="/siswa" class="btn btn-success btn-lg mt-3">Kelola CRUD Siswa</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
