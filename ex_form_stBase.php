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

        <!-- Input field for the machine number -->
        <div id="machine_and_manual">
            <label for="machine_no"> <h4> Machine No.: </h4> </label>
            <input id="machine_no" type="number" name="machine_no" min="1" required="required">
        </div>
    </section>

    <div id="submittedForm">

    <table class="sheet">
        <tr>
            <th rowspan="2"> Date </th>
            <th colspan="2"> ST Base Assembly </th>
            <th colspan="3"> ST Make Ass'y </th>
            <th colspan="3"> ST Break Ass'y </th>
            <th colspan="2"> Base </th>
        </tr>
        <tr>
            <!-- Under ST Base Assembly -->
            <th> Operator's Name </th>
            <th  id="shiftContainer"> Shift </th>

            <!-- Under ST Make Ass'y -->
            <th> Lot No.</th>
            <th> Type </th>
            <th> Quantity </th>

            <!-- Under ST Break Ass'y -->
            <th> Lot No.</th>
            <th> Type </th>
            <th> Quantity </th>

            <!-- Under Base -->
            <th> Lot No.</th>
            <th> Quantity </th>
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
            <td rowspan="1";" class="expand"> <!-- name -->
            
                <input type="text" name="optr_name" id="optr_name"  required="required">
            </td>
            <td rowspan="1" class="expand" id="shifting"> <!-- shift -->
            </td> 
            
            <td rowspan="1" class="large expand"> 
                <input type="text" name="sma_lotNum"  required="required"> 
            </td> <!-- lot num -->
            
            <td rowspan="1" class="large expand"> 
                <input type="text" name="sma_type"  required="required"> 
            </td> <!-- type -->
            
            <td rowspan="1" class="expand"> 
                <input type="text" min="1" name="sma_quantity" class="number" required="required"> 
            </td> <!-- qty -->

            <td rowspan="1" class="large expand"> 
                <input type="text" name="sba_lotNum"  required="required"> 
            </td> <!-- lot num -->
            
            <td rowspan="1" class="large expand"> 
                <input type="text" name="sba_type"  required="required"> 
            </td> <!-- type -->
            
            <td rowspan="1" class="expand"> 
                <input type="text" min="1" name="sba_quantity" class="number" required="required"> 
            </td> <!-- qty -->
            
            <td> <input type="text" name="base_lotNum[]" required="required"> </td> <!-- base lot no -->
            <td> <input type="text" name="base_qty[]" required="required" class="number"> </td> <!-- base quantity --> 
            
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
                                "<input type='text' name='base_lotNum[]' placeholder=' base lot new field'> " + 
                            " </td> " + 
                            " <td> " + 
                                "<input type='text' name='base_qty[]' placeholder=' base qty new field'> " + 
                            " </td> " +
                         "</tr>";
            var rowspan = parseInt($('.expand').attr('rowspan')) + 1; //rowspan increments

            $('.expand').attr('rowspan', rowspan);
            $('.sheet tr:eq(-1)').after(newRow); //add new row at end

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

    