<?php

namespace App\Http\Controllers\Api;

use App\Models\Subscriber;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Api\StoreSubscriberRequest;
use Illuminate\Http\JsonResponse;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(['subscribers' => Subscriber::all()]);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSubscriberRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
                return response()->json($request->validator->messages(), 400);
        }

        return Subscriber::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Subscriber $subscriber)
    {
        return $subscriber;
    }


    /**
    * Display fields for the specified resource.
    *
    * @param  \App\Subscriber  $subscriber
    * @return \Illuminate\Http\JsonResponse
    */
    public function fields(Subscriber $subscriber)
    {
        return response()->json(['fields' => $subscriber->fields()->get()->toArray()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreSubscriberRequest $request, Subscriber $subscriber)
    {
        if (isset($request->validator) && $request->validator->fails()) {
                return response()->json($request->validator->messages(), 400);
        }

        $subscriber->update($request->validated());
        return response()->json(['subscriber' => $subscriber]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscriber  $subscriber
     * @return Illuminate\Http\JsonResponse
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return response()->json(["Specified resource delete"]);
    }
}
