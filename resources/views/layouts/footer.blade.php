            <footer class="main-footer">
                <strong>Copyright &copy; 2020 <a href="">demo</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                
                </div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{url('')}}/design/adminlte/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{url('')}}/design/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- dataTables -->
        <script src="{{ url('design/adminlte') }}/plugins/datatables.net-bs/js/jquery.dataTables.min.js"></script>
        <script src="{{ url('design/adminlte') }}/plugins/datatables.net-bs/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{ url('design/adminlte') }}/plugins/datatables.net-bs/js/dataTables.rowReorder.min.js"></script>
        <script src="{{ url('design/adminlte') }}/plugins/datatables.net-bs/js/rowReorder.bootstrap4.min.js"></script>
        <script src="{{ url('design/adminlte') }}/plugins/datatables.net-bs/js/dataTables.responsive.min.js"></script>
        <script src="{{ url('design/adminlte') }}/plugins/datatables.net-bs/js/responsive.bootstrap4.min.js"></script>
        <script src="{{ url('design/adminlte') }}/plugins/datatables.net-bs/js/dataTables.buttons.min.js"></script>
        <script src="{{ url('design/adminlte') }}/plugins/datatables.net-bs/js/pdfmake.min.js"></script>
        <script src="{{ url('design/adminlte') }}/plugins/datatables.net-bs/js/buttons.html5.min.js"></script>
        <script src="{{ url('design/adminlte') }}/plugins/datatables.net-bs/js/vfs_fonts.js"></script>
        <script src="{{ url('') }}/vendor/datatables/buttons.server-side.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{url('')}}/design/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="{{url('')}}/design/adminlte/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="{{url('')}}/design/adminlte/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="{{url('')}}/design/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="{{url('')}}/design/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- toastr -->
        <script src="{{url('')}}/design/adminlte/plugins/toastr/toastr.min.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{url('')}}/design/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="{{url('')}}/design/adminlte/plugins/moment/moment.min.js"></script>
        <script src="{{url('')}}/design/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{url('')}}/design/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="{{url('')}}/design/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="{{url('')}}/design/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- dropzone -->
		<script src="{{url('')}}/design/adminlte/plugins/dropzone-master/dist/min/dropzone.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{url('')}}/design/adminlte/dist/js/adminlte.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{url('')}}/design/adminlte/dist/js/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{url('')}}/design/adminlte/dist/js/demo.js"></script>
        <!-- Password Strength Meter -->
        <script src="{{url('')}}/design/adminlte/dist/js/password_strength_meter.js"></script>
        <!-- js tree -->
        <script src="{{ url('design/adminlte/jstree/jstree.js') }}"></script>
		<script src="{{ url('design/adminlte/jstree/jstree.wholerow.js') }}"></script>
		<script src="{{ url('design/adminlte/jstree/jstree.checkbox.js') }}"></script>
        <script>
            function check_all() { 
				$('input.item_checkbox').each(function () { 
					if ($('input.check_all:checked').length == 0) {
						$(this).prop('checked', false);
					} else {
						$(this).prop('checked', true);
					}
				});
			 }
			 
			$(document).on('click', '.del_all', function () {
				$('#delete_all').submit();
			});
			$(document).on('click', '.delBtn', function () {
				var item_checked = $('input.item_checkbox').filter(':checked').length;
				if (item_checked > 0) {
					$('.record_count').text(item_checked);
					$('.not_empty_record').removeClass('hidden');
					$('.empty_record').addClass('hidden');
				} else {
					$('.record_count').text('');
					$('.not_empty_record').addClass('hidden');
					$('.empty_record').removeClass('hidden');
				}
				$('#mutlipleDelete').modal('show');
			});
        </script>
        <script>
            function toggleFullscreen(elem) {
                elem = elem || document.documentElement;
                if (!document.fullscreenElement && !document.mozFullScreenElement &&
                    !document.webkitFullscreenElement && !document.msFullscreenElement) {
                    if (elem.requestFullscreen) {
                        elem.requestFullscreen();
                    } else if (elem.msRequestFullscreen) {
                        elem.msRequestFullscreen();
                    } else if (elem.mozRequestFullScreen) {
                        elem.mozRequestFullScreen();
                    } else if (elem.webkitRequestFullscreen) {
                        elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                    }
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    }
                }
            }
            
            document.getElementById('btnFullscreen').addEventListener('click', function(e) {
                e.preventDefault();
                toggleFullscreen();
            });
            /*
            document.getElementById('exampleImage').addEventListener('click', function() {
                toggleFullscreen(this);
            });
            */
            $('#btnFullscreen').on('click', function () {	
                $(this).children('i').toggleClass("fa-expand fa-compress");
			});

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#imageUpload").change(function() {
                readURL(this);
            });
        </script>
        @stack('js')

        @yield('footer')
    </body>
</html>
