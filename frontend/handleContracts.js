// Function to toggle the visibility of the contract lists
function toggleList(listId) {
    const list = document.getElementById(listId);
    const isActive = list.style.display === "block";
    const lists = document.querySelectorAll('.contract-list');
    lists.forEach(l => l.style.display = "none");
    if (!isActive) {
        list.style.display = "block";
    }
}

// Fetch contract data from the API and populate the lists
async function fetchContracts() {
    try {
        const response = await fetch(API_URL + '/contracts');
        const data = await response.json();
        
        // Separate contracts by status
        const activeContracts = data.filter(contract => contract.status === 'active');
        const pendingContracts = data.filter(contract => contract.status === 'pending');
        const inactiveContracts = data.filter(contract => contract.status === 'inactive');
        
        // Function to generate the contract items
        function generateContractItems(contracts) {
            return contracts.map(contract => `
                <div class="contract-item">
                    <strong>${contract.name}</strong><br>
                    Start Date: ${contract.start_date}<br>
                    End Date: ${contract.end_date}<br>
                    Hours per week: ${contract.hours_per_week}<br>
                    Client: ${contract.client}<br>
                    Parent: ${contract.parent}
                </div>
            `).join('');
        }

        // Populate the sections with contract data
        document.getElementById('active-list').innerHTML = generateContractItems(activeContracts);
        document.getElementById('pending-list').innerHTML = generateContractItems(pendingContracts);
        document.getElementById('inactive-list').innerHTML = generateContractItems(inactiveContracts);

    } catch (error) {
        console.error('Error fetching contract data:', error);
    }
}

// Call the function to fetch contracts when the page loads
window.onload = fetchContracts;