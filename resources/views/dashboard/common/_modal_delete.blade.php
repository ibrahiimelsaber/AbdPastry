{{--
-- Created by: @IbrahimElsaber
-- this file needs (id), (url),
--}}

{{--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}
<script src="{{asset('assets/js/sweetalert/sweetalert.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '.delete', function (e) {
        const id = $(this).data('id');
        console.log(id);

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover these data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{$indexUrl}}" + '/' + id,
                        type: "POST",
                        data: {'_method': 'DELETE'},
                        success: () => {
                            swal({
                                title: "Success!",
                                text: "Post has been deleted \n Click OK to refresh the page",
                                icon: "success",
                            });
                            location.reload();
                        },
                        error: () => {
                            swal({
                                title: 'Opps...',
                                //text : data.message,
                                icon: 'error',
                                //timer: '1500'
                            })
                        }
                    })
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    });
</script>
