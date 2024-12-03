<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contracts - Caregiver Website</title>
    <style>
        .contract-section {
            margin-bottom: 20px;
        }

        .dropdown {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            text-align: left;
        }

        .contract-list {
            display: none;
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

        .active .contract-list {
            display: block;
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
        <!-- Active Contracts Section -->
        <div class="contract-section">
            <div class="dropdown" onclick="toggleList('active-list')">
                <h3>Active Contracts</h3>
            </div>
            <div id="active-list" class="contract-list"></div>
        </div>

        <!-- Pending Contracts Section -->
        <div class="contract-section">
            <div class="dropdown" onclick="toggleList('pending-list')">
                <h3>Pending Contracts</h3>
            </div>
            <div id="pending-list" class="contract-list"></div>
        </div>

        <!-- Inactive Contracts Section -->
        <div class="contract-section">
            <div class="dropdown" onclick="toggleList('inactive-list')">
                <h3>Inactive Contracts</h3>
            </div>
            <div id="inactive-list" class="contract-list"></div>
        </div>
    </div>
    <script src="handleContracts.js"></script>
</body>
</html>
