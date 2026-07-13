<div class="mb-3">
    <label class="form-label">Medicine Name</label>
    <input type="text" name="medicine_name" class="form-control" value="{{ old('medicine_name', $medicine->medicine_name ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Unit Price</label>
    <input type="number" step="0.01" min="0" name="unit_price" class="form-control" value="{{ old('unit_price', $medicine->unit_price ?? '') }}" required>
</div>
