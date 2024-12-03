document.addEventListener('DOMContentLoaded', function () {
    // Handle form submission for creating contracts
const contractForm = document.getElementById('contract-form');
contractForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form submission for custom validation

        // Collect data from the form
        const caregiverEmail = document.getElementById('caregiver_email').value;
        const hourlyRate = parseInt(document.getElementById('hourly_rate').value);
        const totalHours = parseInt(document.getElementById('total_hours').value);

        // Fetch the current member's info (to check CareDollars and available hours)
        fetch('../backend/get_user_info.php', {
            method: 'GET',
        })
        .then(response => response.json())
        .then(userInfo => {
            const maxHours = userInfo.MaxAvailableHoursPerWeek;
            const careMoneyBalance = userInfo.CareMoneyBalance;

            // Check if caregiver has enough hours available
            if (totalHours > maxHours) {
                alert(`Caregiver doesn't have enough available hours per week. Maximum available: ${maxHours}`);
                return;
            }

            // Calculate the cost of the contract
            const contractCost = hourlyRate * totalHours;

            // Check if the member has enough CareDollars
            if (careMoneyBalance < contractCost) {
                alert(`You don't have enough CareDollars. Required: $${contractCost}, Available: $${careMoneyBalance}`);
                return;
            }

            // If both checks pass, proceed to submit the form
            contractForm.submit();
        })
        .catch(error => {
            console.error('Error fetching user info:', error);
            alert('Error fetching your details. Please try again later.');
        });
    });
});


function fetchContracts() {
    fetch('../backend/get_contracts.php', {
        method: 'GET',
    })
    .then(response => response.json())
    .then(contracts => {
        console.log(contracts); // Log the contracts to inspect them

        // Group contracts by their status
        const activeList = document.getElementById('active-list');
        const pendingList = document.getElementById('pending-list');
        const completedList = document.getElementById('completed-list');

        contracts.forEach(contract => {
            const startDate = new Date(contract.StartDate);
            const endDate = new Date(contract.EndDate);
            const currentDate = new Date();

            let status = '';
            if (startDate > currentDate) {
                status = 'Pending';
            } else if (endDate < currentDate) {
                status = 'Completed';
            } else {
                status = 'Active';
            }

            const contractItem = document.createElement('div');
            contractItem.classList.add('contract-item');
            contractItem.innerHTML = `
                <h4>${contract.CaregiverName} - ${contract.ParentName}</h4>
                <p>Start Date: ${contract.StartDate}</p>
                <p>End Date: ${contract.EndDate}</p>
                <p>Total Hours: ${contract.TotalHours}</p>
                <p>Cost: $${contract.Cost}</p>
                <p>Status: ${status}</p>
                ${status === 'Completed' ? `<button onclick="addReview(${contract.ContractID}, ${contract.MemberID}, ${contract.CaregiverID})">Create Review</button>` : ''}
            `;

            // Categorize the contract based on its status
            switch (status) {
                case 'Active':
                    activeList.appendChild(contractItem);
                    break;
                case 'Pending':
                    pendingList.appendChild(contractItem);
                    break;
                case 'Completed':
                    completedList.appendChild(contractItem);
                    break;
            }
        });
    })
    .catch(error => console.error('Error fetching contracts:', error));
}

function addReview(contractID, memberID, caregiverID) {
    const rating = prompt('Please enter a rating (1-5):');
    const comment = prompt('Please enter a comment:');

    if (rating && comment) {
        fetch('../backend/submit_review.php', {
            method: 'POST',
            body: JSON.stringify({ contractID, memberID, caregiverID, rating, comment }),
            headers: { 'Content-Type': 'application/json' },
        })
        .then(response => response.text())  // Changed to text() to log raw response
        .then(data => {
            console.log(data);  // Log raw response to inspect the issue
            try {
                const jsonData = JSON.parse(data);  // Try parsing as JSON
                alert('Review added!');
                fetchContracts(); // Refresh contracts
            } catch (error) {
                console.error('Error parsing JSON:', error);
                alert('Error adding review: ' + data); // Display raw error message
            }
        })
        .catch(error => alert('Error adding review: ' + error));
    }
}

function toggleCreateForm() {
    const form = document.getElementById('create-contract-form');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

fetchContracts();