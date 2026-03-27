document.addEventListener('DOMContentLoaded', function () {
    const saveBtn = document.getElementById('bookstack-save');
    if (!saveBtn) return;

    saveBtn.addEventListener('click', function () {
        const form = document.getElementById('bookstack-admin-form');
        const status = document.getElementById('bookstack-save-status');

        fetch(OC.generateUrl('/apps/bookstack/admin/settings'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'requesttoken': OC.requestToken,
            },
            body: JSON.stringify({
                base_url: form.querySelector('[name=base_url]').value,
            }),
        })
        .then(r => r.json())
        .then(data => {
            status.textContent = data.status === 'ok' ? '✓ Saved' : '✗ Error';
            setTimeout(() => { status.textContent = ''; }, 3000);
        })
        .catch(() => {
            status.textContent = '✗ Request failed';
        });
    });
});
