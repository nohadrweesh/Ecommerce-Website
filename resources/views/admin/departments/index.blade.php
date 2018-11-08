@extends('admin.index')
@section('content')
    @push('js')
        <script>
            $(document).ready (function(){ 
                // 6 create an instance when the DOM is ready
                $('#jstree').jstree({ 'core' : {
                        "themes" : {
                            "variant" : "large"
                        },
                        'data' :{!! load_departments()!!}
                    },

                    "checkbox" : {
                        "keep_selected_style" : false
                    },
                    "plugins" : [ "wholerow" ]


                });

                $('#jstree').on('changed.jstree',function(e,data){
                  var i,j,r=[];
                  for(i=0,j=data.selected.length;i<j;i++){
                    r.push(data.instance.get_node(data.selected[i]).id);
                  }
               

                  $('.parent_id').val(r.join(', '));
                   if(r.join(', ')!==''){
                    $('.show_btn_control').removeClass('hidden');
                    $('.show_btn_control').removeClass('hidden');

                    $('.edit_dep').attr('href',"{{ admin_url('departments') }}"+'/'+r.join(', ')+'/edit');
                    //$('.del_dep').removeClass('hidden');
                   }else{
                    $('.show_btn_control').addClass('hidden');
                    $('.show_btn_control').addClass('hidden');
                   }

                });

              
            });
        </script>
    @endpush


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <a  class="btn btn-info edit_dep show_btn_control hidden"><i class="fa fa-edit">Edit</i></a>
            <a  class="btn btn-danger del_dep show_btn_control hidden"><i class="fa fa-trash">Delete</i></a>

            <div id="jstree"></div>
              <input type="hidden" name="parent_id" class="parent_id" value="">

        </div>
        <!-- /.box-body -->
    </div>









@stop