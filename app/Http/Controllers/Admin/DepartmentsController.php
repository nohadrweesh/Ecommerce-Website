<?php

namespace App\Http\Controllers\Admin;
use App\Model\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CityDatatable;
use App\Model\Department;

use Up;
use Storage;
class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $title='All Departments';
         //$country_ids=Country::pluck('country_name_'.lang(),'id');
        return view('admin.departments.index',compact('title'));
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title='Add New Department';
         //$country_ids=Country::pluck('country_name_'.lang(),'id');
        return view('admin.departments.create',compact('title'));
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
            'dep_name_ar'=>'required',
            'dep_name_en'=>'required',
            'parent_id'=>'sometimes|nullable|numeric',
            'icon'=>'sometimes|nullable'.validate_image(),
            'description'=>'sometimes|nullable',
            'keywords'=>'sometimes|nullable',
           
        ],[],[
                'Arabic City Name',
                'English City Name',
                'Parent Id',
                'Icon',
                'Description',
                'Keywords'
                
        ]);
        if(request()->has('icon')){
            /*if(!empty(setting()->icon)){
                Storage::delete(setting()->icon);
            }*/
            //$data['icon']=request()->file('icon')->store('settings');
            $data['icon']=Up::upload([
                //'new_name'=>'',
                'file'=>'icon',
                'delete_file'=>'',
                'path'=>'departments',
                'upload_type'=>'single',


            ]);
        }

        Department::create($data);
        session()->flash('success','Added New Department');
        return redirect(admin_url('departments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        //
        $city=Department::findOrFail($id);
        $title='Edit Department';
        $country_ids=Country::pluck('country_name_'.lang(),'id');
        return view('admin.departments.edit',compact('city','title','country_ids'));
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
            'dep_name_ar'=>'required',
            'dep_name_en'=>'required',
            'parent_id'=>'sometimes|nullable|numeric',
            'icon'=>'sometimes|nullable',
            'description'=>'sometimes|nullable',
            'keywords'=>'sometimes|nullable',
           
        ],[],[
                'Arabic City Name',
                'English City Name',
                'Parent Id',
                'Icon',
                'Description',
                'Keywords'
                
        ]);

        if(request()->has('icon')){
            /*if(!empty(setting()->icon)){
                Storage::delete(setting()->icon);
            }*/
            //$data['icon']=request()->file('icon')->store('settings');
            $data['icon']=Up::upload([
                //'new_name'=>'',
                'file'=>'icon',
                'delete_file'=>Department::findOrFail($id),
                'path'=>'departments',
                'upload_type'=>'single',


            ]);
        }
        
        
          Department::where('id',$id)->update($data);
        session()->flash('success','Department Information updated successfullly');
        return redirect(admin_url('departments'));

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
        $city=City::where('id',$id);
      
        $city->delete();
        session()->flash('success','City deleted successfullly');
        return redirect(admin_url('cities'));
    }

    public function multi_delete(){
//dd(request('item') );
        if(is_array(request('item')   ) ){
            foreach(request('item') as $item){
                $city=City::where('id',$item);
                
                $city->delete();

            }
        }
        else{
            $city=City::where('id',request('item'));

           
            $city->delete();
        }
        

       
        session()->flash('success','City(s) deleted successfullly');
        return redirect(admin_url('cities'));

    }
}
