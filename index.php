<?php 
include 'koneksi.php'; 


function getData($conn, $query) {
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return ['nama' => 'Data Kosong', 'deskripsi' => '', 'foto' => '', 'gambar' => ''];
}

$profile = getData($conn, "SELECT * FROM profile LIMIT 1");
$about   = getData($conn, "SELECT * FROM about LIMIT 1");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - <?php echo $profile['nama']; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">My Portofolio</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#certificates">Certificates</a></li>
            </ul>
        </div>
    </div>
</nav>

<section id="home" class="home py-5" style="margin-top: 80px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-6">Halo, Saya</h1>
                <h1><span class="text-gradient"><?php echo $profile['nama']; ?></span></h1>
                <h3 class="text-muted"><?php echo $profile['role'] ?? 'UI/UX Designer'; ?></h3>
                <p><?php echo $profile['deskripsi']; ?></p>
                <div class="home-buttons">
                    <a href="#contact" class="btn btn-primary">Contact Me</a>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="home-image-wrapper">
                    <div class="pink-bg"></div>
                    <img src="asets/<?php echo $profile['foto']; ?>" class="img-fluid rounded-3" alt="Foto Profil">
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="about py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>About Me</h2>
                <p><?php echo $about['deskripsi']; ?></p>

                <h3 class="skills-title">Hard Skills</h3>
                <ul>
                    <li>Figma (UI Design)</li>
                    <li>Canva (Content Design)</li>
                    <li>Tableau (Data Visualization)</li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="photo-box mb-4">
                    <img src="asets/<?php echo $about['foto']; ?>" class="img-fluid rounded-3" alt="About Me">
                </div>
                <h3>Pengalaman</h3>
                <div class="experience">
                    <?php
                    $exp = mysqli_query($conn, "SELECT * FROM experience");
                    if(mysqli_num_rows($exp) > 0) {
                        while($row = mysqli_fetch_assoc($exp)) {
                            echo '<div class="exp-card mb-3 p-3 border rounded shadow-sm">
                                    <h4>'.$row['judul'].'</h4>
                                    <p>'.$row['deskripsi'].'</p>
                                    <img src="asets/'.$row['gambar'].'" class="exp-img img-fluid">
                                </div>';
                        }
                    } else { echo "<p class='text-muted'>Belum ada pengalaman.</p>"; }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="certificates" class="certificates py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Certificates</h2>
        <div class="row">
            <?php
            $cert = mysqli_query($conn, "SELECT * FROM certificates");
            while($row = mysqli_fetch_assoc($cert)) {
            ?>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 p-3 text-center shadow-sm">
                    <img src="asets/<?php echo $row['gambar']; ?>" class="card-img-top rounded-3" alt="Sertifikat">
                    <div class="card-body">
                        <h4><?php echo $row['judul']; ?></h4>
                        <p class="text-muted small"><?php echo $row['deskripsi']; ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<section id="contact" class="contact py-5 text-center">
    <h2>Contact Me</h2>
    <div class="contact-row d-flex justify-content-center gap-4 mt-3">
        <p>📧 isrinaluthfiah@gmail.com</p>
        <p>📷 @rinaltfh_</p>
    </div>
</section>

<footer class="text-center py-4 border-top">
    ©2026 - <?php echo $profile['nama']; ?>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
