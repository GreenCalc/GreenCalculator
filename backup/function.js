function calculateCarbon() {
    console.log("Fungsi calculateCarbon() dipanggil");
    const vehicleType = document.getElementById('vehicleType').value;
    const distance = parseFloat(document.getElementById('distance').value);
    const frequency = parseInt(document.getElementById('frequency').value);

    // Faktor Emisi (gram CO₂ per km)
    const emissionFactors = {
        mobil_bensin: 239,   // 239 g/km
        mobil_diesel: 265,   // 265 g/km
        motor: 110,          // 110 g/km
        bus: 27,             // 27 g/km (per penumpang)
        sepeda: 0            // 0 g/km
    };

    if (!distance || distance <= 0) {
        document.getElementById('result').innerHTML = "Masukkan jarak yang valid.";
        return;
    }

    const emissionFactor = emissionFactors[vehicleType];
    const totalEmissions = (emissionFactor * distance * frequency) / 1000; // hasil dalam kg CO₂

    document.getElementById('result').innerHTML = `Estimasi Emisi Karbon: ${totalEmissions.toFixed(2)} kg CO₂`;
}


// Attach the calculateEmissions function to the button after the DOM loads
document.addEventListener("DOMContentLoaded", function () {
});


function calculateFlightEmissions() {
    console.log("calculateFlightEmissions function triggered"); // Debug line

    // Emission factors (in grams CO₂ per km) by flight class
    const emissionFactors = {
        economy: 0.115,    // Economy class emission factor
        business: 0.23     // Business class emission factor
    };

    // Get the selected flight class
    const flightClass = document.querySelector('input[name="flight-class"]:checked').value;
    console.log("Selected flight class:", flightClass); // Debug line

    // Get the flight type (one-way or round-trip)
    const flightType = document.querySelector('input[name="flight-type"]:checked').value;
    const multiplier = flightType === "round-trip" ? 2 : 1;
    console.log("Flight type multiplier:", multiplier); // Debug line

    // Get the frequency of flights per year
    const frequency = parseInt(document.querySelector('input[name="flight-frequency"]:checked').value);
    console.log("Flight frequency per year:", frequency); // Debug line

    // Get the distance from the range input
    const distance = parseFloat(document.getElementById("flight-distance").value);
    console.log("Flight distance per trip (km):", distance); // Debug line

    // Check if distance is valid
    if (isNaN(distance) || distance <= 0) {
        alert("Masukkan jarak penerbangan yang valid.");
        return;
    }

    // Calculate total emissions: distance * emission factor * flight type multiplier * frequency
    const emissions = distance * emissionFactors[flightClass] * multiplier * frequency;

    // Display result in tons of CO₂ (converting grams to tons)
    document.querySelector(".result span").textContent = (emissions / 1_000).toFixed(2);
    console.log("Total emissions calculated:", (emissions / 1_000).toFixed(2));
}

// Attach event listener to the button for calculating flight emissions
document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".calculate-btn").addEventListener("click", calculateFlightEmissions);
});


// Fungsi untuk menghitung emisi dari daya rumah tangga
function calculateApplianceEmissions() {
    const appliance1Power = document.getElementById("alat-1-daya").value;
    const appliance1Hours = document.getElementById("alat-1-jam").value;
    const appliance2Power = document.getElementById("alat-2-daya").value;
    const appliance2Hours = document.getElementById("alat-2-jam").value;
    const appliance3Power = document.getElementById("alat-3-daya").value;
    const appliance3Hours = document.getElementById("alat-3-jam").value;

    const totalPowerConsumption = 
        (appliance1Power * appliance1Hours + appliance2Power * appliance2Hours + appliance3Power * appliance3Hours) * 365; // kWh per year

    const emissionFactor = 0.0007; // ton CO2 per kWh
    const totalEmissions = totalPowerConsumption * emissionFactor;

    document.getElementById("appliance-emission").textContent = totalEmissions.toFixed(2);
}

// Fungsi untuk memilih kategori
function selectCategory(categoryId) {
    const sections = document.querySelectorAll(".calculator-section");
    sections.forEach(section => section.style.display = "none");

    document.getElementById(`section-${categoryId}`).style.display = "block";

    const options = document.querySelectorAll(".category-option");
    options.forEach(option => option.classList.remove("active"));

    document.getElementById(categoryId).classList.add("active");

    var allCategories = document.querySelectorAll('.category-option');
    allCategories.forEach(function(category) {
        category.classList.remove('active');
    });

    // Tambahkan kelas 'active' hanya ke kategori yang dipilih
    var selectedCategory = document.getElementById(categoryId);
    selectedCategory.classList.add('active');
}

