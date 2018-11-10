<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ManufacturerDatatable;
use App\Model\Manufacturer;
use Up;
use Storage;
class ManufacturersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManufacturerDatatable $country)
    {
        //
       // dd("kk");
        return $country->render('admin.manufacturers.index',['title'=>'Manufacturers Control']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //dd("create");
        return view('admin.manufacturers.create',['title'=>'Add New Manufacturer']);
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
        //dd("store");

        $data=$this->validate($request,[
            'name_ar'=>'required',
            'name_en'=>'required',
            'mobile'=>'required|numeric',
            'email'=>'required|email',
            'twitter'=>'sometimes|nullable|url',
            'facebook'=>'sometimes|nullable|url',
            'website'=>'sometimes|nullable|url',
            'contact_name'=>'sometimes|nullable|string',
            'lat'=>'sometimes|nullable',
            'lang'=>'sometimes|nullable',
            'logo'=>'required|'.validate_image()
        ],[],[
                'Arabic  Name',
                'English  Name','Mobile','Email',
                'Twitter','Facebook','Website','Contact Name','Latitude','Longitude','Logo'
        ]);
        $data['logo']=Up::upload([
     				//'new_name'=>'',
     				'file'=>'logo',
     				//'delete_file'=>setting()->logo,
     				'path'=>'manufacturers',
     				'upload_type'=>'single',


     		]);
        
//dd("store");
        Manufacturer::create($data);

        session()->flash('success','Added New Manufacturer');
        return redirect(admin_url('manufacturers'));
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
        $country=Manufacturer::findOrFail($id);
        $title='Edit Manufacturer';
        return view('admin.manufacturers.edit',compact('country','title'));
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
            'name_ar'=>'required',
            'name_en'=>'required',
            'mobile'=>'required|numeric',
            'email'=>'required|email',
            'twitter'=>'sometimes|nullable|url',
            'facebook'=>'sometimes|nullable|url',
            'website'=>'sometimes|nullable|url',
            'contact_name'=>'sometimes|nullable|string',
            'lat'=>'sometimes|nullable',
            'lang'=>'sometimes|nullable',
            'logo'=>'required|'.validate_image()
        ],[],[
            'Arabic  Name',
            'English  Name','Mobile','Email',
            'Twitter','Facebook','Website','Contact Name','Latitude','Longitude','Logo'
        ]);
        if($request->has('logo')) {
            $data['logo'] = Up::upload([
                //'new_name'=>'',
                'file' => 'logo',
                'delete_file' => Trademark::find($id)->logo,
                'path' => 'manufacturers',
                'upload_type' => 'single',


            ]);
        }

        Manufacturer::where('id',$id)->update($data);
        session()->flash('success','Manufacturer Information updated successfully');
        return redirect(admin_url('manufacturers'));

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
        $country=Manufacturer::where('id',$id);

        Storage::delete($country->first()->logo);
        $country->delete();
        session()->flash('success','Manufacturer deleted successfully');
        return redirect(admin_url('manufacturers'));
    }

    public function multi_delete(){
//dd(request('item') );
        if(is_array(request('item')   ) ){
            foreach(request('item') as $item){
                $country=Manufacturer::where('id',$item);
                //dd($country->get());
                //dd($country->logo);
                Storage::delete($country->first()->logo);
                $country->delete();

            }
        }
        else{
            $country=Manufacturer::where('id',request('item'));

            Storage::delete($country->first()->logo);
            $country->delete();
        }
        

       
        session()->flash('success','Manufacturer(s) deleted successfully');
        return redirect(admin_url('manufacturers'));

    }
}
