<?php

namespace App\Http\Controllers;

use App\Models\MedicalStore;
use Illuminate\Http\Request;

class MedicalStoreController extends Controller
{
    public function index()
    {
        $stores = MedicalStore::latest()->get();
        return view('medical_stores.index', compact('stores'));
    }

    public function create()
    {
        return view('medical_stores.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        MedicalStore::create($data);
        return redirect()->route('medical_stores.index')->with('success', 'Medical store created successfully.');
    }

    public function show(MedicalStore $medicalStore)
    {
        return view('medical_stores.show', compact('medicalStore'));
    }

    public function edit(MedicalStore $medicalStore)
    {
        return view('medical_stores.edit', compact('medicalStore'));
    }

    public function update(Request $request, MedicalStore $medicalStore)
    {
        $data = $this->validateData($request);
        $medicalStore->update($data);
        return redirect()->route('medical_stores.index')->with('success', 'Medical store updated successfully.');
    }

    public function destroy(MedicalStore $medicalStore)
    {
        $medicalStore->delete();
        return redirect()->route('medical_stores.index')->with('success', 'Medical store deleted successfully.');
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'sub_name' => 'nullable|string|max:255',
            'license_no' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'bottom_content' => 'nullable|string',
        ]);
    }
}
