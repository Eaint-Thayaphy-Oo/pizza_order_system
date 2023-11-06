<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use function Ramsey\Uuid\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //direct contact page
    public function contact()
    {
        return view('user.contact.list');
    }

    //when click submit button
    public function contactPage(Request $request)
    {
        // dd($request->all());
        $this->validationContact($request);
        $data = $this->getContactData($request);

        Contact::create($data);
        // dd($contact->toArray());
        return back()->with(['messageContact' => 'Contact created successfully...']);
    }

    //for validationContact
    private function validationContact($request)
    {
        Validator::make($request->all(), [
            'contactName' => 'required',
            'contactEmail' => 'required|unique:contacts,email,',
            'contactMessage' => 'required',
        ])->validate();
    }

    //for getting contactData
    private function getContactData($request)
    {
        return [
            'name' => $request->contactName,
            'email' => $request->contactEmail,
            'message' => $request->contactMessage,
        ];
    }
}
