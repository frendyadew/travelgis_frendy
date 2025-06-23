<!-- filepath: resources/views/navbar.blade.php -->
<nav class="navbar-travelgis">
    <div class="navbar-logo">
        <i class="fa-solid fa-bus"></i> <span>TRAVELGIS</span>
    </div>
    <div class="navbar-links">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i> Beranda
        </a>
        <a href="{{ route('map') }}" class="{{ request()->routeIs('map') ? 'active' : '' }}">
            <i class="fa-solid fa-map"></i> Peta
        </a>
        <a href="{{ route('tabel') }}" class="{{ request()->routeIs('tabel') ? 'active' : '' }}">
            <i class="fa-solid fa-table"></i> Tabel Data
        </a>
    </div>
</nav>
<style>
.navbar-travelgis {
    width: 100%;
    background: linear-gradient(90deg, #1976d2 0%, #764ba2 100%);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.5rem 1rem;
    box-shadow: 0 2px 12px rgba(44,62,80,0.07);
    position: sticky;
    top: 0;
    z-index: 2000;
    overflow-x: auto;      /* Tambahkan ini */
    box-sizing: border-box;/* Tambahkan ini */
}
.navbar-logo {
    font-size: 1.1rem;
    font-weight: bold;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.navbar-logo i {
    font-size: 1.3rem;
    color: #fff176;
}
.navbar-links {
    display: flex;
    gap: 0.7rem;
}
.navbar-links a {
    color: #fff;
    text-decoration: none;
    font-size: 1rem;
    padding: 6px 12px;
    border-radius: 6px;
    transition: background 0.18s, color 0.18s;
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-weight: 500;
}
.navbar-links a.active,
.navbar-links a:hover {
    background: rgba(255,255,255,0.18);
    color: #fff176;
}
@media (max-width: 700px) {
    .navbar-travelgis { flex-direction: column; align-items: flex-start; padding: 0.5rem 0.5rem;}
    .navbar-links { gap: 0.2rem; width: 100%; }
    .navbar-links a { width: 100%; justify-content: flex-start; }
}
</style>
