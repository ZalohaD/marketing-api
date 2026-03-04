<?php
$pageTitle  = 'Lead Statuses';
$activePage = 'statuses';
$pageScript = 'statuses.js';

$dateTo   = date('Y-m-d');
$dateFrom = date('Y-m-d', strtotime('-30 days'));

require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/components/layout_header.php';
?>

<div class="container-xl py-5">

  <div class="mb-4 fade-up fade-up-1">
    <p class="page-eyebrow">Analytics</p>
    <h1 class="h3 fw-bold mb-1">Lead Statuses</h1>
    <p class="text-secondary mb-0" style="font-size:.9rem">Filter by date range to see lead statuses from the CRM.</p>
  </div>

  <div class="card mb-4 fade-up fade-up-2">
    <div class="card-body p-4">
      <div class="row g-3 align-items-end">
        <div class="col-sm-4">
          <label class="form-label">From</label>
          <input type="date" id="dateFrom" class="form-control"
                 value="<?= $dateFrom ?>" max="<?= $dateTo ?>">
        </div>
        <div class="col-sm-4">
          <label class="form-label">To</label>
          <input type="date" id="dateTo" class="form-control"
                 value="<?= $dateTo ?>" max="<?= $dateTo ?>">
        </div>
        <div class="col-sm-4">
          <button class="btn btn-primary w-100" id="fetchBtn" onclick="loadStatuses(0)">
            <span class="spinner-border spinner-border-sm me-2 d-none" id="fetchSpinner"></span>
            Search
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="card fade-up fade-up-3">
    <div class="card-header d-flex justify-content-between align-items-center">
      <span class="fw-semibold">Results</span>
      <span class="text-secondary" style="font-size:.8rem" id="tableMeta"></span>
    </div>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead class="table-light">
          <tr>
            <th style="width:80px">ID</th>
            <th>Email</th>
            <th style="width:130px">Status</th>
            <th style="width:80px">FTD</th>
          </tr>
        </thead>
        <tbody id="tableBody">
          <tr>
            <td colspan="4" class="text-center text-secondary py-4">Loading...</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center"
         id="paginationRow" style="display:none">
      <span class="text-secondary" style="font-size:.8rem" id="pageInfo"></span>
      <div class="btn-group btn-group-sm">
        <button class="btn btn-outline-secondary" id="prevBtn" onclick="changePage(-1)">&larr; Prev</button>
        <button class="btn btn-outline-secondary" id="nextBtn" onclick="changePage(1)">Next &rarr;</button>
      </div>
    </div>
  </div>

</div>

<?php require_once __DIR__ . '/components/layout_footer.php'; ?>
