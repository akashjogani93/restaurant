$(document).ready(function() {
    $.validator.addMethod("alphabetsnspace", function(value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
    });

    $('#addform').validate({
        rules: {
            itm: {
                required: true,
                alphabetsnspace: true
            },
            shnam: {
                required: true,
                alphabetsnspace: true
            },
            prc: {
                required: true
            }
        }
        ,
        messages: {
            empname: {
                alphabetsnspace: "Please Enter Only Letters"
            }

        }
    });
});
