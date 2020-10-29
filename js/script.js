$(document).ready(function () {
    //$(".right_btn").attr("disabled", 'disabled');

    $(".left_btn").click(function (event) {
        event.preventDefault();
        $(this).attr("disabled", 'disabled');
        let fridgeId = $(this).data('fridgeId');
      
        $.post({
            url: 'ajax.php',
            data: {fridgeId: fridgeId, type: "INSERT"},
            success: function (data) {
                let currentTime = moment().format('LTS');
                $('#begin-time1' + fridgeId).val(moment(currentTime,  "h:mm:ss A").format("HH:mm:ss"));
                // $('#begin-time1' + fridgeId).val(data);
               // $('#end-time1' + fridgeId).val(moment().format('LTS'));
                let updaetedTime =  moment().add(30, 'minutes').add(2, 'hours').format('LTS');
                $('#end-time1' + fridgeId).val(moment(updaetedTime,  "h:mm:ss A").format("HH:mm:ss"));
                //$(this).attr("disabled", true);
                 
            },
            error: function (data) {
                console.log(data);
            }
        })
    });

    $(".right_btn").click(function (event) {
        event.preventDefault();

        let fridgeId = $(this).data('fridgeId');

        $.post({
            url: 'ajax.php',
            data: {fridgeId: fridgeId, type: "UPDATE"},
            success: function (data) {
                 let currentTime = moment().format('LTS');
                $('#begin-time2' + fridgeId).val(moment(currentTime,  "h:mm:ss A").format("HH:mm:ss"));
                // $('#end-time2' + fridgeId).val(moment().format('LTS'));
                 let updaetedTime =  moment().add(40, 'minutes').format('LTS');
                $('#end-time2' + fridgeId).val(moment(updaetedTime,  "h:mm:ss A").format("HH:mm:ss"));
                $('left' + fridgeId + '-btn').removeAttr('disabled');
            },
            error: function (data) {
                console.log(data);
            }
        })
    });

})
