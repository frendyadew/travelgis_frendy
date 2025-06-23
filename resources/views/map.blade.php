<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAVELGIS - Peta Transportasi Umum Yogyakarta</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Custom CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1000;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .header p {
            color: #7f8c8d;
            text-align: center;
            font-size: 1rem;
        }

        .container {
            padding: 2rem;
            max-width: 1300px;
            margin: 0 auto;
        }

        .map-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        #map {
            height: 70vh;
            min-height: 400px;
            width: 100%;
            border-radius: 20px;
        }

        .legend {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            font-size: 14px;
            min-width: 200px;
        }

        .legend h4 {
            margin-bottom: 10px;
            color: #2c3e50;
            font-weight: 600;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .legend-item:last-child {
            margin-bottom: 0;
        }

        .legend-icon {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .halte-icon {
            background: #e74c3c;
        }

        .legend-line {
            width: 20px;
            height: 3px;
            margin-right: 10px;
            background: #3498db;
            border-radius: 2px;
        }

        .loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #7f8c8c;
            font-size: 1.2rem;
            z-index: 999;
        }

        /* Custom popup styling */
        .leaflet-popup-content-wrapper {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .leaflet-popup-content {
            margin: 15px 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .popup-title {
            font-weight: 600;
            color: #2c3e50;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .popup-info {
            color: #7f8c8d;
            font-size: 14px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .header {
                padding: 1rem;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .container {
                padding: 1rem;
            }

            #map {
                height: 60vh;
                min-height: 400px;
            }

            .legend {
                bottom: 10px;
                right: 10px;
                left: 10px;
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 1.2rem;
            }

            .header p {
                font-size: 0.9rem;
            }

            #map {
                height: 55vh;
                min-height: 350px;
            }
        }

        .stat-bar {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            padding: 10px 20px;
            font-size: 15px;
        }

        .stat-bar div {
            display: flex;
            align-items: center;
        }

        .stat-bar label {
            margin-right: 10px;
        }

        #dropdown-rute {
            margin-left: 1rem;
        }

        .stat-bar-modern {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.97);
            border-radius: 14px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            padding: 14px 28px;
            margin-bottom: 1.2rem;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .stat-info {
            display: flex;
            gap: 2.5rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.1rem;
            color: #2c3e50;
        }

        .stat-label i {
            color: #1976d2;
            margin-right: 0.3rem;
        }

        .stat-value {
            font-weight: bold;
            font-size: 1.15rem;
            color: #222;
            background: #f2f6fa;
            border-radius: 6px;
            padding: 2px 10px;
            margin-left: 0.2rem;
        }

        .stat-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stat-btn {
            border: none;
            outline: none;
            background: #f2f6fa;
            color: #1976d2;
            font-size: 1.25rem;
            padding: 8px 14px;
            border-radius: 8px 0 0 8px;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            margin-right: -4px;
        }

        .stat-btn:last-child {
            border-radius: 0 8px 8px 0;
            margin-right: 0;
        }

        .stat-btn.active,
        .stat-btn:hover {
            background: #1976d2;
            color: #fff;
        }

        .modern-dropdown {
            border: 1.5px solid #1976d2;
            border-radius: 8px;
            padding: 7px 14px;
            font-size: 1rem;
            margin-left: 1rem;
            background: #f2f6fa;
            color: #222;
            transition: border 0.2s;
        }

        .modern-dropdown:focus {
            border: 2px solid #764ba2;
            outline: none;
        }

        @media (max-width: 600px) {
            .stat-bar-modern {
                flex-direction: column;
                align-items: stretch;
                gap: 0.7rem;
                padding: 10px 8px;
            }

            .stat-info {
                gap: 1.2rem;
            }

            .stat-controls {
                gap: 0.2rem;
            }

            .modern-dropdown {
                margin-left: 0.5rem;
            }
        }
    </style>
</head>

<body>
    @include('navbar')
    <div class="header text-white text-center p-4 rounded-b-xl shadow-md"
        style="
        background: url('/images/trans-jogja.jpg') center/cover no-repeat;
     ">
        <h1 class="text-2xl font-bold flex items-center justify-center gap-2">
            🗺️ TRAVELGIS
        </h1>
        <p class="text-sm mt-1">
            Peta Transportasi Umum Kota Yogyakarta
        </p>
    </div>


    <div class="container">
        <div class="stat-bar-modern">
            <div class="stat-info">
                <div class="stat-item">
                    <span class="stat-label"><i class="fa-solid fa-bus"></i> Halte</span>
                    <span id="stat-halte" class="stat-value">-</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label"><i class="fa-solid fa-route"></i> Rute</span>
                    <span id="stat-rute" class="stat-value">-</span>
                </div>
            </div>
            <div class="stat-controls">
                <button id="btn-rute" class="stat-btn active" title="Tampilkan Rute">
                    <i class="fa-solid fa-route"></i>
                </button>
                <button id="btn-halte" class="stat-btn active" title="Tampilkan Halte">
                    <i class="fa-solid fa-bus"></i>
                </button>
                <button id="btn-heatmap" class="stat-btn" title="Tampilkan Heatmap">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>
                <select id="dropdown-rute" class="modern-dropdown">
                    <option value="">-- Pilih Rute --</option>
                </select>
            </div>
        </div>

        <div class="map-container">
            <div class="loading" id="loading">Memuat peta...</div>
            <div id="map"></div>

            <div class="legend">
                <h4>📍 Legenda</h4>
                <div class="legend-item">
                    <div class="legend-icon halte-icon" style="border:2px solid #b71c1c; background:#e74c3c"></div>
                    <span>
                        Halte Trans Jogja<br>
                        <small style="color:#888;">Tidak dilalui trayek biru</small>
                    </span>
                </div>
                <div class="legend-item">
                    <div class="legend-icon halte-icon" style="border:2px solid #1976d2; background:#e74c3c"></div>
                    <span>
                        Halte Trans Jogja<br>
                        <small style="color:#1976d2;">Dilalui trayek biru (2A/2B)</small>
                    </span>
                </div>
                <div class="legend-item">
                    <div class="legend-line"></div>
                    <span>
                        Jalur Trayek Bus<br>
                        <small style="color:#3498db;">Garis putus-putus: rute bus Trans Jogja</small>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.heat/dist/leaflet-heat.js"></script>

    <script>
        // Basemap layers
        const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors | TRAVELGIS Yogyakarta',
            maxZoom: 19
        });
        const satelliteLayer = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles © Esri'
            });
        const darkLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://carto.com/">CARTO</a>'
        });

        // Inisialisasi peta dengan OSM sebagai default
        const map = L.map('map', {
            zoomControl: false,
            layers: [osmLayer]
        }).setView([-7.7956, 110.3695], 12);

        // Layer control
        const baseMaps = {
            "OpenStreetMap": osmLayer,
            "Satellite": satelliteLayer,
            "Dark": darkLayer
        };
        L.control.layers(baseMaps, null, {
            position: 'topright',
            collapsed: false
        }).addTo(map);

        // Sembunyikan loading setelah peta dimuat
        map.whenReady(function() {
            document.getElementById('loading').style.display = 'none';
        });

        // Style untuk jalur trayek
        const jalurStyle = {
            color: '#3498db',
            weight: 4,
            opacity: 0.8,
            dashArray: '10, 5'
        };
        const jalurHighlightStyle = {
            color: '#e67e22',
            weight: 7,
            opacity: 1,
            dashArray: ''
        };

        // Variabel global untuk menyimpan layer
        let garisLayer, titikLayer, heatLayer;
        let allRouteLayers = [];
        let routeOptions = [];
        let dropdownActive = false; // Tambahkan flag global

        // Ambil dropdown di luar fungsi
        const dropdown = document.getElementById('dropdown-rute');

        // Event handler dropdown (hanya perlu di-set sekali)
        dropdown.onchange = function() {
            dropdownActive = false;
            if (this.value !== "") {
                dropdownActive = true;
            }
            allRouteLayers.forEach((l, i) => {
                if (this.value !== "" && i == this.value) {
                    l.setStyle(jalurHighlightStyle);
                    l.bringToFront();
                    l.openPopup();
                    // Zoom ke extent rute terpilih
                    if (l.getBounds) {
                        map.fitBounds(l.getBounds(), {
                            padding: [30, 30]
                        });
                    }
                } else {
                    l.setStyle({
                        color: "#bbb",
                        weight: 3,
                        opacity: 0.5,
                        dashArray: '10, 5'
                    });
                }
            });
            // Jika tidak ada yang dipilih, kembalikan semua ke style semula
            if (this.value === "") {
                allRouteLayers.forEach(l => {
                    l.setStyle({
                        ...jalurStyle,
                        color: l.feature.properties?.color || l.feature.properties?.colour || '#3498db'
                    });
                });
            }
        };

        // Fungsi untuk memuat dan menampilkan data jalur saja
        function loadJalurData() {
            fetch('/data/jalur.geojson')
                .then(response => {
                    if (!response.ok) throw new Error('Gagal memuat data jalur');
                    return response.json();
                })
                .then(data => {
                    // Pisahkan fitur titik dan garis
                    const titikFeatures = [];
                    const garisFeatures = [];
                    data.features.forEach(f => {
                        if (f.geometry && f.geometry.type === "Point") {
                            titikFeatures.push(f);
                        } else if (f.geometry && (f.geometry.type === "LineString" || f.geometry.type ===
                                "MultiLineString")) {
                            garisFeatures.push(f);
                        }
                    });

                    // Statistik
                    document.getElementById('stat-halte').textContent = titikFeatures.length;
                    document.getElementById('stat-rute').textContent = garisFeatures.length;

                    // Kosongkan dropdown sebelum mengisi ulang
                    dropdown.innerHTML = '<option value="">-- Pilih Rute --</option>';
                    routeOptions = garisFeatures.map(f => ({
                        ref: f.properties?.ref || '-',
                        name: f.properties?.name || f.properties?.nama || '-',
                        id: f.id
                    }));
                    routeOptions.forEach((r, i) => {
                        const opt = document.createElement('option');
                        opt.value = i;
                        opt.textContent = `${r.ref} - ${r.name}`;
                        dropdown.appendChild(opt);
                    });

                    // Layer garis (jalur)
                    allRouteLayers = [];
                    garisLayer = L.geoJSON({
                        type: "FeatureCollection",
                        features: garisFeatures
                    }, {
                        style: function(feature) {
                            return {
                                ...jalurStyle,
                                color: feature.properties?.color || feature.properties?.colour || '#3498db'
                            };
                        },
                        onEachFeature: function(feature, layer) {
                            allRouteLayers.push(layer);

                            // Tambahkan popup untuk garis (jalur)
                            const nama = feature.properties?.nama || feature.properties?.name ||
                                'Jalur Transportasi Umum';
                            const keterangan = feature.properties?.keterangan || '';
                            const from = feature.properties?.from || feature.properties?.dari || '';
                            const to = feature.properties?.to || feature.properties?.tujuan || '';
                            const operator = feature.properties?.operator || '';
                            const ref = feature.properties?.ref || '';
                            let popupContent = `
                                <div class="popup-title">🚌 ${nama}</div>
                                <div class="popup-info">
                                    <b>Trayek:</b> ${ref ? ref : '-'}<br>
                                    <b>Dari:</b> ${from ? from : '-'}<br>
                                    <b>Ke:</b> ${to ? to : '-'}<br>
                                    <b>Operator:</b> ${operator ? operator : '-'}
                                    ${keterangan ? `<br><b>Keterangan:</b> ${keterangan}` : ''}
                                </div>
                            `;
                            layer.bindPopup(popupContent);

                            // Highlight effect on hover for line
                            function hoverIn(e) {
                                if (dropdownActive) return;
                                allRouteLayers.forEach(l => {
                                    if (l !== layer) {
                                        l.setStyle({
                                            color: "#bbb",
                                            weight: 3,
                                            opacity: 0.5,
                                            dashArray: '10, 5'
                                        });
                                    }
                                });
                                layer.setStyle(jalurHighlightStyle);
                                layer.bringToFront();
                            }

                            function hoverOut(e) {
                                if (dropdownActive) return;
                                allRouteLayers.forEach(l => {
                                    l.setStyle({
                                        ...jalurStyle,
                                        color: l.feature.properties?.color || l.feature
                                            .properties?.colour || '#3498db'
                                    });
                                });
                            }

                            layer.on('mouseover', hoverIn);
                            layer.on('mouseout', hoverOut);

                            // Aktifkan kembali hover saat popup close
                            layer.on('popupclose', function() {
                                dropdownActive = false;
                            });
                        }
                    }).addTo(map);

                    // Layer titik (halte)
                    titikLayer = L.geoJSON({
                        type: "FeatureCollection",
                        features: titikFeatures
                    }, {
                        pointToLayer: function(feature, latlng) {
                            // Cek outline: jika ada reltags.colour = biru, outline biru, selain itu merah
                            let outlineColor = "#b71c1c";
                            const relations = feature.properties['@relations'] || [];
                            if (relations.length > 0) {
                                // Cek semua reltags, jika ada yang colour biru, pakai biru
                                for (const rel of relations) {
                                    if (rel.reltags && (rel.reltags.colour === "#1976d2" || rel.reltags
                                            .colour === "#1A93DB")) {
                                        outlineColor = "#1976d2";
                                        break;
                                    }
                                }
                            }
                            return L.circleMarker(latlng, {
                                radius: 8,
                                fillColor: "#e74c3c",
                                color: outlineColor,
                                weight: 2,
                                opacity: 1,
                                fillOpacity: 0.9
                            });
                        },
                        onEachFeature: function(feature, layer) {
                            let popupContent = `<div class="popup-title">🚌 Halte Dilewati:</div><ul>`;
                            const relations = feature.properties['@relations'] || [];
                            if (relations.length === 0) {
                                popupContent += `<li>Data trayek tidak tersedia</li>`;
                            } else {
                                relations.forEach(rel => {
                                    const r = rel.reltags || {};
                                    popupContent += `<li><b>${r.ref || '-'}</b> - ${r.name || '-'}<br>
                                        <small>Dari: ${r.from || '-'} → Tujuan: ${r.to || '-'}</small>
                                    </li>`;
                                });
                            }
                            popupContent += `</ul>`;
                            layer.bindPopup(popupContent);

                            // Highlight effect on hover for point
                            layer.on('mouseover', function(e) {
                                this.setStyle({
                                    radius: 12,
                                    fillColor: "#fff176",
                                    color: "#fbc02d",
                                    weight: 3,
                                    opacity: 1,
                                    fillOpacity: 1
                                });
                                this.bringToFront();
                            });
                            layer.on('mouseout', function(e) {
                                // Kembalikan warna outline sesuai data
                                let outlineColor = "#b71c1c";
                                const relations = feature.properties['@relations'] || [];
                                if (relations.length > 0) {
                                    for (const rel of relations) {
                                        if (rel.reltags && (rel.reltags.colour === "#1976d2" || rel
                                                .reltags.colour === "#1A93DB")) {
                                            outlineColor = "#1976d2";
                                            break;
                                        }
                                    }
                                }
                                this.setStyle({
                                    radius: 8,
                                    fillColor: "#e74c3c",
                                    color: outlineColor,
                                    weight: 2,
                                    opacity: 1,
                                    fillOpacity: 0.9
                                });
                            });
                        }
                    }).addTo(map); // Titik selalu di atas garis

                    // Layer heatmap
                    const heatPoints = [];
                    garisFeatures.forEach(f => {
                        if (f.geometry.type === "LineString") {
                            f.geometry.coordinates.forEach(coord => heatPoints.push([coord[1], coord[0]]));
                        } else if (f.geometry.type === "MultiLineString") {
                            f.geometry.coordinates.forEach(line =>
                                line.forEach(coord => heatPoints.push([coord[1], coord[0]]))
                            );
                        }
                    });
                    heatLayer = L.heatLayer(heatPoints, {
                        radius: 25,
                        blur: 32,
                        maxZoom: 17,
                        gradient: {
                            0.4: 'blue',
                            0.65: 'lime',
                            1: 'red'
                        }
                    });

                    // Toggle Layer
                    document.getElementById('toggle-rute').onchange = function() {
                        if (this.checked) map.addLayer(garisLayer);
                        else map.removeLayer(garisLayer);
                    };
                    document.getElementById('toggle-halte').onchange = function() {
                        if (this.checked) map.addLayer(titikLayer);
                        else map.removeLayer(titikLayer);
                    };
                    document.getElementById('toggle-heatmap').onchange = function() {
                        if (this.checked) map.addLayer(heatLayer);
                        else map.removeLayer(heatLayer);
                    };

                    // Event handler dropdown (hanya perlu di-set sekali, di luar loadJalurData)
                    dropdown.onchange = function() {
                        dropdownActive = false;
                        if (this.value !== "") {
                            dropdownActive = true;
                        }
                        allRouteLayers.forEach((l, i) => {
                            if (this.value !== "" && i == this.value) {
                                l.setStyle(jalurHighlightStyle);
                                l.bringToFront();
                                l.openPopup();
                                // Zoom ke extent rute terpilih
                                if (l.getBounds) {
                                    map.fitBounds(l.getBounds(), {
                                        padding: [30, 30]
                                    });
                                }
                            } else {
                                l.setStyle({
                                    color: "#bbb",
                                    weight: 3,
                                    opacity: 0.5,
                                    dashArray: '10, 5'
                                });
                            }
                        });
                        // Jika tidak ada yang dipilih, kembalikan semua ke style semula
                        if (this.value === "") {
                            allRouteLayers.forEach(l => {
                                l.setStyle({
                                    ...jalurStyle,
                                    color: l.feature.properties?.color || l.feature.properties
                                        ?.colour || '#3498db'
                                });
                            });
                        }
                    };
                })
                .catch(error => {
                    console.error('❌ Error loading jalur data:', error);
                });
        }

        // Muat data saat halaman selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            loadJalurData();
        });

        // Tambahkan kontrol untuk zoom
        L.control.zoom({
            position: 'topleft'
        }).addTo(map);

        // Tambahkan kontrol scale
        L.control.scale({
            position: 'bottomleft',
            imperial: false
        }).addTo(map);

        // Setelah inisialisasi layer
        document.getElementById('btn-rute').onclick = function() {
            this.classList.toggle('active');
            if (this.classList.contains('active')) map.addLayer(garisLayer);
            else map.removeLayer(garisLayer);
        };
        document.getElementById('btn-halte').onclick = function() {
            this.classList.toggle('active');
            if (this.classList.contains('active')) map.addLayer(titikLayer);
            else map.removeLayer(titikLayer);
        };
        document.getElementById('btn-heatmap').onclick = function() {
            this.classList.toggle('active');
            if (this.classList.contains('active')) map.addLayer(heatLayer);
            else map.removeLayer(heatLayer);
        };
    </script>
</body>

</html>
