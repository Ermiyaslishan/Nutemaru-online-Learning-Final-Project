<footer class="text-center text-lg-start bg-dark text-white" style="text-decoration: none; background-color: #00c16e;">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Get connected with us on social networks:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>NuTemaru 
          </h6>
          <p>
          ትምህርትን በማንኛውም ሰአት እና በማንኛውም ቦታ!!! 
          
          </p>
        </div>

        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> Addis Ababa, Ethiopia</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            Nutemaru@example.com
          </p>
          <p><i class="fas fa-phone me-3"></i> +  251 699 35 92</p>
          <p><i class="fas fa-print me-3"></i> +  251 679 54 25</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(255, 255, 255, 0.05);">
    © 2015 Copyright:
    <a class="text-reset fw-bold" href="#" data-bs-toggle="modal" data-bs-target="#adminLoginModalCenter" >R</a>
  </div>
  <!-- Copyright -->
</footer>


<!-- Admin Login -->
<!-- Modal -->
<div class="modal fade" id="adminLoginModalCenter" tabindex="-1" aria-labelledby="adminLoginModalCenterLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="adminLoginModalCenterLabel">Admin Login</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Admin Login start -->
        <form id="adminLoginForm">

          <div class="mb-3">
            <label for="adminLogemail" class="form-label"><i class="fas fa-envelope me-2"></i>Email</label>
            <input type="email" class="form-control" id="adminLogemail" name="adminLogemail" placeholder="Enter email" required>
          </div>

          <div class="mb-3">
          <label for="adminLogpass" class="form-label"><i class="fas fa-key me-2"></i>Password</label>
          <div class="input-group">
            <input type="password" class="form-control" id="adminLogpass" name="adminLogpass" placeholder="Enter password" required>
            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
              <i class="fa fa-eye-slash"></i>
            </button>
          </div>
        </div>


        </form>
        <!-- End login of Admin -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="adminLoginBtn" onclick="checkAdminLogin()">Login</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- Pass word  -->
<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#adminLogpass');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.querySelector('i').classList.toggle('fa-eye-slash');
    this.querySelector('i').classList.toggle('fa-eye');
  });
</script>





<!-- modal end -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
<!-- font awesome -->
    <script src="js/all.min.js"></script>
<!-- Student Ajax Call -->
<script type="text/javascript" src="js/ajaxrequest.js"></script>
<!-- Admin Ajax Call -->
<script type="text/javascript" src="js/adminajaxrequest.js"></script>
    <!-- js bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

