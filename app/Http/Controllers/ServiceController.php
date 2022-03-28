<?php

namespace App\Http\Controllers;

use App\Models\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $data_vetService = Service::all();
        $vet_data = DB::table('services')
            ->join('users', 'services.userID', '=', 'users.id')
            ->select('users.*', 'services.*')->get();
        $vetService_data = DB::table('services')
            ->join('users', 'services.userID', '=', 'users.id')
            ->where('services.verificationStatus', '=', 'Verified')
            ->select('users.*', 'services.*')->get();

        if (Auth::user()->type == 'veterinary'){
            return view('veterinary.dashboard', compact('data_vetService'));
        }
        elseif (Auth::user()->type == 'admin'){
            return view('admin.verifyVet', compact('vet_data'));
        }
        elseif (Auth::user()->type == 'customer'){
            return view('customer.service', compact('vetService_data'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    public function updateStatus(Request $request)
    {
        $verificationStatus = $request->verificationStatus;
        $id = $request->id;

        $update = [
            'id' => $id,
            'verificationStatus' => $verificationStatus
        ];

        Service::where('id', $request->id)->update($update);

        return redirect()->route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}