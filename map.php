<?php
include "layout/header.php";
include "config.php";

$data = $conn->query("SELECT * FROM pelanggan");
?>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<div class="container-fluid">

    <!-- TOOLBAR -->
    <div class="card mb-2 p-2 shadow-sm d-flex justify-content-between">
        <div>
            <button class="btn btn-warning btn-sm" id="btnDrag">Drag Mode</button>
            <button class="btn btn-danger btn-sm" id="btnLine">Edit Garis</button>
        </div>
        <div>
            <span class="badge bg-primary">TOPOLOGY MODE</span>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-2 position-relative">

            <div id="map"></div>
            <div id="coords">Lat: - | Lng: -</div>
            <div id="popupCard" style="display:none;"></div>

        </div>
    </div>

</div>

<style>
#map { height:500px; border-radius:10px; }

#coords {
    position:absolute; bottom:10px; left:10px;
    background:black; color:white;
    padding:5px 10px; border-radius:5px;
    font-size:12px; z-index:999;
}

/* MARKER */
.marker-pin {
    width:20px; height:20px;
    background:#6366f1;
    border-radius:50% 50% 50% 0;
    transform:rotate(-45deg);
    border:2px solid white;
}

/* POPUP */
#popupCard {
    position:absolute;
    top:40px;
    left:50%;
    transform:translateX(-50%);
    width:260px;
    background:white;
    border-radius:12px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
    z-index:9999;
}

.popup-header {
    padding:10px;
    font-weight:bold;
    display:flex;
    justify-content:space-between;
}

.popup-body { padding:10px; }

.popup-footer { display:flex; }

.btn-edit { flex:1; background:#6366f1; color:white; padding:8px; text-align:center; cursor:pointer;}
.btn-delete { flex:1; background:#ef4444; color:white; padding:8px; text-align:center; cursor:pointer;}
.active-mode { background:#22c55e !important; color:white !important;}
</style>

<script>
// INIT MAP
var map = L.map('map',{zoomControl:false}).setView([-6.92,107.62],13);
setTimeout(()=>map.invalidateSize(),200);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
L.control.zoom({position:'topleft'}).addTo(map);

// STATE
var markers = {};
var lines = [];
var lineMode = false;
var dragMode = false;
var selectedNodes = [];

// =================
// POPUP
// =================
function showPopup(data){
    document.getElementById("popupCard").style.display="block";
    document.getElementById("popupCard").innerHTML = `
        <div class="popup-header">
            ${data.nama}
            <span onclick="closePopup()">✖</span>
        </div>
        <div class="popup-body">
            📦 ${data.paket}<br>
            📞 ${data.wa}<br>
            📍 ${data.lat}, ${data.lng}
        </div>
        <div class="popup-footer">
            <div class="btn-edit" onclick='editData(${JSON.stringify(data)})'>Edit</div>
            <div class="btn-delete" onclick='deleteData(${data.id})'>Delete</div>
        </div>
    `;
}

function closePopup(){
    document.getElementById("popupCard").style.display="none";
}

// =================
// DELETE
// =================
function deleteData(id){
    if(!confirm("Hapus data?")) return;

    fetch("aksi_pelanggan.php", {
        method:"POST",
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:"aksi=delete&id="+id
    })
    .then(res=>res.text())
    .then(res=>{
        if(res=="ok"){
            alert("Terhapus");
            location.reload();
        }
    });
}

// =================
// EDIT
// =================
function editData(data){
    document.getElementById("popupCard").innerHTML = `
        <div class="popup-header">
            Edit Data
            <span onclick="closePopup()">✖</span>
        </div>
        <div class="popup-body">
            <input id="e_nama" class="form-control mb-1" value="${data.nama}">
            <input id="e_paket" class="form-control mb-1" value="${data.paket}">
            <input id="e_wa" class="form-control mb-1" value="${data.wa}">
        </div>
        <div class="popup-footer">
            <div class="btn-edit" onclick="saveEdit(${data.id})">Simpan</div>
        </div>
    `;
}

// SAVE EDIT
function saveEdit(id){
    let nama = document.getElementById("e_nama").value;
    let paket = document.getElementById("e_paket").value;
    let wa = document.getElementById("e_wa").value;

    fetch("aksi_pelanggan.php", {
        method:"POST",
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:`aksi=edit&id=${id}&nama=${nama}&paket=${paket}&wa=${wa}`
    })
    .then(res=>res.text())
    .then(res=>{
        if(res=="ok"){
            alert("Updated");
            location.reload();
        }
    });
}

// =================
// LOAD MARKER
// =================
<?php while($row = $data->fetch_assoc()): ?>

var icon = L.divIcon({
    className:'',
    html:`<div class="marker-pin"></div>`,
    iconSize:[20,20]
});

var marker = L.marker(
    [<?= $row['latitude'] ?>, <?= $row['longitude'] ?>],
    {icon:icon, draggable:false}
).addTo(map);

markers["<?= $row['id'] ?>"] = marker;


// DRAG → SIMPAN KE DB
marker.on('dragend', function(e){

    let pos = e.target.getLatLng();
    let lat = pos.lat.toFixed(6);
    let lng = pos.lng.toFixed(6);

    fetch("aksi_pelanggan.php", {
        method:"POST",
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:`aksi=update_posisi&id=<?= $row['id'] ?>&lat=${lat}&lng=${lng}`
    })
    .then(res=>res.text())
    .then(res=>{
        if(res=="ok"){
            console.log("Posisi update:", lat, lng);

            // UPDATE POPUP JUGA
            showPopup({
                id:"<?= $row['id'] ?>",
                nama:"<?= $row['nama'] ?>",
                paket:"<?= $row['paket'] ?? '-' ?>",
                wa:"<?= $row['wa'] ?? '-' ?>",
                lat:lat,
                lng:lng
            });
        }
    });

});

// CLICK
marker.on('click', function(){
    showPopup({
        id:"<?= $row['id'] ?>",
        nama:"<?= $row['nama'] ?>",
        paket:"<?= $row['paket'] ?? '-' ?>",
        wa:"<?= $row['wa'] ?? '-' ?>",
        lat:"<?= $row['latitude'] ?>",
        lng:"<?= $row['longitude'] ?>"
    });
});

<?php endwhile; ?>

// =================
// DRAG MODE
// =================
document.getElementById("btnDrag").onclick = function(){
    dragMode = !dragMode;
    this.classList.toggle("active-mode");

    for(let id in markers){
        markers[id].dragging[dragMode ? 'enable':'disable']();
    }
};

// =================
// KOORD
// =================
map.on('mousemove', function(e){
    document.getElementById("coords").innerHTML =
        "Lat: "+e.latlng.lat.toFixed(6)+" | Lng: "+e.latlng.lng.toFixed(6);
});
</script>

<?php include "layout/footer.php"; ?>
