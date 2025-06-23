<!-- filepath: resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda - TRAVELGIS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f7f8fa; margin:0; }
        .hero { text-align:center; margin: 60px auto 40px auto; }
        .hero h1 { font-size:2.5rem; color:#1976d2; margin-bottom:0.5rem; }
        .hero p { color:#555; font-size:1.2rem; }
        .btn-map {
            background: #1976d2; color: #fff; border: none; border-radius: 8px;
            padding: 14px 32px; font-size: 1.2rem; margin-top: 2rem; cursor: pointer;
            transition: background 0.2s;
        }
        .btn-map:hover { background: #764ba2; }
    </style>
</head>
<body>
    @include('navbar')
    <div class="hero">
        <h1>Selamat Datang di TRAVELGIS</h1>
        <p>Peta Interaktif &amp; Data Transportasi Umum Kota Yogyakarta</p>
        <a href="/map"><button class="btn-map"><i class="fa-solid fa-map"></i> Pergi ke Map</button></a>
    </div>
</body>
</html>
