<?php

namespace App\Http\Controllers;

use App\Models\MedicalStore;
use Illuminate\Http\Request;

class MedicalStoreController extends Controller
{
    public function index()
    {
        $stores = MedicalStore::all();
        return view('medical_stores.index', compact('stores'));
    }

    public function create()
    {
        return view('medical_stores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'license_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
        ]);

        MedicalStore::create($request->all());
        return redirect()->route('medical_stores.index')->with('success', 'Medical Store created successfully.');
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
        $request->validate([
            'license_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
        ]);

        $medicalStore->update($request->all());
        return redirect()->route('medical_stores.index')->with('success', 'Medical Store updated successfully.');
    }

    public function destroy(MedicalStore $medicalStore)
    {
        $medicalStore->delete();
        return redirect()->route('medical_stores.index')->with('success', 'Medical Store deleted successfully.');
    }
}