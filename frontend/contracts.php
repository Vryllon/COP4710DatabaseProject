<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contracts - Caregiver Website</title>
    <style>
        .contract-section {
            margin-bottom: 20px;
        }

        .contract-list {
            max-height: 200px;
            overflow-y: auto;
            background-color: #fafafa;
            border: 1px solid #ccc;
            margin-top: 10px;
            padding: 10px;
        }

        .contract-item {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        #create-contract-form {
            margin-top: 20px;
            display: none;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        #create-contract-form input,
        #create-contract-form button {
            margin: 10px 0;
            padding: 8px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div>
        <h1>Contracts</h1>
    </div>

    <div>
        <a href="contracts.php">Contracts</a>
        <a href="search.php">Search</a>
        <a href="profile.php">My Profile</a>
    </div>

    <div id="contracts-container">

        <!-- Pending Contracts Section -->
        <div class="contract-section">
            <h3>Pending Contracts</h3>
            <div id="pending-list" class="contract-list"></div>
        </div>
        
        <!-- Active Contracts Section -->
        <div class="contract-section">
            <h3>Active Contracts</h3>
            <div id="active-list" class="contract-list"></div>
        </div>

        <!-- Completed Contracts Section -->
        <div class="contract-section">
            <h3>Completed Contracts</h3>
            <div id="completed-list" class="contract-list"></div>
        </div>

        <!-- Button to toggle contract creation form -->
        <button onclick="toggleCreateForm()">Create New Contract</button>

        <!-- Contract Creation Form -->
        <div id="create-contract-form">
            <h2>Create New Contract</h2>
            <form id="contract-form" action="../backend/create_contract.php" method="POST">
                <label for="caregiver_email">Member Email:</label>
                <input type="text" id="caregiver_email" name="caregiver_email" required><br>

                <label for="parent_name">Parent Name:</label>
                <input type="text" id="parent_name" name="parent_name" required><br>

                <label for="hourly_rate">Hourly Rate:</label>
                <input type="number" id="hourly_rate" name="hourly_rate" required><br>

                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required><br>

                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required><br>

                <label for="total_hours">Total Hours:</label>
                <input type="number" id="total_hours" name="total_hours" required><br>

                <button type="submit">Create Contract</button>
                <button type="button" onclick="toggleCreateForm()">Cancel</button>
            </form>
        </div>
    </div>

    <script src="handleContracts.js"></script>
</body>
</html>
