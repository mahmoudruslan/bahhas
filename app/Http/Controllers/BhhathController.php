<?php

namespace App\Http\Controllers;

use App\Http\Requests\BhhathRequest;
use App\Models\Bhhath;

class BhhathController extends Controller
{

    public function edit()
    {
        $bhhath = Bhhath::first();
        return view('admin.bhhath.edit', compact('bhhath'));
    }

    public function update(BhhathRequest $request, $id)
    {
        $bhhath = Bhhath::find($id);
        $bhhath->update($request->validated());
        return redirect()->route('admin.bhhath.edit')->with([
            'message' => __('Item updated successfully.'),
            'alert-type' => 'success']);
    }
}
