<?php

$address_types = ["Shipping", "Billing", "Service", "Selected", "Original", "Home", "Work"];

if(isset($_GET['get_type']) && $_GET['get_type'] == 1){
    $searched_types = [];

    foreach($address_types as $key => $type){
        if(stripos($type,$_GET['term']) !== false){
            $searched_types[] = array('id' => $key, 'text' => $type);
        }
    }

    $ret['results'] = $searched_types;
    echo json_encode($ret);
    exit;
}

?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="_select2.scss" rel="stylesheet" />
    <link href="../bootstrap-4.3.1-dist\css\bootstrap.min.css" rel="stylesheet" />
    <link href="../bower_components/select2/dist/css/select2.min.css" rel="stylesheet" />
    <script src="../bower_components/select2/dist/js/select2.min.js"></script>
</head>

<body>
    <div>
        <div class="d-flex justify-content-center">
        <label >Choose address types:</label>
        </div>
        <div class="d-flex justify-content-center">
        <select name="address_types[]" id="address_types" multiple="multiple">
            <option selected value="3" locked="locked">Selected</option>
            <option selected value="0" locked="locked">Shipping</option>
        </select>
        </div>
    </div>
</body>

<script>
    $(function () {
        $('#address_types').select2({
            placeholder: 'Select a type',
            minimumInputLength: 1,
            tags: true,
            insertTag: function (data, tag) {
                data.push(tag);
            },
            ajax: {url: "select2.php?get_type=1", dataType: "json", cache: true},
            //remove the x from the preselected options
            templateSelection : function (tag, container){
                var $option = $('#address_types option[value="'+tag.id+'"]');
                if ($option.attr('locked')){
                    $(container).addClass('locked-tag');
                    tag.locked = true;
                }
                return tag.text;
            },
        })
            // or if you want to see the x uncomment this and remove the templateSection
            // .on('select2:unselecting', function(e){
            // if ($(e.params.args.data.element).attr('locked')) {
            //     e.preventDefault();
            // }
            // });
    });
</script>