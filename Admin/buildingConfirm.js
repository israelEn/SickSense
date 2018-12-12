var invalidMessages;
window.onsubmit = validateForm;

function validateForm() {
  invalidMessages = "";
  validateCode();
  validateAbbreviation();

  if (invalidMessages !== "") {
    alert(invalidMessages);
    return false;
  } else {
    if (window.confirm("Are you sure you want to submit?")) {
      return true;
    } else {
      return false;
    }
  }
}

function validateCode() {
  var code = document.getElementById("buildingCode").value;

  if ((code + "").length != 3 || isNaN(code)) {
    invalidMessages += "Invalid building code: Please enter a valid 3-digit numeric code.\n";
    return false;
  }
  return true;
}

function validateAbbreviation() {
  var initials = document.getElementById("initials").value;

  if ((initials + "").length != 3) {
    invalidMessages += "Invalid intials: Please enter a valid 3 character initials.\n";
    return false;
  }
  return true;
}
