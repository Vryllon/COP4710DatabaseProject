<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search - Caregiver Website</title>
    <style>
        /* Basic styling for the container */
        .search-container {
            margin: 20px;
        }

        /* Input field for search */
        .search-input {
            padding: 10px;
            width: 100%;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        /* Scrollable list styling */
        .user-list {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fafafa;
        }

        .user-item {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .user-item:last-child {
            border-bottom: none;
        }
    </style>
</head>

<body>
    <div>
        <h1>Search</h1>
    </div>    

    <div>
        <a href="contracts.php">Contracts</a>
        <a href="search.php">Search</a>
        <a href="profile.php">My Profile</a>
    </div>

    <div class="search-container">
        <!-- Search input field -->
        <input type="text" id="addressSearch" class="search-input" placeholder="Search by address" oninput="searchUsers()">
        
        <!-- Scrollable list to show users -->
        <div id="userList" class="user-list"></div>
    </div>

    <script src="handleSearch.js"></script>
</body>
</html>
