function validate() {
  const emailInput = document.getElementById("input_email");
  const passInput = document.getElementById("input_pass");
  const emailError = document.getElementById("desc_email");
  const passError = document.getElementById("desc_pass");
  const loginButton = document.getElementById("button_login");
  const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (emailInput.value === "") {
    emailError.textContent = "И-мэйл хаяг оруулна уу! Client";
    return false;
  }
  if (passInput.value === "") {
    passError.textContent = "Нууц үг оруулна уу! Client";
    return false;
  }
  if (!emailPattern.test(emailInput.value)) {
    emailError.textContent = "И-мэйл хаяг буруу байна! Client";
    return false;
  }
  return true;
}
