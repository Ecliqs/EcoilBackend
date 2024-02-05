</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="https://starpactglobal.com/">Starpact Global</a>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset ('plugins/jquery/jquery.min.js') }} "></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset ('plugins/jquery-ui/jquery-ui.min.js') }} "></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset ('plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
<!-- ChartJS -->
<script src="{{ asset ('plugins/chart.js/Chart.min.js') }} "></script>
<!-- Sparkline -->
<script src="{{ asset ('plugins/sparklines/sparkline.js') }} "></script>
<!-- JQVMap -->
<script src="{{ asset ('plugins/jqvmap/jquery.vmap.min.js') }} "></script>
<script src="{{ asset ('plugins/jqvmap/maps/jquery.vmap.usa.js') }} "></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset ('plugins/jquery-knob/jquery.knob.min.js') }} "></script>
<!-- daterangepicker -->
<script src="{{ asset ('plugins/moment/moment.min.js') }} "></script>
<script src="{{ asset ('plugins/daterangepicker/daterangepicker.js') }} "></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset ('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }} "></script>
<!-- Summernote -->
<script src="{{ asset ('plugins/summernote/summernote-bs4.min.js') }} "></script>
<!-- overlayScrollbars -->
<script src="{{ asset ('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }} "></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }} "></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset ('dist/js/demo.js') }} "></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset ('dist/js/pages/dashboard.js') }} "></script>

<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>

<script>
  CKEDITOR.replace('editor', {
  skin: 'moono',
  enterMode: CKEDITOR.ENTER_BR,
  shiftEnterMode:CKEDITOR.ENTER_P,
  toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },
             { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
             { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },
             { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
             { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
             { name: 'links', items: [ 'Link', 'Unlink' ] },
             { name: 'insert', items: [ 'Image'] },
             { name: 'spell', items: [ 'jQuerySpellChecker' ] },
             { name: 'table', items: [ 'Table' ] }
             ],
});
</script>


</body>
</html>