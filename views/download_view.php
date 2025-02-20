<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Hasil Anonimisasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #006400;
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .container {
            max-width: 600px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            color: black;
            padding: 20px;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 150px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card text-center">
        <img src="<?php echo base_url('PN.png'); ?>" alt="Logo Pengadilan Negeri Probolinggo" class="logo">
        <h3 class="mb-4"><i class="fas fa-download"></i> Download Hasil Anonimisasi</h3>
        
        <?php if (isset($download_link)): ?>
            <p>Proses selesai. Anda bisa mengunduh file yang sudah di-anonimkan di bawah ini:</p>
            <a href="<?php echo $download_link; ?>" class="btn btn-success w-100 mb-2">Download File Anonim</a>
            <a href="<?php echo base_url(''); ?>" class="btn btn-primary w-100">Upload Lagi</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
