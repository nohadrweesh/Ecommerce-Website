<?php
if(!function_exists('admin_url')){
	function admin_url($url=null){
		return url('admin/'.$url);
	}
}

if(!function_exists('admin')){
	function admin(){
		return  auth()->guard('admin');
	}
}

if(!function_exists('lang')){
	function lang(){
		if(session()->has('lang')){
            return session('lang');
        }else{
            return setting()->main_lang;
        }
	}
}
if(!function_exists('direction')){
	function direction(){
		/*if(session()->has('lang')){
            if( session('lang')=='ar')
            	return 'rtl';
            else
            	return 'ltr';
        }else{
            return 'ltr';
        }*/
        
        if(lang()=='ar')
            return 'rtl';
        else
            return 'ltr';
	}
}

if(!function_exists('datatable_lang')){
	function datatable_lang(){
		return  [
                    'sProcessing'     => trans('admin.sProcessing'),
                    'sLengthMenu'     => trans('admin.sLengthMenu'),
                    'sZeroRecords'    => trans('admin.sZeroRecords'),
                    'sEmptyTable'     => trans('admin.sEmptyTable'),
                    'sInfo'           => trans('admin.sInfo'),
                    'sInfoEmpty'      => trans('admin.sInfoEmpty'),
                    'sInfoFiltered'   => trans('admin.sInfoFiltered'),
                    'sInfoPostFix'    => trans('admin.sInfoPostFix'),
                    'sSearch'         => trans('admin.sSearch'),
                    'sUrl'            => trans('admin.sUrl'),
                    'sInfoThousands'  => trans('admin.sInfoThousands'),
                    'sLoadingRecords' => trans('admin.sLoadingRecords'),
                    'oPaginate'       => [
                        'sFirst'         => trans('admin.sFirst'),
                        'sLast'          => trans('admin.sLast'),
                        'sNext'          => trans('admin.sNext'),
                        'sPrevious'      => trans('admin.sPrevious'),
                    ],
                    'oAria'            => [
                        'sSortAscending'  => trans('admin.sSortAscending'),
                        'sSortDescending' => trans('admin.sSortDescending'),
                    ],
                ];
	}
}

if(!function_exists('setting')){
	function setting(){
		return  \App\Model\Setting::orderBy('id','desc')->first();
	}
}


if(!function_exists('validate_image')){
    function validate_image($ext=null){
       if($ext==null){
        return 'image|mimes:jpg,jpeg,gif,png,bmp';
       }else{
        return 'image|mimes:'.$ext;
       }
    }
}

if(!function_exists('load_departments')){
    function load_departments($select=null){
        $departments=\App\Model\Department::selectRaw('dep_name_'.lang().' as text' )
        ->selectRaw('id as id')
        ->selectRaw('parent_id as parent')
        ->get(['text','id','parent']);
       // dd(\App\Model\Department::get());
        $dep_arr=[];
        foreach ($departments as $department) {
            $list_arr=[];
            if($select!==null && $select==$department->id){
                $list_arr['icon']='';
                $list_arr['li_attr']='';
                $list_arr['a_attr']='';
                $list_arr['children']=[];
                $list_arr['state']=[
                            'opened'=>true,
                            'selected'=>true,
                ];

            }
            $list_arr['id']=$department->id;
            $list_arr['parent']=$department->parent !==null?$department->parent:'#';
            $list_arr['text']=$department->text;
            array_push($dep_arr,$list_arr);
        }
        return json_encode($dep_arr);


    }
     
}