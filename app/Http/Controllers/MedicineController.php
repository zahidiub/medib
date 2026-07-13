<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::latest()->get();
        return view('medicines.index', compact('medicines'));
    }

    public function create()
    {
        return view('medicines.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        Medicine::create($data);
        return redirect()->route('medicines.index')->with('success', 'Medicine created successfully.');
    }

    public function show(Medicine $medicine)
    {
        return view('medicines.show', compact('medicine'));
    }

    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $data = $this->validateData($request);
        $medicine->update($data);
        return redirect()->route('medicines.index')->with('success', 'Medicine updated successfully.');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('medicines.index')->with('success', 'Medicine deleted successfully.');
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'medicine_name' => 'required|string|max:255',
            'unit_price' => 'required|numeric|min:0',
        ]);
    }
}
