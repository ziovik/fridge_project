$(document).ready(function () {
    $('.right-btn').attr('disabled', 'disabled');

    function loadNecessaryData() {
        $.post({
            url: 'ajax.php',
            success(data) {
                let rows = JSON.parse(data);

                rows.forEach((e, i) => {
                    if (e.beginTime2 == null) {
                        $('#begin-time1-' + e.fridgeId).val(e.beginTime1);
                        $('#end-time1-' + e.fridgeId).val(e.endTime1);
                        $('#left' + e.fridgeId + '-btn').attr('disabled', 'disabled');
                        $('#right' + e.fridgeId + '-btn').removeAttr('disabled');
                    } else {
                        $("#time-table-" + e.fridgeId).before('<tr>' +
                            '<td>' + e.beginTime1 + '</td>' +
                            '<td>' + e.endTime1 + '</td>' +
                            '<td>' + e.beginTime2 + '</td>' +
                            '<td>' + e.endTime2 + '</td>' +
                            '</tr>');
                    }
                });
            }
        });
    }

    loadNecessaryData();

    $('.left-btn').click(function (event) {
        event.preventDefault();

        let fridgeId = $(this).data('fridgeId');

        $(this).attr('disabled', 'disabled');
        $('#right' + fridgeId + "-btn").removeAttr('disabled');

        $.post({
            url: 'ajax.php',
            data: {fridgeId: fridgeId, type: "INSERT"},
            success: function (data) {
                let currentTime = moment().format('LTS');
                $('#begin-time1-' + fridgeId).val(moment(currentTime, "h:mm:ss A").format("HH:mm:ss"));
                // $('#begin-time1' + fridgeId).val(data);
                // $('#end-time1' + fridgeId).val(moment().format('LTS'));
                let updaetedTime = moment().add(30, 'minutes').add(2, 'hours').format('LTS');
                $('#end-time1-' + fridgeId).val(moment(updaetedTime, "h:mm:ss A").format("HH:mm:ss"));
                //$(this).attr("disabled", true);

            },
            error: function (data) {
                console.log(data);
            }
        })
    });

    $(".right-btn").click(function (event) {
        event.preventDefault();

        let fridgeId = $(this).data('fridgeId');

        $(this).attr('disabled', 'disabled');
        $('#left' + fridgeId + "-btn").removeAttr('disabled');

        $.post({
            url: 'ajax.php',
            data: {fridgeId: fridgeId, type: "UPDATE"},
            success: function (data) {
                let currentTime = moment().format('LTS');
                $('#begin-time2-' + fridgeId).val(moment(currentTime, "h:mm:ss A").format("HH:mm:ss"));
                // $('#end-time2' + fridgeId).val(moment().format('LTS'));
                let updaetedTime = moment().add(40, 'minutes').format('LTS');
                $('#end-time2-' + fridgeId).val(moment(updaetedTime, "h:mm:ss A").format("HH:mm:ss"));
                $('left' + fridgeId + '-btn').removeAttr('disabled');

                location.reload();
            },
            error: function (data) {
                console.log(data);
            }
        })
    });

})
