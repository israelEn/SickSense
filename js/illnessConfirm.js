var invalidMessages;
window.onsubmit = validateForm;

function validateForm() {
  invalidMessages = "";

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
