$(document).ready(function() {
  // Show sign-up form
  $('#signup-toggle').click(function() {
      $('.login-wrapper').fadeOut(300, function() {
          $('.sign-up-form').fadeIn(300);
      });
  });

  // Show sign-in form
  $('#signin-toggle').click(function() {
      $('.sign-up-form').fadeOut(300, function() {
          $('.login-wrapper').fadeIn(300);
          $('#error-message').hide(); // Hide error message when switching back
      });
  });

  // Hide empty field error message on input
  $('input').on('input', function() {
      $(this).next('.text-danger').hide(); // Hide error message for the current field
  });

  // Sign Up button click event
  $('#signup-btn').click(function() {
      // Clear previous error messages
      $('.text-danger').hide();

      // Validation flags
      let isValid = true;

      // Check for empty fields
      if ($('#signup-email').val().trim() === '') {
          $('#email-error').text('This field can\'t be empty').show();
          isValid = false;
      } else {
          // Validate email format
          if (!$('#signup-email').val().includes('@')) {
              $('#email-error').text('Invalid email format').show();
              isValid = false;
          }
      }

      if ($('#signup-password').val().trim() === '') {
          $('#password-error').text('This field can\'t be empty').show();
          isValid = false;
      } else if ($('#signup-password').val().length < 8) {
          $('#password-error').text('Password too short, must be at least 8 characters').show();
          isValid = false;
      }

      if ($('#confirm-password').val().trim() === '') {
          $('#confirm-password-error').text('This field can\'t be empty').show();
          isValid = false;
      } else if ($('#confirm-password').val() !== $('#signup-password').val()) {
          $('#confirm-password-error').text('Passwords do not match').show();
          isValid = false;
      }

      // Check if terms checkbox is checked
      if (!$('#terms-checkbox').is(':checked')) {
          $('#error-message').text('You must agree to the terms and conditions.').show();
          isValid = false;
      }

      // If all validations pass, proceed with the sign-up process
      if (isValid) {
          alert('Sign Up form submitted.'); // Placeholder for actual submission logic
          // You can use AJAX or form submission here
      }
  });

  // Live validation for password match and length
  $('#signup-password, #confirm-password').on('input', function() {
      // Check password length
      if ($('#signup-password').val().length < 8) {
          $('#password-error').text('Password too short, must be at least 8 characters').show();
      } else {
          $('#password-error').hide(); // Hide error if length is valid
      }

      // Check if confirm password matches
      if ($('#confirm-password').val().trim() !== '') {
          if ($('#confirm-password').val() !== $('#signup-password').val()) {
              $('#confirm-password-error').text('Passwords do not match').show();
          } else {
              $('#confirm-password-error').hide(); // Hide error if they match
          }
      }
  });
});
