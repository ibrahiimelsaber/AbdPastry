<!-- JS Libraies -->
<script src="{{asset("assets/node_modules/prismjs/prism.js")}}"></script>
<!-- Page Specific JS File -->
<script src="{{asset("assets/js/page/bootstrap-modal.js")}}"></script>
<script>

    $("#modal-search").fireModal({
        title: 'Search',
        body: $("#modal-login-part"),
        footerClass: 'bg-whitesmoke',
        autoFocus: false,
        onFormSubmit: function (modal, e, form) {
            // Form Data
            let form_data = $(e.target).serialize();
            let branchId = <?php echo session('BranchId')?>;
            console.log(form_data)

            // DO AJAX HERE
            // let fake_ajax = setTimeout(function() {
            //     form.stopProgress();
            //     modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')
            //
            //     clearInterval(fake_ajax);
            // }, 1500);

            var dd = form_data.slice(0, form_data.indexOf('&'));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/branch-search',
                type: "GET",
                data: form_data,
                dataType: "json",
            });

            // e.preventDefault();
        },
        shown: function (modal, form) {
            console.log(form)
        },
        buttons: [
            {
                text: 'Search',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function (modal) {

                }
            }
        ]
    });
</script>

