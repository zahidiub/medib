<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Medicine;
use App\Models\MedicalStore;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with(['medicalStore', 'patient'])->latest()->get();
        return view('bills.index', compact('bills'));
    }

    public function create()
    {
        return view('bills.create', [
            'bill' => new Bill(),
            'stores' => MedicalStore::orderBy('name')->get(),
            'patients' => Patient::orderBy('name')->get(),
            'medicines' => Medicine::orderBy('medicine_name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        DB::transaction(function () use ($data) {
            $bill = Bill::create([
                'medical_store_id' => $data['medical_store_id'],
                'patient_id' => $data['patient_id'],
                'receipt_no' => $data['receipt_no'],
                'date' => $data['date'],
                'discount' => $data['discount'] ?? 0,
            ]);
            $this->syncDetails($bill, $data['items']);
        });

        return redirect()->route('bills.index')->with('success', 'Bill created successfully.');
    }

    public function show(Bill $bill)
    {
        $bill->load(['medicalStore', 'patient', 'billDetails.medicine']);
        return view('bills.show', compact('bill'));
    }

    public function edit(Bill $bill)
    {
        $bill->load('billDetails');
        return view('bills.edit', [
            'bill' => $bill,
            'stores' => MedicalStore::orderBy('name')->get(),
            'patients' => Patient::orderBy('name')->get(),
            'medicines' => Medicine::orderBy('medicine_name')->get(),
        ]);
    }

    public function update(Request $request, Bill $bill)
    {
        $data = $this->validateData($request);

        DB::transaction(function () use ($bill, $data) {
            $bill->update([
                'medical_store_id' => $data['medical_store_id'],
                'patient_id' => $data['patient_id'],
                'receipt_no' => $data['receipt_no'],
                'date' => $data['date'],
                'discount' => $data['discount'] ?? 0,
            ]);
            $bill->billDetails()->delete();
            $this->syncDetails($bill, $data['items']);
        });

        return redirect()->route('bills.index')->with('success', 'Bill updated successfully.');
    }

    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect()->route('bills.index')->with('success', 'Bill deleted successfully.');
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'medical_store_id' => 'required|exists:medical_stores,id',
            'patient_id' => 'required|exists:patients,id',
            'receipt_no' => 'required|string|max:255',
            'date' => 'required|date',
            'discount' => 'nullable|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.medicine_id' => 'required|exists:medicines,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);
    }

    private function syncDetails(Bill $bill, array $items)
    {
        foreach ($items as $item) {
            $medicine = Medicine::findOrFail($item['medicine_id']);
            $quantity = (int) $item['quantity'];
            $unitPrice = (float) $item['unit_price'];

            // Persist an edited price back to the medicine record.
            if ((float) $medicine->unit_price !== $unitPrice) {
                $medicine->update(['unit_price' => $unitPrice]);
            }

            $bill->billDetails()->create([
                'medicine_id' => $medicine->id,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total_price' => $quantity * $unitPrice,
            ]);
        }
    }
}
