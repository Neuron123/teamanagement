function toggleGrowerField() {
  var growernoChoice = document.getElementById("choicesid");
  var growerField = document.getElementById("growerid");

  // Get the selected option value
  var selected = growernoChoice.value;

  // Check the selected option and toggle visibility of the grower field accordingly
  if (selected === "yes") {
    growerField.style.display = "block"; // Show the grower field
    growerField.setAttribute("required", "required");
  } else {
    growerField.style.display = "none"; // Hide the grower field
    growerField.removeAttribute("required");
  }
}

// Add event listener to the choicesid select field
var growerSelect = document.getElementById("choicesid");
growerSelect.addEventListener("change", toggleGrowerField);

// Call the toggle function initially to set the initial visibility based on the selected option
toggleGrowerField();


function validatePasswords(event) {
  var password1 = document.getElementById("password1");
  var password2 = document.getElementById("password2");
  var msgPwd = document.getElementById("msgpwd");

  // Check if the passwords match
  if (password1.value !== password2.value) {
    msgPwd.textContent = "Passwords do not match"; // Display error message
    password1.classList.add("error"); // Add a CSS class for styling
    password2.classList.add("error"); // Add a CSS class for styling
    event.preventDefault(); // Prevent form submission
  } else {
    msgPwd.textContent = ""; // Clear error message
    password1.classList.remove("error"); // Remove the CSS class
    password2.classList.remove("error"); // Remove the CSS class
  }
}

// Add event listener to validate passwords when the form is submitted
var form = document.getElementById("regformid"); // Replace "regformid" with the actual form ID
form.addEventListener("submit", validatePasswords);
