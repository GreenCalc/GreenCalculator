// Fungsi untuk memilih kategori dan menampilkan bagian yang relevan
function selectCategory(sectionId) {
    const sections = document.querySelectorAll('.calculator-section');
    sections.forEach(section => {
        section.style.display = 'none';
    });

    const buttons = document.querySelectorAll('.category-option');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    document.getElementById(sectionId).style.display = 'block';
    document.querySelector(`#${sectionId.replace('section-', '')}`).classList.add('active');
}

// Kalkulator Emisi Transportasi Darat (versi terbaru dengan POST ke user.php)
function calculateCarbon() {
    const vehicleType = document.querySelector('input[name="vehicleType"]:checked').value;
    const distance = parseFloat(document.getElementById('distance').value);
    const frequency = parseInt(document.getElementById('frequency').value);

    // Logika perhitungan emisi
    let emission;
    if (vehicleType === "mobil_bensin") {
        emission = distance * 0.2 * frequency; // Contoh faktor emisi untuk mobil bensin
    } else if (vehicleType === "mobil_diesel") {
        emission = distance * 0.15 * frequency; // Contoh faktor emisi untuk mobil diesel
    } else if (vehicleType === "motor") {
        emission = distance * 0.1 * frequency; // Contoh faktor emisi untuk motor
    } else if (vehicleType === "bus") {
        emission = distance * 0.05 * frequency; // Contoh faktor emisi untuk bus
    }

    // Kirim data ke PHP menggunakan AJAX
    fetch('kalkulator.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ 
            vehicleType: vehicleType,
            distance: distance,
            frequency: frequency,
            emission: emission
        })
    })
    .then(response => response.json())
    .then(data => {
        // Menampilkan hasil
        document.getElementById('result').innerText = `Total Emisi: ${data.emission} Kg CO₂eq`;
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('result').innerText = 'Terjadi kesalahan saat mengupload data.';
    });
}


// Kalkulator Emisi Peralatan Rumah Tangga
function calculateApplianceEmissions() {
    const emissionFactor = 0.85;

    const appliance1Power = parseFloat(document.getElementById('alat-1-daya').value);
    const appliance1Hours = parseFloat(document.getElementById('alat-1-jam').value);
    const appliance2Power = parseFloat(document.getElementById('alat-2-daya').value);
    const appliance2Hours = parseFloat(document.getElementById('alat-2-jam').value);
    const appliance3Power = parseFloat(document.getElementById('alat-3-daya').value);
    const appliance3Hours = parseFloat(document.getElementById('alat-3-jam').value);

    const dailyConsumptionKWh = ((appliance1Power * appliance1Hours) + 
                                 (appliance2Power * appliance2Hours) + 
                                 (appliance3Power * appliance3Hours)) / 1000;
    const annualConsumptionKWh = dailyConsumptionKWh * 365;

    const totalEmissionKg = annualConsumptionKWh * emissionFactor;
    const totalEmissionTon = totalEmissionKg / 1000;

    document.getElementById('appliance-emission').textContent = totalEmissionTon.toFixed(2);
}

// Mengelola opsi frekuensi peralatan tambahan
function toggleOptions(optionId) {
    const element = document.getElementById(optionId);
    element.style.display = element.style.display === "none" ? "block" : "none";
}

// Kalkulator Emisi Makanan
const foodEmissionFactors = {
    "egg": { "1-3": 0.3, "4-5": 0.5, "every-day": 0.7 },
    "milk": { "1-3": 0.4, "4-5": 0.6, "every-day": 0.9 },
    "rice": { "1-3": 0.5, "4-5": 0.8, "every-day": 1.2 },
    "seafood": { "1-3": 1.0, "4-5": 1.5, "every-day": 2.0 },
    "poultry": { "1-3": 0.7, "4-5": 1.0, "every-day": 1.5 },
    "lamb": { "1-3": 1.5, "4-5": 2.0, "every-day": 2.5 },
    "beef": { "1-3": 2.0, "4-5": 2.8, "every-day": 3.5 },
    "dairy-products": { "1-3": 0.5, "4-5": 0.7, "every-day": 1.0 }
};

function toggleFrequencyOptions(id) {
    const element = document.getElementById(id);
    element.style.display = element.style.display === "none" ? "block" : "none";
}

function calculateEmissions() {
    let totalEmissions = 0;

    for (const [food, factors] of Object.entries(foodEmissionFactors)) {
        const isChecked = document.getElementById(`${food}-checkbox`).checked;
        if (isChecked) {
            const selectedFrequency = document.querySelector(`input[name="frequency-${food}"]:checked`);
            if (selectedFrequency) {
                const frequency = selectedFrequency.value;
                totalEmissions += factors[frequency];
            }
        }
    }

    document.getElementById("food-emission-result").innerText = totalEmissions.toFixed(2); // hasil dalam kg CO₂eq
}

fetch('kalkulator.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({ type: 'land', emission: emission })
})
.then(response => response.json())
.then(data => {
    console.log(data); // Tambahkan ini untuk debugging
    document.getElementById('result').innerText = `Total Emisi: ${data.emission} Kg CO₂eq`;
});

