<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Contact;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
        return response()->json($contacts);
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
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required'
        ]);
        if ($validator->fails()) {
            $response = array('response' => $validator->getMessageBag(), 'success' => false);
            return $response;
        } else {
            $contact = new Contact;
            $status = 0;
            $contact->firstname = $request->firstname;
            $contact->lastname = $request->lastname;
            if ($request->status) {
                $status = $request->status;
            }
            $contact->status = $status;
            if ($contact->save()) {
                return response()->json(['data' => $contact, 'status' => $contact->status, 'message' => 'Contact Saved']);
            } else {
                return response()->json(['data' => $contact, 'status' => $contact->status, 'message' => 'Error Occured']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        return response()->json($contact);
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
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required'
        ]);
        if ($validator->fails()) {
            $response = array('response' => $validator->getMessageBag(), 'success' => false);
            return $response;
        } else {
            $contact = Contact::find($id);
            $status = 0;
            $contact->firstname = $request->firstname;
            $contact->lastname = $request->lastname;
            if (intval($request->status) === 1) {
                $status = 1;
            }
            $contact->status = $status;
            if ($contact->save()) {
                return response()->json(['data' => $contact, 'status' => $contact->status, 'message' => 'Contact Updated']);
            } else {
                return response()->json(['data' => $contact, 'status' => $contact->status, 'message' => 'Error Occured']);
            }

            return response()->json($contact);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);

        if ($contact->delete()) {
            return response()->json(['data' => $contact, 'status' => $contact->id, 'message' => 'Contact Deleted']);
        } else {
            return response()->json(['data' => $contact, 'status' => $contact->id, 'message' => 'Error Occured']);
        }
    }
}
