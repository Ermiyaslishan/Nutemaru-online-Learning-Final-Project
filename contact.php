<div class="container">
  <div class="row">
    <div class="col-md-6">
      <img src="images\Capture.PNG" alt="Contact Us Image" style="margin-left: 60px;">
    </div>
    <div class="col-md-5 ">
      <h2 class="text-center mb-4" id="contact">Contact Us</h2>
      <form action="https://formsubmit.co/34118174288df2e596231296c25ecdd2" method="POST" onsubmit="return validateForm()">
        <div class="mb-3">
          <input type="text" class="form-control" name="name" placeholder="Name" id="name">
          <span class="error" id="nameError"></span>
        </div>
        <div class="mb-3">
          <input type="text" class="form-control" name="subject" placeholder="Subject" id="subject">
          <span class="error" id="subjectError"></span>
        </div>
        <div class="mb-3">
          <input type="email" class="form-control" name="email" placeholder="E-mail" id="email">
          <span class="error" id="emailError"></span>
        </div>
        <div class="mb-3">
          <textarea class="form-control" name="message" placeholder="How can we help you?" style="height:150px;" id="message"></textarea>
          <span class="error" id="messageError"></span>
        </div>
        <input type="hidden" name="_next" value="http://localhost/nutemaru/index.php">
        <div class="d-grid">
          <input class="banner-btn" style="width:40%" type="submit" value="Send" name="submit">
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  .error-input {
    border: 1px solid red;
  }
</style>

<script>
  function validateForm() {
    let name = document.getElementById("name").value;
    let subject = document.getElementById("subject").value;
    let email = document.getElementById("email").value;
    let message = document.getElementById("message").value;
    let nameInput = document.getElementById("name");
    let subjectInput = document.getElementById("subject");
    let emailInput = document.getElementById("email");
    let messageInput = document.getElementById("message");
    let nameError = document.getElementById("nameError");
    let subjectError = document.getElementById("subjectError");
    let emailError = document.getElementById("emailError");
    let messageError = document.getElementById("messageError");
    let isValid = true;

    nameError.innerHTML = "";
    subjectError.innerHTML = "";
    emailError.innerHTML = "";
    messageError.innerHTML = "";

    if (name === "") {
      nameError.innerHTML = "Please enter your name";
      nameInput.classList.add("error-input");
      isValid = false;
    } else {
      nameInput.classList.remove("error-input");
    }

    if (subject === "") {
      subjectError.innerHTML = "Please enter a subject";
      subjectInput.classList.add("error-input");
      isValid = false;
    } else {
      subjectInput.classList.remove("error-input");
    }

    if (email === "") {
      emailError.innerHTML = "Please enter your email";
      emailInput.classList.add("error-input");
      isValid = false;
    } else if (!/\S+@\S+\.\S+/.test(email)) {
      emailError.innerHTML = "Please enter a valid email address";
      emailInput.classList.add("error-input");
      isValid = false;
    } else {
      emailInput.classList.remove("error-input");
    }

    if (message === "") {
      messageError.innerHTML = "Please enter a message";
      messageInput.classList.add("error-input");
      isValid = false;
    } else {
      messageInput.classList.remove("error-input");
    }

    return isValid;
  }
</script>
