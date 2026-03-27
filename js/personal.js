document.addEventListener('DOMContentLoaded', function () {
    const saveBtn = document.getElementById('bookstack-personal-save');
    if (!saveBtn) return;

    saveBtn.addEventListener('click', function () {
        const form = document.getElementById('bookstack-personal-form');
        const status = document.getElementById('bookstack-personal-save-status');

        fetch(OC.generateUrl('/apps/bookstack/personal/settings'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'requesttoken': OC.requestToken,
            },
            body: JSON.stringify({
                token_id:     form.querySelector('[name=token_id]').value,
                token_secret: form.querySelector('[name=token_secret]').value,
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
