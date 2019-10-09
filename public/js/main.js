
$(document).on('click','.poista-linkki', function() {
    var id = $(this).attr('poista-linkki');

        bootbox.confirm({
            message: "<h4>Haluatko varmasti poistaa? </h4>",
            buttons: {
                confirm: {
                    label: '<i class="fa fa-check"></i> Kyllä',
                    className: 'btn-danger'
                },
                cancel: {
                    label: '<i class="fa fa-times"></i> En',
                    className: 'btn-primary'
                }
            },
            callback: function (result) {
                //Painettiinko kyllä painiketta=
                if(result==true){
                    var url = "/aloitelaatikko/poista/" + id;
                    $(location).attr('href',url);
                }
            }

        });
        return false;
});