function toggleLightingOptions() {
    const lightingOptions = document.getElementById('lighting-options');
    const lightingCheckbox = document.getElementById('lighting-checkbox');
    if (lightingCheckbox.checked) {
        lightingOptions.classList.remove('hidden');
        lightingOptions.classList.add('visible');
    } else {
        lightingOptions.classList.remove('visible');
        lightingOptions.classList.add('hidden');
    }
}

function selectOption(optionId) {
    const options = document.querySelectorAll('.option');
    options.forEach(option => {
        option.classList.remove('active');
    });
    document.getElementById(optionId).classList.add('active');
}

document.getElementById('lighting-checkbox').addEventListener('change', function() {
    var lightingOptions = document.getElementById('lighting-options');
    if (this.checked) {
        lightingOptions.style.display = 'block';
    } else {
        lightingOptions.style.display = 'none';
    }
});

document.getElementById('ac-checkbox').addEventListener('change', function() {
    var acOptions = document.getElementById('ac-options');
    if (this.checked) {
        acOptions.style.display = 'block';
    } else {
        acOptions.style.display = 'none';
    }
});

document.getElementById('fridge-checkbox').addEventListener('change', function() {
    var fridgeOptions = document.getElementById('fridge-options');
    if (this.checked) {
        fridgeOptions.style.display = 'block';
    } else {
        fridgeOptions.style.display = 'none';
    }
});

// Toggle Pendingin Ruangan options
document.getElementById('ac-checkbox').addEventListener('change', function() {
    var acOptions = document.getElementById('ac-options');
    if (this.checked) {
        acOptions.style.display = 'block';
    } else {
        acOptions.style.display = 'none';
    }
});

// Toggle Kulkas options
document.getElementById('fridge-checkbox').addEventListener('change', function() {
    var fridgeOptions = document.getElementById('fridge-options');
    if (this.checked) {
        fridgeOptions.style.display = 'block';
    } else {
        fridgeOptions.style.display = 'none';
    }
});

document.getElementById("ac-checkbox").addEventListener("change", calculateCarbon);
document.getElementById("fridge-checkbox").addEventListener("change", calculateCarbon);
document.getElementById("ac-count").addEventListener("input", calculateCarbon);
document.getElementById("ac-usage").addEventListener("input", calculateCarbon);
document.getElementById("fridge-checkbox").addEventListener("change", calculateCarbon);

function calculateCarbon() {
    let acCarbonEmission = 0;
    let fridgeCarbonEmission = 0;

    // Constants for carbon emissions (in tons CO₂/year) per hour of usage for each appliance
    const acCarbonPerHour = 0.0005; // Example value for AC
    const fridgeCarbonPerHour = 0.0003; // Example value for fridge

    // AC Calculation
    if (document.getElementById("ac-checkbox").checked) {
        const acCount = parseInt(document.getElementById("ac-count").value) || 0;
        const acUsage = parseInt(document.getElementById("ac-usage").value) || 0;

        acCarbonEmission = acCount * acUsage * 365 * acCarbonPerHour;
    }

    // Fridge Calculation (assuming fridge runs 24 hours a day, no input needed for hours of use)
    if (document.getElementById("fridge-checkbox").checked) {
        fridgeCarbonEmission = 1 * 24 * 365 * fridgeCarbonPerHour;
    }

    // Update the UI for individual appliance emissions
    document.getElementById("ac-carbon-emission").textContent = acCarbonEmission.toFixed(2);
    document.getElementById("fridge-carbon-emission").textContent = fridgeCarbonEmission.toFixed(2);

    // Calculate and update total carbon emissions
    const totalCarbonEmission = acCarbonEmission + fridgeCarbonEmission;
    document.getElementById("total-carbon-emission").textContent = totalCarbonEmission.toFixed(2);
}

function toggleFrequency(frequencyId) {
    var frequencySection = document.getElementById(frequencyId);
    var checkbox = document.getElementById('telur');
    
    if (checkbox.checked) {
        frequencySection.style.display = 'flex';
        frequencySection.style.flexDirection = 'column';
    } else {
        frequencySection.style.display = 'none';
    }
}

