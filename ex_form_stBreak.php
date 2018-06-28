    <!-- This section is the set of buttons, and functions that can be found on top on the table form -->
    <section class="above_table">
        <!-- Asks the user to select a month and year. When the search button is clicked, it will display all the transactions on the said date -->
        <div id="date_and_year">
            <label for="ImageButton">Please select Month & Year</label>
            <p>
                <input id="ImageButton" name='selected_date' type="text" />
                <button type="submit" class="formBtn btn btn-primary" name='select_lot'> Search </button>
                <input type='hidden' name='process' value='<?php echo $process;?>'>
            </p>
        </div>
        
        <!-- Buttons used for adding and deleting a table row -->
        <div id="buttons">
            <button type="button" id="addRow" class="formBtn btn btn-info"> Add Row </button>
            <button type="button" id="delRow" class="formBtn btn btn-danger"> Delete Row </button>
        </div>
    </section>

    <div id="submittedForm">

    <table class="sheet">
        <tr>
            <th rowspan="2"> Date </th>
            <th rowspan="2"> Operator Name </th>
            <th rowspan="2" id="shiftContainer"> Shift </th>
            <th colspan="3"> Output </th>
            <th colspan="5"> Supplied Materials </th>
        </tr>
        <tr>
            <!-- Under Output -->
            <th> Relay Type </th>
            <th> Lot No. </th>
            <th> Quantity </th>

            <!-- Under Supplied Materials -->
            <th> ST Term. Lot No. </th>
            <th> ST Term. Qty </th>
            <th> Break C.P Lot No. </th>
            <th> Break C.P Bag No. </th>
            <th> Break C.P Qty </th>
        </tr>
        <tr class="newRow">
            <td rowspan="1" class="expand"> <!-- date -->
                <!-- Gets the system date and returns it to the page -->
                <?php
                    $date = date("m-d-Y");
                    echo "<p>" . $date . "</p>"; 
                ?> 
                <input type="hidden" name="date" value="<?php echo $date; ?>">
            </td> 
            <td rowspan="1" class="expand"> <!-- name -->
            
                <input type="text" name="optr_name" id="optr_name" required="required">
            </td>
            <td rowspan="1" class="expand" id="shifting"> <!-- shift -->
            </td> 
            
            <td rowspan="1" class="large expand"> 
                <input type="text" name="relay_type" required="required"> 
            </td> <!-- relay type -->
            
            <td rowspan="1" class="large expand"> 
                <input type="text" name="lotNum" required="required"> 
            </td> <!-- lot no -->
            
            <td rowspan="1" class="expand smaller"> 
                <input type="text" min="1" name="quantity" class="number" required="required"> 
            </td> <!-- qty -->
            
            <td> <input type="text" name="stBreak_lotNum[]" required="required"> </td> <!-- st break lot no -->
            <td class="smaller"> <input type="text" class="number" name="stBreak_qty[]" required="required"> </td> <!-- st break qty --> 
            <td> <input type="text" name="bcp_lotNum[]" required="required"> </td> <!-- break cp lot no -->
            <td class="smaller"> <input type="text" class="number" name="bcp_bagNum[]" required="required"> </td> <!-- break cp bag no --> 
            <td class="smaller"> <input type="text" class="number" name="bcp_qty[]" required="required"> </td> <!-- break cp qty -->           
        </tr>
    </table>
    </div> <!-- end of submittedForm -->

    <script>
        // ==========================================| AUTO RELOAD SHIFT FIELD |==========================================
        // This loads the 'shifting.php' file to the '#shifting' <td>, this is done every one second to automatically determine the shifting schedule.
        var auto_refresh = setInterval( function() {
                $('#shifting').load('shifting.php').fadeIn('slow');
        }, 1000);

        // ===========================================| ADD ROW |===========================================
        $('#addRow').click (function () {
            var newRow = "<tr class='newRow'>" + 
                            " <td> " + 
                                "<input type='text' name='stBreak_lotNum[]' placeholder='ST Break Lot #'> " + 
                            " </td> " + 
                            " <td> " + 
                                "<input type='text' class='number' name='stBreak_qty[]' placeholder='ST Break Qty'> " + 
                            " </td> " +
                            " <td> " + 
                                "<input type='text' name='bcp_lotNum[]' placeholder='BCP Lot #'> " + 
                            " </td> " +
                            " <td> " + 
                                "<input type='text' class='number' name='bcp_bagNum[]' placeholder='BCP Bag #'> " + 
                            " </td> " +
                            " <td> " + 
                                "<input type='text' class='number' name='bcp_qty[]' placeholder='BCP Qty'> " + 
                            " </td> " +
                         "</tr>";
            var rowspan = parseInt($('.expand').attr('rowspan')) + 1; //rowspan increments

            $('.expand').attr('rowspan', rowspan);
            $('.sheet tr:eq(-1)').after(newRow); //add new row at end

            // add commas for added rows
            $('input.number').keyup(function(event) {

                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function(index, value) {
                    return value.replace (/\D/g, "").replace (/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });
        });

        // ===========================================| DELETE ROW |===========================================
        $('#delRow').on('click', function() {
            var lenRow = $('.sheet tr.newRow').length;
            if (lenRow == 1 || lenRow <= 1) {

                swal({
                    title: "Oops...",
                    text: "Can't remove all rows!",
                    type: "error"
                });

            } else {
                $('.sheet tr.newRow:last').remove();
            }
        }); 

        // ===========================================| ADD COMMAS |===========================================
        $('input.number').keyup(function(event) {
            // alert('working');

            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40) return;

            // format number
            $(this).val(function(index, value) {
                return value.replace (/\D/g, "").replace (/\B(?=(\d{3})+(?!\d))/g, ",");
            });
        });
    </script>

    