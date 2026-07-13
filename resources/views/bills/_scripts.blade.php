<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const body = document.getElementById('items-body');
    const template = document.getElementById('row-template');
    let index = body.querySelectorAll('.item-row').length;

    function initMedicineSelect(select) {
        new TomSelect(select, {
            create: false,
            allowEmptyOption: true,
            sortField: { field: 'text', direction: 'asc' },
        });
    }

    const discountInput = document.getElementById('discount-input');

    function recalc() {
        let gross = 0;
        body.querySelectorAll('.item-row').forEach(function (row) {
            const price = parseFloat(row.querySelector('.unit-price-input').value) || 0;
            const qty = parseInt(row.querySelector('.qty-input').value) || 0;
            const total = price * qty;
            row.querySelector('.line-total').textContent = total.toFixed(2);
            gross += total;
        });
        const discount = parseFloat(discountInput.value) || 0;
        const net = gross - discount;
        document.getElementById('gross-total').textContent = gross.toFixed(2);
        document.getElementById('net-total').textContent = net.toFixed(2);
    }

    discountInput.addEventListener('input', recalc);

    body.addEventListener('change', function (e) {
        if (e.target.classList.contains('medicine-select')) {
            const row = e.target.closest('.item-row');
            const opt = e.target.options[e.target.selectedIndex];
            const price = opt && opt.dataset.price ? parseFloat(opt.dataset.price) : 0;
            row.querySelector('.unit-price-input').value = price.toFixed(2);
            recalc();
        }
    });

    document.getElementById('add-row').addEventListener('click', function () {
        const html = template.innerHTML.replace(/__INDEX__/g, index++);
        const tr = document.createElement('tbody');
        tr.innerHTML = html.trim();
        const row = tr.firstChild;
        body.appendChild(row);
        initMedicineSelect(row.querySelector('.medicine-select'));
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

    body.querySelectorAll('.medicine-select').forEach(initMedicineSelect);

    recalc();
});
</script>
