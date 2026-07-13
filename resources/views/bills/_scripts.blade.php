<script>
document.addEventListener('DOMContentLoaded', function () {
    const body = document.getElementById('items-body');
    const template = document.getElementById('row-template');
    let index = body.querySelectorAll('.item-row').length;

    function recalc() {
        let gross = 0;
        body.querySelectorAll('.item-row').forEach(function (row) {
            const select = row.querySelector('.medicine-select');
            const opt = select.options[select.selectedIndex];
            const price = opt && opt.dataset.price ? parseFloat(opt.dataset.price) : 0;
            const qty = parseInt(row.querySelector('.qty-input').value) || 0;
            const total = price * qty;
            row.querySelector('.unit-price').textContent = price.toFixed(2);
            row.querySelector('.line-total').textContent = total.toFixed(2);
            gross += total;
        });
        document.getElementById('gross-total').textContent = gross.toFixed(2);
    }

    document.getElementById('add-row').addEventListener('click', function () {
        const html = template.innerHTML.replace(/__INDEX__/g, index++);
        const tr = document.createElement('tbody');
        tr.innerHTML = html.trim();
        body.appendChild(tr.firstChild);
        recalc();
    });

    body.addEventListener('click', function (e) {
        if (e.target.closest('.remove-row')) {
            const rows = body.querySelectorAll('.item-row');
            if (rows.length > 1) {
                e.target.closest('.item-row').remove();
            } else {
                alert('At least one medicine is required.');
            }
            recalc();
        }
    });

    body.addEventListener('change', recalc);
    body.addEventListener('input', recalc);

    recalc();
});
</script>
