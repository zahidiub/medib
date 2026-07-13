<?php

namespace App\Http\Controllers;

use App\Models\BillDetail;
use Illuminate\Http\Request;

class BillDetailController extends Controller
{
    public function index()
    {
        $billDetails = BillDetail::all();
        return view('bill_details.index', compact('billDetails'));
    }

    public function create()
    {
        return view('bill_details.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bill_id' => 'required|exists:bills,id',
            'medicine_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        BillDetail::create($request->all());
        return redirect()->route('bill_details.index')->with('success', 'Bill detail created successfully.');
    }

    public function show($id)
    {
        $billDetail = BillDetail::findOrFail($id);
        return view('bill_details.show', compact('billDetail'));
    }

    public function edit($id)
    {
        $billDetail = BillDetail::findOrFail($id);
        return view('bill_details.edit', compact('billDetail'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bill_id' => 'required|exists:bills,id',
            'medicine_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $billDetail = BillDetail::findOrFail($id);
        $billDetail->update($request->all());
        return redirect()->route('bill_details.index')->with('success', 'Bill detail updated successfully.');
    }

    public function destroy($id)
    {
        $billDetail = BillDetail::findOrFail($id);
        $billDetail->delete();
        return redirect()->route('bill_details.index')->with('success', 'Bill detail deleted successfully.');
    }
}