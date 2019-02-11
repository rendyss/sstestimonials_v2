var $ = jQuery.noConflict();

$(function () {

    //Form submit testimonial clicked
    $('body').on('click', '.btnsend', function (e) {
        e.preventDefault();
        var btn = $(this),
            btnCaption = btn.html(),
            frm = $(this).closest('form'),
            parentform = frm.closest('.parentform'),
            notif = parentform.find('.ntf'),
            dataObj = $(frm).serializeArray(),
            inputs = $(frm).find('input[type=text], input[type=email], textarea');

        notif.html('');
        inputs.prop('disabled', true);
        btn.prop("disabled", true).html("Loading...");
        var ajaxSubmittestimonial = $.ajax({
            url: my_ajax_object.ajax_url,
            method: 'POST',
            data: {
                'action': my_ajax_object.plugin_name + '_save',
                'data': dataObj
            },
            // contentType: "application/json; charset=utf-8",
            dataType: "json"
        });

        ajaxSubmittestimonial.done(function (data) {
            inputs.prop("disabled", false);
            var notif_block = !data.success ? "ss_alert warning" : "ss_alert success";
            if (data.success) {
                inputs.val('');
            }
            notif.html("<div class=\"" + notif_block + "\"><span class=\"closebtn\">&times;</span> " + data.message + "</div>");
            btn.prop("disabled", false).html(btnCaption);
        });

        ajaxSubmittestimonial.fail(function (data) {
            inputs.prop("disabled", false);
        })
    });

    //Function to close notifications
    $('body').on('click', '.closebtn', function (e) {
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function () {
            div.style.display = "none";
        }, 600);
    });
});