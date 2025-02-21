jQuery(document).ready(function($) {

    const restaurantCoefficient = {
        "bakery": {
            "00": 0.035,
            "01": 0.046,
            "10": 0.035,
            "11": 0.046
        },
        "bar_grill": {
            "00": 0.005,
            "01": 0.007,
            "10": 0.025,
            "11": 0.033
        },
        "bbq": {
            "00": 0.035,
            "01": 0.046,
            "10": 0.035,
            "11": 0.046
        },
        "breakfast_bar": {
            "00": 0.005,
            "01": 0.007,
            "10": 0.025,
            "11": 0.033
        },
        "buffet": {
            "00": 0.035,
            "01": 0.046,
            "10": 0.058,
            "11": 0.075
        },
        "burger": {
            "00": 0.035,
            "01": 0.046,
            "10": 0.035,
            "11": 0.046
        },
        "cafeteria": {
            "00": 0.025,
            "01": 0.033,
            "10": 0.035,
            "11": 0.046
        },
        "catering": {
            "00": 0.005,
            "01": 0.007,
            "10": 0.025,
            "11": 0.033
        },
        "chinese": {
            "00": 0.035,
            "01": 0.046,
            "10": 0.058,
            "11": 0.075
        },
        "coffee": {
            "00": 0.025,
            "01": 0.033,
            "10": 0.035,
            "11": 0.046
        },
        "convenience": {
            "00": 0.005,
            "01": 0.007,
            "10": 0.025,
            "11": 0.033
        },
        "deepfried": {
            "00": 0.035,
            "01": 0.046,
            "10": 0.058,
            "11": 0.075
        },
        "deli": {
            "00": 0.005,
            "01": 0.007,
            "10": 0.025,
            "11": 0.033
        },
        "family": {
            "00": 0.035,
            "01": 0.046,
            "10": 0.035,
            "11": 0.046
        },
        "frozen_yogurt": {
            "00": 0.005,
            "01": 0.007,
            "10": 0.025,
            "11": 0.033
        },
        "greek": {
            "00": 0.025,
            "01": 0.033,
            "10": 0.035,
            "11": 0.046
        },
        "grocery_bakery": {
            "00": 0.025,
            "01": 0.033,
            "10": 0.035,
            "11": 0.046
        },
        "grocery_deli": {
            "00": 0.025,
            "01": 0.033,
            "10": 0.035,
            "11": 0.046
        },
        "grocery_meat": {
            "00": 0.025,
            "01": 0.033,
            "10": 0.025,
            "11": 0.033
        },
        "icecream": {
            "00": 0.025,
            "01": 0.033,
            "10": 0.035,
            "11": 0.046
        },
        "indian": {
            "00": 0.025,
            "01": 0.033,
            "10": 0.035,
            "11": 0.046
        },
        "italian": {
            "00": 0.035,
            "01": 0.046,
            "10": 0.035,
            "11": 0.046
        },
        "mexican_fastfood": {
            "00": 0.035,
            "01": 0.046,
            "10": 0.035,
            "11": 0.046
        },
        "mexican": {
            "00": 0.035,
            "01": 0.046,
            "10": 0.058,
            "11": 0.075
        },
        "pizza": {
            "00": 0.025,
            "01": 0.033,
            "10": 0.035,
            "11": 0.046
        },
        "religious": {
            "00": 0.005,
            "01": 0.007,
            "10": 0.025,
            "11": 0.033
        },
        "sandwich": {
            "00": 0.005,
            "01": 0.007,
            "10": 0.025,
            "11": 0.033
        },
        "snackbar": {
            "00": 0.005,
            "01": 0.007,
            "10": 0.025,
            "11": 0.033
        },
        "steak": {
            "00": 0.035,
            "01": 0.046,
            "10": 0.058,
            "11": 0.075
        },
        "sushi": {
            "00": 0.005,
            "01": 0.007,
            "10": 0.025,
            "11": 0.033
        }
    };

    $('.timeline-accordion-content.first').css('display', 'block');
    $(".timeline-accordion-header").on("click", function() {
        var $content = $(this).next(".timeline-accordion-content");
        var $currentItem = $(this).closest(".timeline-accordion-item");

        if ($currentItem.hasClass("active")) {
            $content.stop(true, true).slideUp();
            $currentItem.removeClass("active");
        } else {
            $(".timeline-accordion-item").removeClass("active").find(".timeline-accordion-content").slideUp();
            $currentItem.addClass("active");
            $content.stop(true, true).slideDown();
        }
    });

    // Add new sink row functionality
    $("#add-sink-row").click(function() {
        var rowCount = $("#sink-rows tr").length + 1;
        var newRow = '<tr class="sink-row">' +
            '<td align="center"><select name="compartments_' + rowCount + '" class="compartments"><option>1</option><option>2</option><option>3</option><option>4</option></select><strong>Compartments</strong></td>' +
            '<td><input type="number" class="clength compartment_field" name="length_' + rowCount + '" value="0" min="0"><span class="inches imperial" style="display: inline;">(inches)</span><span class="inches metric" style="display: none;">(mm)</span></td>' +
            '<td><input type="number" class="cwidth compartment_field" name="width_' + rowCount + '" value="0" min="0"><span class="inches imperial" style="display: inline;">(inches)</span><span class="inches metric" style="display: none;">(mm)</span></td>' +
            '<td><input type="number" class="cheight compartment_field" name="height_' + rowCount + '" value="0" min="0"><span class="inches imperial" style="display: inline;">(inches)</span><span class="inches metric" style="display: none;">(mm)</span></td>' +
            '<td><i class="fa fa-trash remove-sink" style="cursor: pointer; color: red;">&times;</i></td>' +
            '</tr>';
        $("#sink-rows").append(newRow);
        checkTrashIcon();
    });

    //Calculate Compartments Sink - Step 1
    function calculateTotal() {
        let total = 0;

        // Loop through each sink-row
        $('.sink-row').each(function () {
            // Get the values from the current row
            const compartments = parseFloat($(this).find('.compartments').val()) || 0;
            const length = parseFloat($(this).find('.clength').val()) || 0;
            const width = parseFloat($(this).find('.cwidth').val()) || 0;
            const height = parseFloat($(this).find('.cheight').val()) || 0;

            // Calculate the row result
            const rowResult = compartments * length * width * height * 0.75/231/2;

            // Add to the total
            total += rowResult;
        });

        console.log(total);

        // Render the total inside the #step-1-result div
        $('#step-1-result').attr('data-value',total);
        $('#step-1-result').text(total.toFixed(2) + ' GPM');
    }

    // Attach event listeners to input and select fields
    $(document).on('input', '.clength, .cwidth, .cheight', calculateTotal);
    $(document).on('change', '.compartments', calculateTotal);

    //Fixtures - Step 2
    // Constants for multipliers
    const multipliers = {
        floor_drains_num: 0.75,
        mop_sink_num: 3.75,
        hand_sink_num: 1.88,
        pre_sink_num: 3.75,
    };

    // Function to update row value and total
    function updateRowAndTotal() {
        let total = 0;

        // Loop through all rows
        $('.fixtures-rows tr').each(function () {
            const input = $(this).find('.fixtures_qty');
            const rowValueInput = $(this).find('.fixtures-input');
            const id = input.attr('id');
            const value = parseFloat(input.val());
            const multiplier = multipliers[id] || 0;
            // Calculate row value
            const rowValue = value * multiplier;

            // Update the row's value
            rowValueInput.val(rowValue.toFixed(2));

            // Add to total
            total += rowValue;
        });

        // Update the total result
        $('#step-2-result').attr('data-value', total);
        $('#step-2-result').text(total.toFixed(2)+ ' GPM');
    }

    // Event listener for increment and decrement buttons
    $('.increment_btn, .decrement_btn').on('click', function (e) {
        e.preventDefault();

        const isIncrement = $(this).hasClass('increment_btn');
        const inputId = $(this).data('input');
        const input = $(`#${inputId}`);
        const currentValue = parseInt(input.val()) || 0;

        // Update the input value
        const newValue = isIncrement ? currentValue + 1 : Math.max(0, currentValue - 1);
        input.val(newValue);

        // Update row and total
        updateRowAndTotal();
    });

    // Event listener for manual input changes
    $('.fixtures_qty').on('input', function () {
        const value = parseInt($(this).val()) || 0;
        if (value < 0) {
            $(this).val(0); // Reset to 0 if negative
        }
        updateRowAndTotal();
    });

    $('')

    //Dishwasher - Step 3
    $('select[name="b_dishwasher"]').on('change', function () {
        const isDishwasherConnected = $(this).val() === "1"; // Check if Yes is selected
        const dishwasherSection = $('.dishwasher-section');

        if (isDishwasherConnected) {
            dishwasherSection.show();
        } else {
            dishwasherSection.hide();
            $('#dishwasher').val(0).trigger('input'); // Reset dishwasher value to 0 and trigger change
        }
    });

    // Update step-3-result value based on the dishwasher input
    $('#dishwasher').on('input', function () {
        const dishwasherValue = parseFloat($(this).val()) || 0; // Get the dishwasher value, default to 0
        $('#step-3-result').attr('data-value', dishwasherValue) // Update the result div
        $('#step-3-result').text(dishwasherValue.toFixed(0) + ' GPM' ); // Update the result div
    });

    //Greaase Output - Step 4
    $('#restaurant_type,#tz-dish_type,#tz_fryer,.customers_per_day,#pumpouts').change(function() {
        var restaurantType = $('select[name="restaurant_type"]').val();
        var fryer = $('select[name="fryer"]').val();
        var dishType = $('select[name="dish_type"]').val();
        var pumpouts = parseInt($('select[name="pumpouts"]').val());
        var customersPerDay = parseInt($('select[name="customers_per_day"]').find('option:selected').val());

        // Ensure all required selections are made
        if (restaurantType && fryer && dishType && pumpouts && customersPerDay && restaurantType != '-1' && fryer != '-1' && dishType != '-1' && pumpouts != '-1' && customersPerDay != '-1' ) {
            // Get the coefficient based on restaurant type
            var combination = fryer+''+dishType;
            var coefficient = restaurantCoefficient[restaurantType][combination] || 0;

            // Calculate the result
            var result = coefficient * pumpouts * customersPerDay;
            $('#step-4-result').attr('data-value', result);
            $('#step-4-result').text(result.toFixed(2) + ' lbs' );
            $('#total_grease_output').text(result.toFixed(2) + ' lbs' );
            console.log(result)
        } else {
            console.log("Please select all fields to calculate the result.");
        }
    });

    // Initialize the visibility of the dishwasher section on page load
    if ($('select[name="b_dishwasher"]').val() === "1") {
        $('.dishwasher-section').show();
    } else {
        $('.dishwasher-section').hide();
    }



    // Remove sink row functionality
    $(document).on("click", ".remove-sink", function() {
        $(this).closest("tr").remove();
        checkTrashIcon();
        calculateTotal();
    });

    // Disable/Enable trash icon if only one row is left
    function checkTrashIcon() {
        var rowCount = $("#sink-rows tr").length;
        if (rowCount === 1) {
            $(".remove-sink").attr("disabled", true); // Disable trash icon for single row
        } else {
            $(".remove-sink").removeAttr("disabled"); // Enable trash icon for more than one row
        }
    }

    // Initial check on page load
    checkTrashIcon();

    // NEXT Button functionality (Step navigation)
    $(".next-step").click(function(e) {
        e.preventDefault();
        var nextStep = parseInt($(this).data("step")) + 1;


        $(".timeline-accordion-header-"+nextStep).trigger("click");
    });

    function calculateResult() {
        // Collect values from the DOM
        const gpm =
            Number($('#step-1-result').data('value') || 0) +
            Number($('#step-2-result').data('value') || 0) +
            Number($('#dishwasher').val() || 0);

        console.log(gpm,$('#step-1-result').data('value'),$('#step-2-result').data('value'),$('#step-3-result').data('value') )

        var restaurantType = $('select[name="restaurant_type"]').val();
        var fryer = $('select[name="fryer"]').val();
        var dishType = $('select[name="dish_type"]').val();
        var pumpouts = parseInt($('select[name="pumpouts"]').val());
        var customersPerDay = parseInt($('select[name="customers_per_day"]').find('option:selected').val());

        var greaseVolume = 0;

        if (restaurantType && fryer && dishType && pumpouts && customersPerDay && restaurantType != '-1' && fryer != '-1' && dishType != '-1' && pumpouts != '-1' && customersPerDay != '-1' ) {
            // Get the coefficient based on restaurant type
            var combination = fryer+''+dishType;
            var coefficient = restaurantCoefficient[restaurantType][combination] || 0;

            // Calculate the result
            var greaseVolume = coefficient * pumpouts * customersPerDay;
            console.log(coefficient,pumpouts,customersPerDay)
        } else {
            console.log("Please select all fields to calculate the result.");
        }

        const size = $('#size_metric').val();
        const groundType = $('#overground').is(':checked')
            ? 'Above'
            : 'Below';

        const ground_type_name = groundType == 'Below' ? 'In-Ground' : "Above-Ground";
        $('#step-5-result').text( ground_type_name + ', ' + size + '"' );

        $('#total_gpm_row').text( gpm.toFixed(2) + ' GPM' );
        $('#total_grease_output').text( greaseVolume.toFixed(2) + ' lbs' );
        $('#ground_type_row').text( ground_type_name);
        $('#size_row').text( size + '"' );

        // Check if all necessary inputs are provided
        if ( !gpm || !greaseVolume) {
            $('#result-wrapper').html('<p>Please fill in all required fields.</p>');
            return;
        }

        // Make the AJAX request
        $.ajax({
            url: params.ajax_url,
            type: 'POST',
            data: {
                action: 'calculate_sizing',
                gpm,
                grease_volume: greaseVolume,
                size,
                ground_type: groundType,
            },
            success: function (response) {
                var data = $.parseJSON(response);
                console.log(data)
                // Update the result
                if (data.success) {
                    const resultHtml = data.html;
                    $('#result-wrapper').empty().html(resultHtml);
                    $('#add_to_cart_all_form').attr('data-result', data.result);
                    $('#tzwrn-sizing-form').attr('style', 'display: block;');

                } else {
                    $('#result-wrapper').html('<p>No results</p>');
                }
            },
            error: function () {
                $('#result-wrapper').html('<p>An unexpected error occurred.</p>');
            },
        });
    }

    $('#reset_btn').on('click', function(){
        $('#step-1-result').attr('data-value', '0').html('');
        $('#step-2-result').attr('data-value', '0').html('');
        $('#step-3-result').attr('data-value', '0').html('');
        $('#step-4-result').attr('data-value', '0').html('');
        $('#dishwasher').val(0);
        $('.compartment_field').val('0');
        $('.fixtures-input').val('0');
        $('#total_gpm_row').html('');
        $('#total_grease_output').html('');
        $('#ground_type_row').html('');
        var $step1 = $('.timeline-accordion-header-1');
        var $content = $step1.next(".timeline-accordion-content");
        var $currentItem = $step1.closest(".timeline-accordion-item");
        $(".timeline-accordion-item").removeClass("active").find(".timeline-accordion-content").slideUp();
        $currentItem.addClass("active");
        $content.stop(true, true).slideDown();
        $('select[name="b_dishwasher"]').val(0);
        const dishwasherSection = $('.dishwasher-section');
        dishwasherSection.hide();
        $('#dishwasher').val(0); // Reset dishwasher value to 0 and trigger change
        $('#restaurant_type').val('-1');
        $('#tz_fryer').val('-1');
        $('#restaurant_type').val('-1');
        $('#restaurant_type').val('-1');
        $('#tz-dish_type').val('-1');
        $('#pumpouts').val('90');
        $('.customers_per_day').val('160');
        $('#underground').prop('checked', true);

        $('#result-wrapper').empty();

        //$(this).val($(this).find('option:first').val()
    })

    // Trigger calculation on relevant input changes
    $('#tz_fryer,#tz-dish_type, #size_metric, #overground, #underground, .calculate-step,.customers_per_day,#restaurant_type,#dishwasher').on('change input click', calculateResult);

    $("#send_pdf_button").on("click", function (e) {
        e.preventDefault();

        let projectName = $("#project_name").val();
        let email = $("#email_pdf").val();
        let compartments = [];
        let compartments_gpm =  $('#step-1-result').data('value');
        let floor_drains = $('#floor_drains_num').val();
        let floor_drains_gpm = $('input[name="floor_drains_gpm"]').val();
        let mop_sink_num = $('#mop_sink_num').val();
        let mop_sink_num_gpm = $('input[name="mop_sink_gpm"]').val();
        let hand_sink_num = $('#hand_sink_num').val();
        let hand_sink_num_gpm = $('input[name="hand_sink_gpm"]').val();
        let pre_sink_num = $('#pre_sink_num').val();
        let pre_sink_gpm_gpm = $('input[name="pre_sink_gpm"]').val();
        let dishwasher = $('#dishwasher').val();
        let grease = $('#total_grease_output').text();

        let restaurant_type = $("#restaurant_type option:selected").text();
        let customer_per_day = $(".customers_per_day option:selected").text();
        let fryer = $("#tz_fryer option:selected").text();
        let dish_type = $("#tz-dish_type option:selected").text();
        let pumpouts = $("#pumpouts option:selected").text();
        let size_metric = $("#size_metric").val();
        let drain_time = $("select[name='drain_time'] option:selected").text();
        let efficient = $("select[name='99efficient'] option:selected").text();
        let result = $("#add_to_cart_all_form").data('result');

        let groundType = $('#overground').is(':checked')
            ? 'Above'
            : 'Below';

        $(".sink-row").each(function () {
            let row = {
                compartments: $(this).find(".compartments").val(),
                length: $(this).find(".clength").val(),
                width: $(this).find(".cwidth").val(),
                height: $(this).find(".cheight").val(),
            };
            compartments.push(row);
        });

        $.ajax({
            type: "POST",
            url: params.ajax_url,
            data: {
                action: "generate_pdf",
                project_name: projectName,
                email: email,
                compartments: JSON.stringify(compartments),
                compartments_gpm,
                floor_drains,
                floor_drains_gpm,
                mop_sink_num,
                mop_sink_num_gpm,
                hand_sink_num,
                hand_sink_num_gpm,
                pre_sink_num,
                pre_sink_gpm_gpm,
                dishwasher,
                restaurant_type,
                customer_per_day,
                fryer,
                dish_type,
                pumpouts,
                grease,
                groundType,
                efficient,
                drain_time,
                size_metric,
                result

            },
            success: function (response) {
                if (response.success) {
                    alert(response.data.message);
                } else {
                    alert("Error: " + response.data.message);
                }
            },
            error: function () {
                alert("An error occurred.");
            }
        });
    });
});
