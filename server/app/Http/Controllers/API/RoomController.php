<?php
namespace App\Http\Controllers\API;

use Auth;
use Illuminate\Http\Request;
use App\Models\Room;
use Validator;
use App\Http\Resources\Room as RoomResource;
use App\Http\Controllers\API\BaseController as BaseController;


class RoomController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = Room::all();
         return $this->sendResponse(RoomResource::collection($room),
          'All rooms sent');
    }

    public function joinRoom(Request $request){
        if(Auth::check()){
            $code = $request['code'];
            if($code){
                //$room = Room::where('code',$code)->take(1)->get();
                $room = Room::where('code',$code)->first();
                $id = Auth::user()['id'];

                $request->session()->put('room_code',$code);
                return $this->sendResponse(new RoomResource($room) ,'Room joined successfully');


            }

            return $this->sendError('Room not found');
        }

    }

    public function userInRoom(Request $request){
       // $id = $request['id'];
       // return $request->session()->get($id);
        if ($request->session()->has('room_code')) {
            $code = $request->session()->get('room_code');
                return $this->sendResponse($code,'User Already IN this room');
        }
        
        return $this->sendError('User not found in this Room');

    }

    public function leaveRoom(Request $request){
         if ($request->session()->has('room_code')){

            $request->session()->pull('room_code');
            $host_id = Auth::user()->id;
            $room = Room::where('host',$host_id)->first();
            if($room != NULL){
                $room->delete();
            }
             return $this->sendResponse($host_id,'Success you leaved the room');
         }
        
    }

    
     
    public function store(Request $request)
    {

         //create code 
        $length=6;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
      

        //end of create code

        //token 

        $host = Auth::user()->id;
        //end token

        $request->request->add(['code' => $randomString]);
        $request->request->add(['host' => $host]);
        $input = $request->all();
        //return $input;

        $validator = Validator::make($input,[
            //'host' => 'required',
            'number_of_votes' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors() );
        }

       
        $room = Room::create($input);

        return $this->sendResponse(new RoomResource($room) ,'Room created successfully');
    }

  
    public function show($id)
    {
        $room = Room::find($id);
        if(is_null($room)){
            return $this->sendError('Room not found');
        }
        return $this->sendResponse(new RoomResource($room) ,'Room founded successfully');


    }

    
    public function update(Request $request, Room $room)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'host' => 'required',
            'number_of_votes' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors() );
        }

        $room->number_of_votes = $input['number_of_votes'];
        $room->save();
        return $this->sendResponse(new RoomResource($room) ,'Room updated successfully');

    }

    public function destroy(Room $room)
    {
        $room->delete();
          return $this->sendResponse(new RoomResource($room) ,'Room deleted successfully');

    }


   
}
