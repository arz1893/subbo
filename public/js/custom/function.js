function selectCover(selected) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var val = $(selected).data('id');
    var modal = $('#popUpConfirm');
    modal.data('id', val);

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'image/getpicturename',
        dataType: 'json',
        data: {pict_id: modal.data('id'), _token: CSRF_TOKEN},
        success: function (response) {
            if(response != null) {
                $('#infoContent').text("You want to choose " + response.alias +" as your cover ?");
            }
        }
    });
}

function setDeleteTarget(selected) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var val = $(selected).data('id');
    var modal = $('#popUpDeleteImage');
    modal.data('id', val);

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'image/getpicturename',
        dataType: 'json',
        data: {pict_id: modal.data('id'), _token: CSRF_TOKEN},
        success: function (response) {
            $('#alertContentImage').text("Are you sure want to delete " + response.alias +" ?");
        }
    });
}

function setDeleteTargetAlbum(selected) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var val = $(selected).data('id');
    var modal = $('#popUpDeleteAlbum');
    modal.data('id', val);

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'album/getalbumname',
        dataType: 'json',
        data: {album_id: modal.data('id'), _token: CSRF_TOKEN},
        success: function (response) {
            $('#alertContentAlbum').text("Are you sure want to delete " + response +" ?");
        }
    });
}

function applyCover() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var modal = $('#popUpConfirm');
    var id = modal.data('id');

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'image/setalbumcover',
        dataType: 'json',
        data: {pict_id: id, _token: CSRF_TOKEN},

        success: function (response) {
            if(response == "success") {
                location.reload()
                // console.log(response);
            }
        }
    });
}

function deleteImage() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var image_id = $('#popUpDeleteImage').data('id');

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'image/deleteimage',
        dataType: 'json',
        data: {image_id: image_id, _token: CSRF_TOKEN},

        success: function (response) {
            location.reload();
        }
    });
}

function setPublishTargetAlbum(selected) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var album_id = $(selected).data('id');
    var modal = $('#popUpSetPublish');
    modal.data('id', album_id);

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'album/getalbumname',
        dataType: 'json',
        data: {album_id: modal.data('id'), _token: CSRF_TOKEN},
        success: function (response) {
            $('#alertPublishContent').text("Are you sure want to publish " + response + "? (once published you can't edit this album anymore)");
        }
    });
}

function setUnpublishTargetAlbum(selected) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var album_id = $(selected).data('id');
    var modal = $('#popUpSetUnpublish');
    modal.data('id', album_id);

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'album/getalbumname',
        dataType: 'json',
        data: {album_id: modal.data('id'), _token: CSRF_TOKEN},
        success: function (response) {
            $('#alertUnpublishContent').text("Are you sure want to unpublish " + response + "?");
        }
    });
}

function publishAlbum(selected) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var album_id = $('#popUpSetPublish').data('id');

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'album/publishalbum',
        dataType: 'json',
        data: {album_id: album_id, _token: CSRF_TOKEN},
        success: function (album_id) {
            window.location.replace(window.location.protocol + "//" + window.location.host + "/" + 'album' + "/" + album_id);
        }
    });
}

function unpublishAlbum(selected) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var album_id = $('#popUpSetUnpublish').data('id');

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'album/unpublishalbum',
        dataType: 'json',
        data: {album_id: album_id, _token: CSRF_TOKEN},
        success: function (album_id) {
            window.location.replace(window.location.protocol + "//" + window.location.host + "/" + 'album' + "/" + album_id);
        }
    });
}

function deleteAlbum() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var album_id = $('#popUpDeleteAlbum').data('id');
    console.log(album_id);
    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'album/deletealbum',
        dataType: 'json',
        data: {album_id: album_id, _token: CSRF_TOKEN},

        success: function (response) {
            window.location.replace(window.location.protocol + "//" + window.location.host + "/" + 'album');
        }
    });
}

function facebookShare(selected) {
    FB.ui({
        method: 'share',
        mobile_iframe: true,
        href: $(selected).data('url')
    }, function(response){});
}

function copyLinkAddress(selected) {
    var id = $(selected).data('id');

    if (navigator.userAgent.match(/ipad|ipod|iphone/i)) {
        var $input = $('#copy' + id);
        $input.val();
        var el = $input.get(0);
        var editable = el.contentEditable;
        var readOnly = el.readOnly;
        el.contentEditable = true;
        el.readOnly = false;
        var range = document.createRange();
        range.selectNodeContents(el);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
        el.setSelectionRange(0, 999999);
        el.contentEditable = editable;
        el.readOnly = readOnly;

        var successful = document.execCommand('copy');
        $input.blur();

        if(successful) {
            Materialize.toast('Link copied to clipboard', 3000);
        }
    }

    else {
        var url = document.createElement("input");
        url.setAttribute('value', $('#copy' + id).val());
        document.body.appendChild(url);
        url.select();
        document.execCommand("copy");
        document.body.removeChild(url);
        Materialize.toast('Link copied to clipboard', 3000);
    }
}

function getCountry() {
    alert('function triggered !');
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var countryId = null;
    $.getJSON('//freegeoip.net/json/?callback=?', function(data) {
        countryId = data.country_code;

        jQuery.getJSON(
            "https://restcountries.eu/rest/v1/alpha/" + countryId,
            function (data) {
                $.ajax({
                    method: 'POST',
                    url: window.location.protocol + "//" + window.location.host + "/session/set-country-detail",
                    dataType: 'json',
                    data: {country_name: data.nativeName, _token: CSRF_TOKEN},
                    success: function (response) {
                        console.log(response);
                        $('#get_country_loader').css('display', 'none');
                    }
                });

            });
    });
}

function urlChecking() {
    if(
        new String(window.location.href).valueOf() == new String(window.location.protocol + "//" + window.location.host + '/login').valueOf()
        || new String(window.location.href).valueOf() == new String(window.location.protocol + "//" + window.location.host + '/register').valueOf())
    {

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var countryId = null;
        $.getJSON('//freegeoip.net/json/?callback=?', function(data) {
            console.log(data);
            countryId = data.country_code;

            jQuery.getJSON(
                "https://restcountries.eu/rest/v1/alpha/" + countryId,
                function (data) {
                    $.ajax({
                        method: 'POST',
                        url: window.location.protocol + "//" + window.location.host + "/session/set-country-detail",
                        dataType: 'json',
                        data: {country_name: data.nativeName, _token: CSRF_TOKEN},
                        success: function (response) {
                            console.log(response);
                            $('#get_country_loader').css('display', 'none');
                        }
                    });

                });
        });
    }
}

function showCopyUrl(selected) {
    var id = $(selected).data('id');
    $('#copy' + id).toggleClass('hide');
}

function copy_text_address(selected, copy_text) {
    $(selected).select();
}

function checkCurrency(selected) {
    var access_key = 'cdfdcde22defdba0f15ab15f60e97b2b';
    var from = 'IDR';
    var to = 'USD';
    var amount = '1';

    $.ajax({
        method: 'GET',
        url: 'https://openexchangerates.org/api/convert/19999.95/GBP/EUR?app_id=e3905ebc424a447a9ba4f30bfcabe724',
        dataType: "json",
        success: function(response) {
            console.log(response);
        }
    });
}

function setHeader(xhr) {
    xhr.setRequestHeader('Access-Control-Allow-Origin', '*');
}