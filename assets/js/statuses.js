
var LIMIT       = 100;
var currentPage = 0;

document.addEventListener('DOMContentLoaded', function () {
    loadStatuses(0);
});

async function loadStatuses(page) {
    currentPage = page;

    var btn     = document.getElementById('fetchBtn');
    var spinner = document.getElementById('fetchSpinner');
    var tbody   = document.getElementById('tableBody');
    var meta    = document.getElementById('tableMeta');
    var pageRow = document.getElementById('paginationRow');

    btn.disabled = true;
    spinner.classList.remove('d-none');
    pageRow.style.display = 'none';
    meta.textContent = '';
    tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4">'
        + '<div class="spinner-border spinner-border-sm me-2"></div>Loading...</td></tr>';

    var payload = { page: page, limit: LIMIT };

    var from = document.getElementById('dateFrom').value;
    var to   = document.getElementById('dateTo').value;

    if (from) payload.date_from = from + ' 00:00:00';
    if (to)   payload.date_to   = to   + ' 23:59:59';

    try {
        var res = await fetch('/api/get_statuses', {
            method:  'POST',
            headers: { 'Content-Type': 'application/json' },
            body:    JSON.stringify(payload),
        });

        var json = await res.json();

        if (json.status !== true) {
            throw new Error(json.error || 'API error');
        }

        var rows = Array.isArray(json.data) ? json.data : [];

        if (!rows.length) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center text-secondary py-4">No leads found.</td></tr>';
            meta.textContent = '0 results';
            return;
        }

        tbody.innerHTML = rows.map(function (r) {
            return '<tr>'
                + '<td class="text-secondary">' + (r.id    || '-') + '</td>'
                + '<td>'                         + (r.email || '-') + '</td>'
                + '<td>'                         + statusBadge(r.status) + '</td>'
                + '<td>'                         + ftdLabel(r.ftd) + '</td>'
                + '</tr>';
        }).join('');

        meta.textContent = rows.length + ' result' + (rows.length !== 1 ? 's' : '') + ', page ' + (page + 1);

        pageRow.style.display = '';
        document.getElementById('pageInfo').textContent = 'Page ' + (page + 1);
        document.getElementById('prevBtn').disabled     = (page === 0);
        document.getElementById('nextBtn').disabled     = (rows.length < LIMIT);

    } catch (err) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center text-danger py-4">Error: ' + err.message + '</td></tr>';
    } finally {
        btn.disabled = false;
        spinner.classList.add('d-none');
    }
}

function changePage(dir) {
    var next = currentPage + dir;
    if (next >= 0) {
        loadStatuses(next);
    }
}

function statusBadge(s) {
    var map = {
        'new':      'bg-primary-subtle text-primary',
        'active':   'bg-success-subtle text-success',
        'ftd':      'bg-warning-subtle text-warning',
        'rejected': 'bg-danger-subtle text-danger',
        'reject':   'bg-danger-subtle text-danger',
    };
    var cls = map[s] || 'bg-secondary-subtle text-secondary';
    return '<span class="badge rounded-pill ' + cls + '">' + (s || '-') + '</span>';
}

function ftdLabel(ftd) {
    if (ftd == 1) {
        return '<span class="text-success fw-semibold">Yes</span>';
    }
    return '<span class="text-secondary">No</span>';
}
