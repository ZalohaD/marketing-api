<?php
if (!isset($pageTitle))  $pageTitle  = 'Space-Marketing';
if (!isset($activePage)) $activePage = '';
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?> — Space-Marketing</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="/">
      <span class="dot"></span>Space-Marketing
    </a>
    <button class="navbar-toggler border-0" type="button"
            data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto gap-1">
        <li class="nav-item">
          <a class="nav-link <?= $activePage === 'home'     ? 'active' : '' ?>" href="/">Submit Lead</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $activePage === 'statuses' ? 'active' : '' ?>" href="/statuses">Lead Statuses</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

