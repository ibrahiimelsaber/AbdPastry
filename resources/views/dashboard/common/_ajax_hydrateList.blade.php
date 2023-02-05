<script>
    function hydrateList(countryId) {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: "GET",
            data: {countryId: countryId},
            url: '{{route('dashboard.json.cities')}}',
            dataType: 'json',
            success: function(data) {
                const $el = $("#cities_list");
                $el.empty(); // remove old options
                $.each(data, function(value, key) {
                    $el.append($("<option></option>").attr("value", key.id).text(key.name));
                });
            }
        });
    }
</script>