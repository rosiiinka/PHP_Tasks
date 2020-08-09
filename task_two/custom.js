function formatCompany(data) {
    if (!data.id) {
        return data.text;
    }
    var $data = $(
        '<span> <b>' + data.text + '</b> </br>' + data.name + ' </br> ' + data.address + '</span>'
    );
    return $data;
};

function formatFirstName(data) {
    if (!data.id) {
        return data.text;
    }
    var $data = $(
        '<span>' + data.company + '  <b> </br>' + data.text + ' ' + data.name + '</b> </br> ' + data.address + ' </span>'
    );
    return $data;
};

function formatLastName(data) {
    if (!data.id) {
        return data.text;
    }
    var $data = $(
        '<span>' + data.company + '  <b> </br>' + data.name + ' ' + data.text + '</b> </br> ' + data.address + ' </span>'
    );
    return $data;
};

$(function () {

    $('#company').select2({
        placeholder: 'Type for search...',
        minimumInputLength: 1,
        templateResult: formatCompany,
        ajax: {url: "contact_form.php?get_company=1", dataType: "json", cache: true},
    });

    $('#first_name').select2({
        placeholder: 'Type for search...',
        minimumInputLength: 1,
        templateResult: formatFirstName,
        ajax: {url: "contact_form.php?get_first_name=1", dataType: "json", cache: true},
    });

    $('#last_name').select2({
        placeholder: 'Type for search...',
        minimumInputLength: 1,
        templateResult: formatLastName,
        ajax: {url: "contact_form.php?get_last_name=1", dataType: "json", cache: true},
    });

    $('#company').on('select2:select', function () {
        let id = $(this).val();
        $.post('contact_form.php?getInformationById=' + id, function (data) {
            data = JSON.parse(data)
            let firstName = new Option(data.first_name, id, true, true);
            $('#first_name').append(firstName).trigger('change');
            let lastName = new Option(data.last_name, id, true, true);
            $('#last_name').append(lastName).trigger('change');
            $('#address_1').val(data.address);
            $('#email').val(data.email);
            $('#phone').val(data.phone);
        });
    });

    $('#first_name').on('select2:select', function () {
        let id = $(this).val();
        $.post('contact_form.php?getInformationById=' + id, function (data) {
            data = JSON.parse(data)
            let company = new Option(data.company, id, true, true);
            $('#company').append(company).trigger('change');
            let lastName = new Option(data.last_name, id, true, true);
            $('#last_name').append(lastName).trigger('change');
            $('#address_1').val(data.address);
            $('#email').val(data.email);
            $('#phone').val(data.phone);
        });
    });

    $('#last_name').on('select2:select', function () {
        let id = $(this).val();
        $.post('contact_form.php?getInformationById=' + id, function (data) {
            data = JSON.parse(data)
            let firstName = new Option(data.first_name, id, true, true);
            $('#first_name').append(firstName).trigger('change');
            let company = new Option(data.company, id, true, true);
            $('#company').append(company).trigger('change');
            $('#address_1').val(data.address);
            $('#email').val(data.email);
            $('#phone').val(data.phone);
        });
    });

});