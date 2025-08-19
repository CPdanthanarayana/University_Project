<!DOCTYPE html>
<html lang="en">
<head>
    @include('userview.css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <style>
        .form-container {
            background: #f8f9fa;
            max-width: 800px;
            margin: 50px auto;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
            padding: 32px 40px;
            border: 1px solid #dee2e6;
        }

        h2 {
            text-align: left;
            margin-bottom: 24px;
            font-size: 1.6em;
            font-weight: 600;
            letter-spacing: 1px;
            color: #212529;
        }

        .section-title {
            font-weight: 600;
            margin-top: 28px;
            margin-bottom: 12px;
            color: #495057;
            font-size: 1.15em;
            border-bottom: 1px solid #ced4da;
            padding-bottom: 6px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #495057;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 14px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 1em;
            background: #fff;
            color: #212529;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        textarea:focus {
            outline: none;
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        textarea {
            min-height: 60px;
            resize: vertical;
        }

        select {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 14px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 1em;
            background-color: #fff;
            appearance: none;
            background-image: linear-gradient(45deg, transparent 50%, #495057 50%),
                            linear-gradient(135deg, #495057 50%, transparent 50%);
            background-position: calc(100% - 20px) 50%, calc(100% - 15px) 50%;
            background-size: 6px 6px;
            background-repeat: no-repeat;
            cursor: pointer;
            color: #212529;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        select:focus {
            outline: none;
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .row {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .col {
            flex: 1;
            min-width: 200px;
        }

        .submit-button {
            background-color: #0d6efd;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.2s, transform 0.2s;
        }

        .submit-button:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
        }

        #message-container {
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            display: none;
            font-weight: 500;
        }

        #message-container.error {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        #message-container.success {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        @media (max-width: 700px) {
            .row {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="form-container">
            <h2>VEHICLE REGISTRATION & DETAILS FORM</h2>

            <div id="message-container"></div>

            <form id="addVehicleForm" enctype="multipart/form-data">

                <!-- Basic Details -->
                <div class="section-title">Basic Details</div>
                <div class="row">
                    <div class="col">
                        <label>1. Vehicle No:</label>
                        <input type="text" name="vehicle_no" placeholder="Ex: ABC-1234" required>
                    </div>
                    <div class="col">
                        <label>2. Vehicle Type:</label>
                        <select name="vehicle_type" required>
                            <option value="">-- Select vehicle type --</option>
                            <option value="car">Car</option>
                            <option value="van">Van</option>
                            <option value="bus">Bus</option>
                            <option value="utility vehicle">Utility vehicle</option>
                        </select>
                    </div>
                    <div class="col">
                        <label>3. Capacity:</label>
                        <input type="number" name="capacity" placeholder="Number of passengers" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>4. Driver's Name:</label>
                        <input type="text" name="driver_name" required>
                    </div>
                </div>

                <!-- Operational & Maintenance Details -->
                <div class="section-title">Operational & Maintenance Details</div>
                <div class="row">
                    <div class="col">
                        <label>5. Fuel Type:</label>
                        <select name="fuel_type" required>
                            <option value="">-- Select type --</option>
                            <option value="petrol">Petrol</option>
                            <option value="diesel">Diesel</option>
                            <option value="electric">Electric</option>
                            <option value="hybrid">Hybrid</option>
                        </select>
                    </div>
                    <div class="col">
                        <label>6. Insurance Expiry Date:</label>
                        <input type="date" name="insurance_expiry">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>7. Additional Notes:</label>
                        <textarea name="notes" placeholder="Any additional information about the vehicle..."></textarea>
                    </div>
                </div>

                <!-- Submit -->
                <button class="submit-button" type="submit">Submit</button>

            </form>
        </div>
    </div>

    <script>
        document.getElementById('addVehicleForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let errors = [];

        // Get form values
        const vehicleNo = this.vehicle_no.value.trim();
        const vehicleType = this.vehicle_type.value;
        const capacity = this.capacity.value.trim();
        const driverName = this.driver_name.value.trim();
        const fuelType = this.fuel_type.value;

        // Vehicle No validation
        if(vehicleNo.length < 5){
            errors.push("Vehicle number must be at least 5 characters.");
        }

        // Vehicle Type
        if(!vehicleType){
            errors.push("Please select a vehicle type.");
        }

        // Capacity validation (must be a number > 0)
        if(!capacity || isNaN(capacity) || Number(capacity) <= 0){
            errors.push("Capacity must be a positive number.");
        }

        // Driver's Name
        if(driverName.length < 3){
            errors.push("Driver's name must be at least 3 characters.");
        }

        // Fuel Type
        if(!fuelType){
            errors.push("Please select a fuel type.");
        }

        // Show errors or submit
        const messageContainer = document.getElementById('message-container');
        if(errors.length > 0){
            messageContainer.style.display = 'block';
            messageContainer.style.backgroundColor = '#f8d7da';
            messageContainer.style.color = '#721c24';
            messageContainer.style.border = '1px solid #f5c6cb';
            messageContainer.innerHTML = errors.join('<br>');
            window.scrollTo(0,0);
        } else {
            messageContainer.style.display = 'none';
            this.submit();
        }
    });
    </script>

</body>
</html>
