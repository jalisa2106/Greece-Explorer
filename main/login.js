function toggleVisibility(fieldId, element) {
  const input = document.getElementById(fieldId);
  if (input.type === "password") {
    input.type = "text";
    element.textContent = "🙈";
  } else {
    input.type = "password";
    element.textContent = "👁️";
  }
}

function validateSignUp() {
  const pwd = document.getElementById("password_signup").value;
  if(pwd.length < 6){
    alert("Password must be at least 6 characters.");
    return false;
  }
  return true;
}

function validateLogin() {
  const pwd = document.getElementById("password_login").value;
  if(pwd.length < 1){
    alert("Password cannot be empty.");
    return false;
  }
  return true;
}