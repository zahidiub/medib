<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $medicalStore->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">License No</label>
    <input type="text" name="license_no" class="form-control" value="{{ old('license_no', $medicalStore->license_no ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Address</label>
    <input type="text" name="address" class="form-control" value="{{ old('address', $medicalStore->address ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Phone</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $medicalStore->phone ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Bottom Content</label>
    <textarea name="bottom_content" class="form-control" rows="4"
        placeholder="Footer text printed at the bottom of the receipt (one note per line)">{{ old('bottom_content', $medicalStore->bottom_content ?? '') }}</textarea>
</div>
