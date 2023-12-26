<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Penawaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenawaranController extends Controller
{
    
    public function store(Request $request)
    {
        $bid = str_replace('.', '', $request->input('harga_bid'));
        $harga_bid = intval($bid);

        $today = Carbon::now();

        Validator::make(
            ['harga_bid' => $harga_bid],
            ['harga_bid' => 'required|numeric|min:' . $request->input('current_price') . '|max:999999999'],
            [
                'harga_bid.min' => 'Harga harus lebih besar dari ' . $request->input('current_price'),
                'harga_bid.max' => 'Harga tidak boleh lebih dari 999999999',
                'harga_bid.required' => 'Anda belum memasukkan harga',
                'harga_bid.numeric' => 'Harga harus berupa angka',
            ]
        )->validate();

        Penawaran::create([
            'id_barang' => $request->input('id_barang'),
            'id_pembeli' => $request->input('id_pembeli'),
            'harga_bid' => $harga_bid,
            'tanggal' => $today,
        ]);

        return back()->with('message', 'Berhasil melakukan penawaran');
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
    }
}