function toggleFrequency(item) {
    const checkbox = document.getElementById(`checkbox-${item}`);
    const frequencyOptions = document.getElementById(`frequency-${item}`);
    
    if (checkbox.checked) {
        frequencyOptions.style.display = 'block';
    } else {
        frequencyOptions.style.display = 'none';
    }
}

let foodEmissions = 0;

function calculateEmissions() {
    let foodEmissions = 0;
    
    // Telur
    if (document.getElementById("egg-checkbox").checked) {
        const eggFrequency = document.querySelector('input[name="frequency-egg"]:checked');
        if (eggFrequency) {
            switch (eggFrequency.value) {
                case "1-3": foodEmissions += 0.05; break;
                case "4-5": foodEmissions += 0.1; break;
                case "every-day": foodEmissions += 0.2; break;
            }
        }
    }

    // Susu
    if (document.getElementById("milk-checkbox").checked) {
        const milkFrequency = document.querySelector('input[name="frequency-milk"]:checked');
        if (milkFrequency) {
            switch (milkFrequency.value) {
                case "1-3": foodEmissions += 0.04; break;
                case "4-5": foodEmissions += 0.08; break;
                case "every-day": foodEmissions += 0.15; break;
            }
        }
    }
    
    // Beras
    if (document.getElementById("rice-checkbox").checked) {
        const riceFrequency = document.querySelector('input[name="frequency-rice"]:checked');
        if (riceFrequency) {
            switch (riceFrequency.value) {
                case "1-3": foodEmissions += 0.06; break;
                case "4-5": foodEmissions += 0.12; break;
                case "every-day": foodEmissions += 0.18; break;
            }
        }
    }
    
    // Seafood
    if (document.getElementById("seafood-checkbox").checked) {
        const seafoodFrequency = document.querySelector('input[name="frequency-seafood"]:checked');
        if (seafoodFrequency) {
            switch (seafoodFrequency.value) {
                case "1-3": foodEmissions += 0.15; break;
                case "4-5": foodEmissions += 0.3; break;
                case "every-day": foodEmissions += 0.5; break;
            }
        }
    }
    
    // Unggas
    if (document.getElementById("poultry-checkbox").checked) {
        const poultryFrequency = document.querySelector('input[name="frequency-poultry"]:checked');
        if (poultryFrequency) {
            switch (poultryFrequency.value) {
                case "1-3": foodEmissions += 0.08; break;
                case "4-5": foodEmissions += 0.16; break;
                case "every-day": foodEmissions += 0.25; break;
            }
        }
    }
    
    // Domba
    if (document.getElementById("lamb-checkbox").checked) {
        const lambFrequency = document.querySelector('input[name="frequency-lamb"]:checked');
        if (lambFrequency) {
            switch (lambFrequency.value) {
                case "1-3": foodEmissions += 0.3; break;
                case "4-5": foodEmissions += 0.6; break;
                case "every-day": foodEmissions += 1; break;
            }
        }
    }
    
    // Sapi
    if (document.getElementById("beef-checkbox").checked) {
        const beefFrequency = document.querySelector('input[name="frequency-beef"]:checked');
        if (beefFrequency) {
            switch (beefFrequency.value) {
                case "1-3": foodEmissions += 0.4; break;
                case "4-5": foodEmissions += 0.8; break;
                case "every-day": foodEmissions += 1.3; break;
            }
        }
    }
    
    // Olahan Susu
    if (document.getElementById("dairy-products-checkbox").checked) {
        const dairyProductsFrequency = document.querySelector('input[name="frequency-dairy-products"]:checked');
        if (dairyProductsFrequency) {
            switch (dairyProductsFrequency.value) {
                case "1-3": foodEmissions += 0.06; break;
                case "4-5": foodEmissions += 0.12; break;
                case "every-day": foodEmissions += 0.2; break;
            }
        }
    }
    
    // Update tampilan total emisi makanan
    document.getElementById("food-emission-result").textContent = foodEmissions.toFixed(2);
}


// Fungsi untuk menampilkan atau menyembunyikan opsi frekuensi
function toggleFrequencyOptions(id) {
    const options = document.getElementById(id);
    options.style.display = options.style.display === 'none' ? 'block' : 'none';
}
