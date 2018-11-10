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
                  var i,j,r=[],name=[];
                  for(i=0,j=data.selected.length;i<j;i++){
                    r.push(data.instance.get_node(data.selected[i]).id);
                    name.push(data.instance.get_node(data.selected[i]).text);
                  }
               

                  $('.parent_id').val(r.join(', '));
                  $('#dep_name').html('" '+name.join(', ')+' " ');
                   if(r.join(', ')!==''){
                    $('.show_btn_control').removeClass('hidden');
                    $('.show_btn_control').removeClass('hidden');
                    $('#delete_dep_form').attr('action',"{{admin_url('departments')}}"+"/"+r.join(', '));

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

    <!-- Modal -->
    <div id="del_dep" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Warning</h4>
                </div>

                {!! Form::open(['id'=>'delete_dep_form','url'=>'','method'=>'delete'])!!}
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <p>Are you sure you want to delete the dep <span id="dep_name"></span>?</p>
                    </div>

                </div>
                <div class="modal-footer">
                    {!!Form::submit('Yes',['class'=>'btn btn-danger'])!!}

                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>

                {!!Form::close()!!}
            </div>

        </div>
    </div>


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <a  class="btn btn-info edit_dep show_btn_control hidden"><i class="fa fa-edit"> Edit</i></a>
            <a  class="btn btn-danger del_dep show_btn_control hidden" data-toggle="modal" data-target="#del_dep"><i class="fa fa-trash"> Delete</i></a>

            <div id="jstree"></div>
              <input type="hidden" name="parent_id" class="parent_id" value="">

        </div>
        <!-- /.box-body -->
    </div>









@stop