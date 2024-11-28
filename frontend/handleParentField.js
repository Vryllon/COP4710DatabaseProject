let parentCount = 1; // To track the number of parent fields added

// Function to dynamically add more parent input fields
function addParentField() {
    parentCount++;

    // Create a new parent field container
    const parentDiv = document.createElement('div');
    parentDiv.id = `parent${parentCount}`; // Unique id for this parent

    // Create the new parent fields (name, age, health, address)
    parentDiv.innerHTML = `
        <p>Parent ${parentCount}:</p>
        <div>
            <label for="parent${parentCount}name">Name:</label>
            <input type="text" id="parent${parentCount}name" name="parent${parentCount}name" required>
        </div>
        <div>
            <label for="parent${parentCount}age">Age:</label>
            <input type="text" id="parent${parentCount}age" name="parent${parentCount}age" required>
        </div>
        <div>
            <label for="parent${parentCount}health">Health:</label>
            <input type="text" id="parent${parentCount}health" name="parent${parentCount}health" required>
        </div>
        <div>
            <label for="parent${parentCount}address">Address:</label>
            <input type="text" id="parent${parentCount}address" name="parent${parentCount}address" required>
        </div>
    `;

    // Append the new parent set to the parents container
    document.getElementById('parentsContainer').appendChild(parentDiv);
}

// Function to remove the last parent input field set
function removeLastParentField() {
    if (parentCount > 1) { // Ensure there's at least one parent field
        const parentDiv = document.getElementById(`parent${parentCount}`);
        parentDiv.remove(); // Remove the last parent div
        parentCount--; // Decrease the parent count
    }
}