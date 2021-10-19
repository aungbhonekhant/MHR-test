<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients = Clients::paginate(10);

        return view('clients/client', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients/add-client');
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
            'name' => 'required|max:255',
        ]);
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;
        $photo = $request->file('photo');
        $imageName = time().'.'.$photo->extension();
        $photo->storeAs('public/', $imageName);

        $clients = new Clients();

        $clients->name = $name;
        $clients->email = $email;
        $clients->phone = $phone;
        $clients->address = $address;
        $clients->photo = $imageName;

        $clients->save();

        return back()->with('client_added', 'Client has been inserted');
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
        //
        $client = Clients::find($id);
        return view('clients/edit-client', compact('client'));
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
        //
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;
        

        $clients = Clients::find($id);
        $clients->name = $name;
        $clients->email = $email;
        $clients->phone = $phone;
        $clients->address = $address;
        if($request->photo){
            $photo = $request->file('photo');
            $imageName = time().'.'.$photo->extension();
            $photo->storeAs('public/', $imageName);
        }else{
            $imageName = $clients->photo;
        }
        
        $clients->photo = $imageName;
        $clients->update();

        return redirect()->back()->with('client_edited', 'Client has been updated');
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
        $clients = Clients::find($id);
        $clients->delete();
        return redirect()->back()->with('client_deleted', 'Client has been deleted');
    }
}
