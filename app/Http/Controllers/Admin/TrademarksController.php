<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\TrademarkDatatable;
use App\Model\Trademark;
use Up;
use Storage;
class TrademarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TrademarkDatatable $country)
    {
        //
       // dd("kk");
        return $country->render('admin.trademarks.index',['title'=>'Trademarks Control']);
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
        return view('admin.trademarks.create',['title'=>'Add New Trademark']);
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
            'logo'=>'required|'.validate_image()
        ],[],[
                'Arabic  Name',
                'English  Name',
                'Logo'
        ]);
        $data['logo']=Up::upload([
     				//'new_name'=>'',
     				'file'=>'logo',
     				//'delete_file'=>setting()->logo,
     				'path'=>'trademarks',
     				'upload_type'=>'single',


     		]);
        
//dd("store");
        Trademark::create($data);

        session()->flash('success','Added New Trademark');
        return redirect(admin_url('trademarks'));
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
        $country=Trademark::findOrFail($id);
        $title='Edit Trademark';
        return view('admin.trademarks.edit',compact('country','title'));
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
            'logo'=>'sometimes|nullable|'.validate_image()
        ],[],[
            'Arabic  Name',
            'English  Name',
            'Logo'
        ]);
        if($request->has('logo')) {
            $data['logo'] = Up::upload([
                //'new_name'=>'',
                'file' => 'logo',
                'delete_file' => Trademark::find($id)->logo,
                'path' => 'trademarks',
                'upload_type' => 'single',


            ]);
        }

        Trademark::where('id',$id)->update($data);
        session()->flash('success','Trademark Information updated successfullly');
        return redirect(admin_url('trademarks'));

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
        $country=Trademark::where('id',$id);

        Storage::delete($country->first()->logo);
        $country->delete();
        session()->flash('success','Trademark deleted successfullly');
        return redirect(admin_url('trademarks'));
    }

    public function multi_delete(){
//dd(request('item') );
        if(is_array(request('item')   ) ){
            foreach(request('item') as $item){
                $country=Trademark::where('id',$item);
                //dd($country->get());
                //dd($country->logo);
                Storage::delete($country->first()->logo);
                $country->delete();

            }
        }
        else{
            $country=Trademark::where('id',request('item'));

            Storage::delete($country->first()->logo);
            $country->delete();
        }
        

       
        session()->flash('success','Trademark(s) deleted successfullly');
        return redirect(admin_url('trademarks'));

    }
}
