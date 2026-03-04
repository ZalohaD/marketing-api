
document.addEventListener('DOMContentLoaded', function () {

    var form    = document.getElementById('leadForm');
    var btn     = document.getElementById('submitBtn');
    var spinner = document.getElementById('submitSpinner');
    var label   = document.getElementById('submitLabel');
    var result  = document.getElementById('resultCard');
    var errCard = document.getElementById('errorCard');
    var errMsg  = document.getElementById('errorMsg');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        form.classList.add('was-validated');
        if (!form.checkValidity()) return;

        btn.disabled      = true;
        label.textContent = 'Submitting...';
        spinner.classList.remove('d-none');
        result.classList.add('d-none');
        errCard.classList.add('d-none');

        try {
            var res = await fetch('/api/add_lead', {
                method:  'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    firstName: form.firstName.value,
                    lastName:  form.lastName.value,
                    phone:     form.phone.value,
                    email:     form.email.value,
                }),
            });

            var json = await res.json();

            if (json.status === true) {
                document.getElementById('res-id').textContent    = json.id    || '-';
                document.getElementById('res-email').textContent = json.email || '-';

                var al = document.getElementById('res-autologin');
                al.innerHTML = json.autologin
                    ? '<a href="' + json.autologin + '" target="_blank">' + json.autologin + '</a>'
                    : '-';

                result.classList.remove('d-none');
                form.reset();
                form.classList.remove('was-validated');
            } else {
                errMsg.textContent = json.error || 'Unknown error';
                errCard.classList.remove('d-none');
            }

        } catch (err) {
            errMsg.textContent = 'Network error. Please try again.';
            errCard.classList.remove('d-none');
        } finally {
            btn.disabled      = false;
            label.textContent = 'Submit Lead';
            spinner.classList.add('d-none');
        }
    });

});
