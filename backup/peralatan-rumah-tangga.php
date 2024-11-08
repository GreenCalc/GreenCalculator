<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Emisi Peralatan Rumah Tangga</title>
    <style>
        /* General styling */
        .input-section {
            margin: 10px 0;
        }
        .hidden {
            display: none;
        }
        .visible {
            display: block;
        }
        .options {
            display: flex;
            gap: 10px;
        }
        .option {
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }
        .option img {
            width: 50px;
            height: auto;
        }
        .option p {
            margin-top: 10px;
        }
        .active {
            border-color: green;
        }
    </style>
    <script>
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
    </script>
</head>
<body>
    <h1>Peralatan Rumah Tangga</h1>

    <div class="input-section">
        <label>
            <input type="checkbox" id="lighting-checkbox" onclick="toggleLightingOptions()">
            Penerangan
        </label>
    </div>

    <!-- Lighting options will be toggled when checkbox is clicked -->
    <div id="lighting-options" class="hidden">
        <h3>Jenis lampu apa yang Kamu gunakan?</h3>
        <div class="options">
            <div id="lampu-pijar" class="option" onclick="selectOption('lampu-pijar')">
                <img src="img/pijar.png" alt="Pijar">
                <p>Pijar</p>
            </div>
            <div id="lampu-neon" class="option" onclick="selectOption('lampu-neon')">
                <img src="img/neon.png" alt="Neon">
                <p>Neon</p>
            </div>
            <div id="lampu-led" class="option" onclick="selectOption('lampu-led')">
                <img src="img/led.png" alt="LED">
                <p>LED</p>
            </div>
        </div>

        <!-- Additional input for number of lamps and hours per day -->
        <div class="input-section">
            <label for="jumlah-lampu">Berapa jumlah lampu yang Kamu gunakan?</label>
            <input type="number" id="jumlah-lampu" name="jumlah-lampu" min="0">
        </div>

        <div class="input-section">
            <label for="waktu-lampu">Berapa lama penggunaan rata-rata dalam sehari? (jam/hari)</label>
            <input type="number" id="waktu-lampu" name="waktu-lampu" min="0">
        </div>
    </div>
    
    <script>
        // Optional: You can add more logic here if needed
    </script>
</body>
</html>
