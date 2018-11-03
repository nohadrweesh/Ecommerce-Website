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
                        'data' : [
                            { "id" : "ajson1", "parent" : "#", "text" : "Simple root node" },
                            { "id" : "ajson2", "parent" : "#", "text" : "Root node 2" },
                            { "id" : "ajson3", "parent" : "ajson2", "text" : "Child 1" },
                            { "id" : "ajson4", "parent" : "ajson2", "text" : "Child 2" },
                        ]
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