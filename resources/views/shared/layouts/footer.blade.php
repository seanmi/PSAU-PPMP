   <!-- jQuery -->
   <script src="{{asset('css/vendor/jquery/jquery.min.js')}}"></script>
   <!-- Bootstrap Core JavaScript -->
   <script src="{{asset('css/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
   <!-- Metis Menu Plugin JavaScript -->
   <script src="{{asset('css/vendor/metisMenu/metisMenu.min.js')}}"></script>
   <!-- Morris Charts JavaScript -->
   <script src="{{asset('css/vendor/raphael/raphael.min.js')}}"></script>
   <script src="{{asset('css/vendor/morrisjs/morris.min.js')}}"></script>
   <!-- Custom Theme JavaScript -->
   <script src="{{asset('css/dist/js/sb-admin-2.js')}}"></script>
   <!-- DataTables JavaScript -->
   <script src="{{asset('css/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
   <script src="{{asset('css/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
   <script src="{{asset('css/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
   <!-- Custom Theme JavaScript -->
   <script src="{{asset('css/dist/js/sb-admin-2.js')}}"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   <script src="{{asset('js/axios.min.js')}}"></script>
   <script>
           @if(Session::has('success'))
            toastr.success('{{Session::get('success')}}')
            @endif
            @if(Session::has('fail'))
                  toastr.error('{{Session::get('fail')}}')
            @endif
   </script>