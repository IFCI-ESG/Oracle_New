<script>
    function GetCityByPinCode(name, pincode) {
// console.log(name);
        var state = '#' + name + 'AddState';
        var city = '#' + name + 'AddCity';
        // var district = '#' + name + 'AddDistrict';

        if (pincode.length != 6) {
            $("#pincodeMsg").text('Pincode Incorrect!');
            $("#pincodeMsg").show();
            $(state).val('');
            $(city).val('');
            // $(district).val('');
        }
        if (pincode.length == 6 && $.isNumeric(pincode)) {
            $.ajax({
                url: '/pincodes/' + pincode,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // console.log(data.state.length);
                    if (data.state.length == 0) {
                        // alert('g');
                        $("#pincodeMsg").text('Pincode Not Found');
                        $("#pincodeMsg").show();

                    } else {
                        $("#pincodeMsg").hide();
                        $.each(data.state, function(index, value) {
                            $(state).val(value)
                        });
                        var selOpts = "<option  selected disabled>Please choose..</option>";
                        // var selOpts1 = "<option  selected disabled>Please choose..</option>";

                        $.each(data.city, function(index1, value1) {
                            $(city).val(value1);
                            selOpts += "<option value='" + value1 + "'>" +
                                value1 +
                                "</option>";
                        });
                        $(city)
                            .empty()
                            .append(selOpts);

                        // $.each(data.district, function(index2, value2) {
                        //     $(district + count).val(value2);
                        //     selOpts1 += "<option value='" + value2 + "'>" +
                        //         value2 +
                        //         "</option>";
                        // });
                        // $(district + count)
                        //     .empty()
                        //     .append(selOpts1);
                    }

                }
            });
        };
    }

</script>
