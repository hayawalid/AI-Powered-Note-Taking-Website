document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector(".sign-up-form form");
    const username = document.querySelector("input[name='username']");
    const password = document.querySelector("input[name='signup-password']");
    const confirmPassword = document.querySelector("input[name='confirm-password']");
    const firstname = document.querySelector("input[name='first_name']");
    const lastname = document.querySelector("input[name='last_name']");
    const email = document.querySelector("input[name='signup_email']");
    const country = document.querySelector("select[name='country']");
    const termsCheckbox = document.getElementById("terms-checkbox");
    const signupBtn = document.getElementById("signup-btn");

    let originalUsername = '';
    let originalEmail = '';

    const showError = (input, message) => {
        input.style.borderColor = "red";
        const errorElement = document.getElementById(`${input.name}-error`);
        if (errorElement) {
            errorElement.textContent = message;
        } else {
            const newErrorElement = document.createElement("p");
            newErrorElement.id = `${input.name}-error`;
            newErrorElement.className = "error-message";
            newErrorElement.style.color = "red";
            newErrorElement.textContent = message;
            input.parentNode.appendChild(newErrorElement);
        }
    };

    const clearError = (input) => {
        input.style.borderColor = "";
        const errorElement = document.getElementById(`${input.name}-error`);
        if (errorElement) {
            errorElement.textContent = "";
        }
    };

    const checkUsernameEmailExists = (input) => {
        return new Promise((resolve) => {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../pages/check_user_email.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        if (xhr.responseText === "exists") {
                            showError(input, `${input.name.charAt(0).toUpperCase() + input.name.slice(1)} already exists.`);
                            resolve(false);
                        } else {
                            clearError(input);
                            resolve(true);
                        }
                    } else {
                        console.error("Error: " + xhr.status);
                        resolve(false);
                    }
                }
            };
            xhr.send(`${input.name}=${input.value}`);
        });
    };

    const validateForm = async () => {
        let isValid = true;

        // Validate username
        if (username.value.trim() === "") {
            showError(username, "This field cannot be empty.");
            isValid = false;
        } else if (username.value !== originalUsername) {
            const usernameValid = await checkUsernameEmailExists(username);
            if (!usernameValid) isValid = false;
        }

        // Validate password
        const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        if (password.value.trim() === "") {
            showError(password, "This field cannot be empty.");
            isValid = false;
        } else if (!passwordPattern.test(password.value)) {
            showError(password, "Password must be at least 8 characters long and contain both letters and numbers.");
            isValid = false;
        } else {
            clearError(password);
        }

        // Confirm password
        if (confirmPassword.value !== password.value) {
            showError(confirmPassword, "Passwords do not match.");
            isValid = false;
        } else {
            clearError(confirmPassword);
        }

        // Validate first name
        if (firstname.value.trim() === "") {
            showError(firstname, "This field cannot be empty.");
            isValid = false;
        } else if (/\d/.test(firstname.value)) {
            showError(firstname, "First name cannot contain numbers.");
            isValid = false;
        } else {
            clearError(firstname);
        }

        // Validate last name
        if (lastname.value.trim() === "") {
            showError(lastname, "This field cannot be empty.");
            isValid = false;
        } else if (/\d/.test(lastname.value)) {
            showError(lastname, "Last name cannot contain numbers.");
            isValid = false;
        } else {
            clearError(lastname);
        }

        // Validate email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.value.trim() === "") {
            showError(email, "This field cannot be empty.");
            isValid = false;
        } else if (!emailPattern.test(email.value)) {
            showError(email, "Invalid email format.");
            isValid = false;
        } else if (email.value !== originalEmail) {
            const emailValid = await checkUsernameEmailExists(email);
            if (!emailValid) isValid = false;
        }

        // Validate country
        if (country.value === "") {
            showError(country, "This field cannot be empty.");
            isValid = false;
        } else {
            clearError(country);
        }

        // Validate terms checkbox
        if (!termsCheckbox.checked) {
            showError(termsCheckbox, "You must agree to the terms and conditions.");
            isValid = false;
        } else {
            clearError(termsCheckbox);
        }

        return isValid;
    };

    signupBtn.addEventListener("click", async function(event) {
        event.preventDefault(); // Prevent form submission
        const isValid = await validateForm();
        if (isValid) {
            form.submit(); // Submit the form if valid
        }
    });

    // Real-time validation for username and email
    [username, email].forEach(input => {
        input.addEventListener("input", function() {
            if (input.value.trim() !== "") {
                checkUsernameEmailExists(input).then(() => {});
            } else {
                showError(input, "This field cannot be empty.");
            }
        });
    });

    // Remove validation styles on input
    const inputs = [username, password, confirmPassword, firstname, lastname, email, country, termsCheckbox];
    inputs.forEach(input => {
        input.addEventListener("input", function() {
            if (input.type !== "checkbox" && input.value.trim() !== "") {
                clearError(input);
            }
        });
    });
});
