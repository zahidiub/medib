@php
    if (old('items')) {
        $items = old('items');
    } elseif (isset($bill) && $bill->exists) {
        $items = $bill->billDetails->map(fn($d) => [
            'medicine_id' => $d->medicine_id,
            'quantity' => $d->quantity,
        ])->toArray();
    } else {
        $items = [['medicine_id' => '', 'quantity' => 1]];
    }
@endphp

<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label">Medical Store</label>
        <select name="medical_store_id" class="form-select" required>
            <option value="">-- Select --</option>
            @foreach($stores as $store)
                <option value="{{ $store->id }}"
                    {{ (string) old('medical_store_id', $bill->medical_store_id ?? '') === (string) $store->id ? 'selected' : '' }}>
                    {{ $store->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Patient</label>
        <select name="patient_id" class="form-select" required>
            <option value="">-- Select --</option>
            @foreach($patients as $patient)
                <option value="{{ $patient->id }}"
                    {{ (string) old('patient_id', $bill->patient_id ?? '') === (string) $patient->id ? 'selected' : '' }}>
                    {{ $patient->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Receipt No</label>
        <input type="text" name="receipt_no" class="form-control"
               value="{{ old('receipt_no', $bill->receipt_no ?? '') }}" required>
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="date" class="form-control"
               value="{{ old('date', isset($bill->date) ? \Illuminate\Support\Carbon::parse($bill->date)->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
    </div>
</div>

<h6 class="mt-2">Medicines</h6>
<table class="table align-middle" id="items-table">
    <thead>
        <tr>
            <th style="width:45%">Medicine</th>
            <th style="width:15%">Qty</th>
            <th style="width:15%">Unit Price</th>
            <th style="width:15%">Total</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody id="items-body">
        @foreach($items as $i => $item)
        <tr class="item-row">
            <td>
                <select name="items[{{ $i }}][medicine_id]" class="form-select medicine-select" required>
                    <option value="">-- Select --</option>
                    @foreach($medicines as $medicine)
                        <option value="{{ $medicine->id }}" data-price="{{ $medicine->unit_price }}"
                            {{ (string) $item['medicine_id'] === (string) $medicine->id ? 'selected' : '' }}>
                            {{ $medicine->medicine_name }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" min="1" name="items[{{ $i }}][quantity]" class="form-control qty-input" value="{{ $item['quantity'] }}" required></td>
            <td class="unit-price">0.00</td>
            <td class="line-total">0.00</td>
            <td><button type="button" class="btn btn-outline-danger btn-sm remove-row"><i class="bi bi-trash"></i></button></td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">
                <button type="button" class="btn btn-outline-primary btn-sm" id="add-row">
                    <i class="bi bi-plus-lg"></i> Add Medicine
                </button>
            </td>
        </tr>
        <tr>
            <th colspan="3" class="text-end">Gross Total</th>
            <th id="gross-total">0.00</th>
            <th></th>
        </tr>
    </tfoot>
</table>

<template id="row-template">
    <tr class="item-row">
        <td>
            <select name="items[__INDEX__][medicine_id]" class="form-select medicine-select" required>
                <option value="">-- Select --</option>
                @foreach($medicines as $medicine)
                    <option value="{{ $medicine->id }}" data-price="{{ $medicine->unit_price }}">{{ $medicine->medicine_name }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="number" min="1" name="items[__INDEX__][quantity]" class="form-control qty-input" value="1" required></td>
        <td class="unit-price">0.00</td>
        <td class="line-total">0.00</td>
        <td><button type="button" class="btn btn-outline-danger btn-sm remove-row"><i class="bi bi-trash"></i></button></td>
    </tr>
</template>
