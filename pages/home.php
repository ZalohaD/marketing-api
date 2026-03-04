<?php
$pageTitle  = 'Submit Lead';
$activePage = 'home';
$pageScript = 'lead-form.js';


require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/components/layout_header.php';
?>

<div class="page-centered">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">

      <div class="mb-4 fade-up fade-up-1">
        <p class="page-eyebrow">Acquisition</p>
        <h1 class="h3 fw-bold mb-1">Submit a New Lead</h1>
        <p class="text-secondary mb-0" style="font-size:.9rem">All fields are required.</p>
      </div>

      <div class="card fade-up fade-up-2">
        <div class="card-body p-4">
          <form id="leadForm" novalidate>

            <div class="row g-3 mb-3">
              <div class="col-sm-6">
                <label class="form-label">First Name <span class="text-danger">*</span></label>
                <input type="text" name="firstName" class="form-control"
                       placeholder="John" required autocomplete="given-name">
                <div class="invalid-feedback">Required.</div>
              </div>
              <div class="col-sm-6">
                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                <input type="text" name="lastName" class="form-control"
                       placeholder="Smith" required autocomplete="family-name">
                <div class="invalid-feedback">Required.</div>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Phone <span class="text-danger">*</span></label>
              <input type="tel" name="phone" class="form-control"
                     placeholder="+44 7700 900000" required autocomplete="tel">
              <div class="invalid-feedback">Required.</div>
            </div>

            <div class="mb-4">
              <label class="form-label">Email <span class="text-danger">*</span></label>
              <input type="email" name="email" class="form-control"
                     placeholder="john@example.com" required autocomplete="email">
              <div class="invalid-feedback">Enter a valid email.</div>
            </div>

            <button type="submit" class="btn btn-primary w-100" id="submitBtn">
              <span class="spinner-border spinner-border-sm me-2 d-none" id="submitSpinner"></span>
              <span id="submitLabel">Submit Lead</span>
            </button>

          </form>
        </div>
      </div>

      <div class="alert alert-success mt-4 d-none fade-up" id="resultCard">
        <h6 class="fw-semibold mb-3">&#10003; Lead Registered</h6>
        <dl class="row mb-0" style="font-size:.615rem">
          <dt class="col-4">ID</dt>
          <dd class="col-8" id="res-id">—</dd>
          <dt class="col-4">Email</dt>
          <dd class="col-8" id="res-email">—</dd>
          <dt class="col-4 mb-0">Autologin</dt>
          <dd class="col-8 mb-0" id="res-autologin">—</dd>
        </dl>
      </div>

      <div class="alert alert-danger mt-4 d-none" id="errorCard">
        <strong>Error:</strong> <span id="errorMsg"></span>
      </div>

    </div>
  </div>
</div>

</div>
<?php require_once __DIR__ . '/components/layout_footer.php'; ?>
