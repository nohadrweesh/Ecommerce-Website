<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\StateDatatable;
use App\Model\City;
use App\Model\Country;
use App\Model\State;

use Up;
use Storage;
use Form;
class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StateDatatable $city)
    {
        //
        return $city->render('admin.states.index',['title'=>'States Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(request()->ajax()){
            if(request()->has('country_id')){
                $select=request()->has('select')?request('select'):'';
                $city_ids=City::where('country_id',request('country_id'))->pluck('city_name_'.lang(),'id');
                //dd($city_ids);
                return  Form::select('city_id',$city_ids,$select,['class'=>'form-control','placeholder'=>'..................']);
            }
        }
            $title='Add New State';
             $country_ids=Country::pluck('country_name_'.lang(),'id');
             //dd($country_ids);
            return view('admin.states.create',compact('title','country_ids'));
    
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

        $data=$this->validate($request,[
            'state_name_ar'=>'required',
            'state_name_en'=>'required',
            'city_id'=>'required',
            'country_id'=>'required'
           
        ],[],[
               'Arabic State Name',
                'English State Name',
                'City Id',
                'Country Id',
                
        ]);
       

        State::create($data);
        session()->flash('success','Added New State');
        return redirect(admin_url('states'));
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
        $city=State::findOrFail($id);
        $title='Edit City';
        $country_ids=Country::pluck('country_name_'.lang(),'id');
        return view('admin.states.edit',compact('city','title','country_ids'));
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
        //return request()->all();

         $data=$this->validate($request,[
            'state_name_ar'=>'required',
            'state_name_en'=>'required',
            'city_id'=>'required',
            'country_id'=>'required',
           
        ],[],[
                'Arabic State Name',
                'English State Name',
                'City Id',
                'Country Id',
               
        ]);
       
        
        
          State::where('id',$id)->update($data);
        session()->flash('success','State Information updated successfullly');
        return redirect(admin_url('states'));

     //  return request()->all();
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
        $city=State::where('id',$id);
      
        $city->delete();
        session()->flash('success','State deleted successfullly');
        return redirect(admin_url('states'));
    }

    public function multi_delete(){
//dd(request('item') );
        if(is_array(request('item')   ) ){
            foreach(request('item') as $item){
                $city=State::where('id',$item);
                
                $city->delete();

            }
        }
        else{
            $city=State::where('id',request('item'));

           
            $city->delete();
        }
        

       
        session()->flash('success','State(s) deleted successfullly');
        return redirect(admin_url('states'));

    }
}
