<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::all();
        return view('bills.index', compact('bills'));
    }

    public function create()
    {
        return view('bills.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'medical_store_id' => 'required|exists:medical_stores,id',
            'patient_name' => 'required|string|max:255',
            'bill_date' => 'required|date',
        ]);

        Bill::create($request->all());
        return redirect()->route('bills.index')->with('success', 'Bill created successfully.');
    }

    public function show(Bill $bill)
    {
        return view('bills.show', compact('bill'));
    }

    public function edit(Bill $bill)
    {
        return view('bills.edit', compact('bill'));
    }

    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'medical_store_id' => 'required|exists:medical_stores,id',
            'patient_name' => 'required|string|max:255',
            'bill_date' => 'required|date',
        ]);

        $bill->update($request->all());
        return redirect()->route('bills.index')->with('success', 'Bill updated successfully.');
    }

    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect()->route('bills.index')->with('success', 'Bill deleted successfully.');
    }
}