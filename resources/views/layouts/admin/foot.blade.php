        {{-- livewire Scripts --}}
    @livewireScripts
    <!-- Bootstrap core JavaScript-->

    {{-- <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('backend/js/demo/chart-pie-demo.js') }}"></script>
    @yield('js')
    <script>
        $('.insubmit').submit(function(){
    $(this).find(':button[type=submit]').prop('disabled', true);
});

    </script>
    {{-- <script>
        $(document).on('click', '#save', function(e) {
            e.preventDefault();
            $('#span').remove();
            let formData = new FormData($('#form')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: " {{ route('admin.view.message') }} ",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {

                },
                error: function(reject) {

                }

            });
        });
    </script> --}}
    <script>
        $(function() {
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();
                var controlForm = $(this).closest('.fvrduplicate'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(controlForm);
                newEntry.find('.input').val('');
                controlForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<i class="fa fa-minus" aria-hidden="true"></i>');
            }).on('click', '.btn-remove', function(e) {
                $(this).closest('.entry').remove();
                return false;
            });
        });
    </script>
    </body>

    </html>
