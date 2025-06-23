<!-- filepath: resources/views/tabel.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tabel Data - TRAVELGIS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f7f8fa; margin:0; }
        .container { max-width:1200px; margin:40px auto; background:#fff; border-radius:12px; box-shadow:0 4px 16px rgba(0,0,0,0.08); padding:2rem; }
        h2 { color:#1976d2; margin-bottom:1.5rem; }
        table.dataTable thead th { background:#1976d2; color:#fff; }
        .tabel-section { margin-bottom:2.5rem; }
    </style>
</head>
<body>
    @include('navbar')
    <div class="container">
        <h2><i class="fa-solid fa-table"></i> Tabel Data Fitur</h2>
        <div class="tabel-section">
            <h3 style="color:#1976d2;"><i class="fa-solid fa-bus"></i> Daftar Halte (Titik)</h3>
            <table id="tabel-titik" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Ref</th>
                        <th>Dari</th>
                        <th>Ke</th>
                        <th>Operator</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="tabel-section">
            <h3 style="color:#1976d2;"><i class="fa-solid fa-route"></i> Daftar Rute (Garis)</h3>
            <table id="tabel-garis" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Ref</th>
                        <th>Dari</th>
                        <th>Ke</th>
                        <th>Operator</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $.getJSON('/data/jalur.geojson', function(data) {
            let rowsTitik = [];
            let rowsGaris = [];
            data.features.forEach(f => {
                let jenis = f.geometry ? f.geometry.type : '-';
                let id = f.id || f.properties?.['@id'] || '-';
                let nama = f.properties?.name || f.properties?.nama || (f.properties?.['@relations']?.[0]?.reltags?.name) || '-';
                let ref = f.properties?.ref || (f.properties?.['@relations']?.[0]?.reltags?.ref) || '-';
                let dari = f.properties?.from || (f.properties?.['@relations']?.[0]?.reltags?.from) || '-';
                let ke = f.properties?.to || (f.properties?.['@relations']?.[0]?.reltags?.to) || '-';
                let operator = f.properties?.operator || (f.properties?.['@relations']?.[0]?.reltags?.operator) || '-';
                if (jenis === "Point") {
                    rowsTitik.push([id, nama, ref, dari, ke, operator]);
                } else if (jenis === "LineString" || jenis === "MultiLineString") {
                    rowsGaris.push([id, nama, ref, dari, ke, operator]);
                }
            });
            $('#tabel-titik').DataTable({
                data: rowsTitik,
                pageLength: 25
            });
            $('#tabel-garis').DataTable({
                data: rowsGaris,
                pageLength: 25
            });
        });
    });
    </script>
</body>
</html>
