<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anonymizer PN - Proses Anonimisasi</title>
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
        }
        .container {
            max-width: 600px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            color: black;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
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
    <div class="card p-4 text-center">
        <img src="<?php echo base_url('PN.png'); ?>" alt="Logo Pengadilan Negeri Probolinggo" class="logo">
        <h3 class="mb-4"><i class="fas fa-user-secret"></i> Anonymizer PN</h3>

        <?php if (!isset($original_name)): ?>
            <?php echo form_open_multipart('anonymizer/process'); ?>
            <div class="mb-3 text-start">
                <label for="document" class="form-label">Unggah Dokumen (format .docx)</label>
                <input type="file" class="form-control" name="document" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Unggah Dokumen</button>
            <?php echo form_close(); ?>
        <?php endif; ?>

        <?php if (isset($original_name) && isset($original_address)): ?>
            <div class="alert alert-info text-start">
                <strong>Nama Ditemukan:</strong> <?php echo $original_name; ?><br>
                <strong>Alamat Ditemukan:</strong> <?php echo $original_address; ?>
            </div>

            <?php echo form_open('anonymizer/anonymize'); ?>
            
            
                <input type="hidden" class="form-control" name="original_name" value="<?php echo $original_name; ?>" readonly>
                <input type="hidden" class="form-control" name="original_address" value="<?php echo $original_address; ?>" readonly>

            <!-- Input Nama Anonim -->
            <div class="mb-3 text-start">
                <label for="anonymous_name" class="form-label">Nama Anonim</label>
                <input type="text" class="form-control" name="anonymous_name" placeholder="Masukkan nama anonim" required>
            </div>


            <!-- Input Alamat Anonim -->
            <div class="mb-3 text-start">
                <label for="anonymous_address" class="form-label">Alamat Anonim</label>
                <input type="text" class="form-control" name="anonymous_address" placeholder="Masukkan alamat anonim (kabupaten)" required>
            </div>

            <input type="hidden" name="file_path" value="<?php echo $file_path; ?>">
            <button type="submit" class="btn btn-success w-100">Proses Anonimisasi</button>
            <?php echo form_close(); ?>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger mt-3"> <?php echo $error; ?> </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
