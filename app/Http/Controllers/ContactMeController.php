<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMeRequest;
use App\Models\ContactMe;

class ContactMeController extends Controller
{


    public function edit()
    {
        $contact_me = ContactMe::first();
        return view('admin.contact_me.edit', compact('contact_me'));
    }


    public function update(ContactMeRequest $request, $id)
    {
        $contact_me = ContactMe::find($id);
        $contact_me->update($request->validated());
        return redirect()->route('admin.contact-me.edit')->with([
            'message' => __('Item updated successfully.'),
            'alert-type' => 'success']);
    }


}
