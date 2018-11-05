@extends('admin.index')
@section('content')
    @push('js')
        <script>
            $(function () {
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
                    "plugins" : [ "wholerow", "checkbox" ]


                });

                $('button').on('click', function () {
                    $('#jstree').jstree(true).select_node('child_node_1');
                    $('#jstree').jstree('select_node', 'child_node_1');
                    $.jstree.reference('#jstree').select_node('child_node_1');
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

            <div id="jstree"></div>

        </div>
        <!-- /.box-body -->
    </div>









@stop