<?php

namespace App\Http\Controllers\API;

use App\Event;
use App\Http\Controllers\API\BaseController as BaseController;
//use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EventController extends BaseController
{
    public function index(){
        $events = Event::all();
        return $this->sendResponse($events->toArray(), 'Events retrieved successfully!');
    }


    public function store(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'eventOrganizer' => 'required',
            'eventName' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'eventDescription' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error, unauthorised', $validator->errors());
        }

        $event = Event::create($input);

        return $this->sendResponse($event->toArray(), 'Event Created!');
    }

    public function show($id){
        $event = Event::find($id);

        if(is_null($event)){
            return $this->sendError('Event does not exist');
        }

        return $this->sendResponse($event->toArray(), 'Event found!');
    }

    public function update(Request $request, Event $event){
        $input = $request->all();

        $validator = Validator::make($input, [
            'eventOrganizer' => 'required',
            'eventName' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'eventDescription' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('incomplete data', $validator->errors());
        }

        $event->eventOrganizer = $input['eventOrganizer'];
        $event->eventName =$input['eventName'];
        $event->startDate =$input['startDate'];
        $event->endDate =$input['endDate'];
        $event->eventDescription =$input['eventDescription'];
        $event->email =$input['email'];
        $event->phone =$input['phone'];
        $event->save();
        return $this->sendResponse($event->toArray(), 'Event has been updated');
    }

    public function destroy(Event $event){
        try {
            $event->delete();
        } catch (\Exception $e) {
        }

        return $this->sendResponse($event->toArray(), 'Event has been deleted');
    }


}
