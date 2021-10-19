<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;
use App\Models\Billing;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $billings = Billing::paginate(10);

        return view('billings/billing', compact('billings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $clients = Clients::all();
        return view('billings/add-billing', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validated = $request->validate([
            'amount' => 'required',
            'due_date' => 'required',
        ]);

        $amount = $request->amount;
        $due_date = $request->due_date;
        $client_id = $request->client_id;
        $description= $request->description;

        $billing = new Billing();
        $billing->amount = $amount;
        $billing->due_date = $due_date;
        $billing->client_id = $client_id;
        $billing->description= $description;
        $billing->save();

        return back()->with('billing_added', 'billing has been inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $billing = Billing::find($id);
        $clients = Clients::all();
        return view('billings/edit-billing', compact('billing', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'amount' => 'required',
            'due_date' => 'required',
        ]);

        $amount = $request->amount;
        $due_date = $request->due_date;
        $client_id = $request->client_id;
        $description= $request->description;

        $billing = Billing::find($id);
        $billing->amount = $amount;
        $billing->due_date = $due_date;
        $billing->client_id = $client_id;
        $billing->description= $description;
        $billing->update();

        return back()->with('billing_updated', 'billing has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $billing = Billing::find($id);
        $billing->delete();
        return redirect()->back()->with('billing_deleted', 'Billing has been deleted');
    }
}
