let totalEmisi = 0; // Total emisi global

// Fungsi untuk memperbarui hasil berdasarkan kategori yang dipilih
function updateResult(category, emisi, totalEmisi) {
    if (category === "Darat") {
        document.getElementById('resultDarat').innerHTML = `
            <p>Emisi yang dihasilkan: ${emisi.toFixed(2)} kg CO2</p>
            <p>Total Emisi Kendaraan Darat: ${totalEmisi.toFixed(2)} kg CO2</p>
        `;
    } else if (category === "Udara") {
        document.getElementById('resultUdara').innerHTML = `
            <p>Emisi yang dihasilkan: ${emisi.toFixed(2)} kg CO2</p>
            <p>Total Emisi Kendaraan Udara: ${totalEmisi.toFixed(2)} kg CO2</p>
        `;
    } else if (category === "Daya Rumah Tangga") {
        document.getElementById('resultDaya').innerHTML = `
            <p>Emisi yang dihasilkan dari peralatan: ${emisi.toFixed(2)} kg CO2</p>
            <p>Total Emisi Daya Rumah Tangga: ${totalEmisi.toFixed(2)} kg CO2</p>
        `;
    }
}

// Event listener untuk formulir kendaraan darat
document.getElementById('emisiFormDarat').addEventListener('submit', function(event) {
    event.preventDefault();

    // Ambil nilai dari formulir
    const jenisKendaraan = document.getElementById('kendaraanDarat').value;
    const jenisBahanBakar = document.getElementById('jenis-bahan-bakar-darat').value;
    const jarakTempuh = parseFloat(document.getElementById('jarak-tempuh-darat').value);
    let emisi = 0;

    // Hitung emisi berdasarkan jenis kendaraan dan bahan bakar
    if (jenisBahanBakar === 'Bensin') {
        if (jenisKendaraan === 'Mobil') emisi = jarakTempuh * 2.31;
        else if (jenisKendaraan === 'Motor') emisi = jarakTempuh * 1.89;
        else if (jenisKendaraan === 'Bis') emisi = jarakTempuh * 3.0;
    } else if (jenisBahanBakar === 'Diesel') {
        if (jenisKendaraan === 'Mobil') emisi = jarakTempuh * 2.68;
        else if (jenisKendaraan === 'Motor') emisi = jarakTempuh * 1.99;
        else if (jenisKendaraan === 'Bis') emisi = jarakTempuh * 3.5;
    }

    // Tambahkan emisi ke total
    totalEmisi += emisi;
    
    // Panggil fungsi untuk memperbarui hasil
    updateResult("Darat", emisi, totalEmisi);

    // Reset form
    this.reset();
});

// Event listener untuk formulir kendaraan udara

// Event listener untuk formulir daya rumah tangga
document.getElementById('emisiFormDaya').addEventListener('submit', function(event) {
    event.preventDefault();

    // Ambil nilai dari formulir
    const jenisPeralatan = document.getElementById('peralatan').value;
    const daya = parseFloat(document.getElementById('daya').value);
    const jamPakai = parseFloat(document.getElementById('jam-pakai').value);
    let emisi = 0;

    // Hitung emisi berdasarkan jenis peralatan dan daya
    const kWh = (daya * jamPakai) / 1000; // Menghitung konsumsi listrik dalam kWh
    const emisiPerkWh = 0.475; // Angka emisi rata-rata untuk listrik (kg CO2/kWh)

    // Hitung total emisi
    emisi = kWh * emisiPerkWh;

    // Tambahkan emisi ke total
    totalEmisi += emisi;

    // Panggil fungsi untuk memperbarui hasil
    updateResult("Daya Rumah Tangga", emisi, totalEmisi);

    // Reset form
    this.reset();
});

function hitungEmisi() {
    var form = document.getElementById("formTransportasiUdara");
    var formData = new FormData(form);

    // Mengirim data form ke PHP menggunakan fetch
    fetch("hitung_emisi.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Menampilkan hasil emisi
        if (data.success) {
            document.getElementById('resultTransportasiUdara').innerHTML = `
                <h4>Total Emisi CO₂: ${data.total_emisi} kg</h4>
            `;
        } else {
            document.getElementById('resultTransportasiUdara').innerHTML = data.message;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('resultTransportasiUdara').innerHTML = "Terjadi kesalahan. Silakan coba lagi.";
    });
}
