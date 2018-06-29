<!DOCTYPE html>
<html>

<head>
    <title> EX Relay Assembly </title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <link href="../datepicker/smooth_theme.css" rel="stylesheet" type="text/css" />


    <link href="../datepicker/MonthPicker.min.css" rel="stylesheet" type="text/css" />
    <script src="../datepicker/jquery-1.12.1.js"></script>
    <script src="../datepicker/jquery-1.11.4.js"></script>
    <script src="../datepicker/maskedinput.js"></script>

    <script src="../datepicker/MonthPicker.min.js"></script>
    <script src="../datepicker/examples.js"></script>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <script src="../jquery/bootstrap.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/assyTrial.css">
    <script src="../jquery/sweetalert.js"></script>
</head>

<body>
    <?php 
        //define root folder
        $root = ($_SERVER['DOCUMENT_ROOT']);
        //call header page
        include($root.'/developmental/jc/Lot History System TRIAL/global/header_page.php');

        //=====================================| SHOW LINE NUMBER AND PROCESS |=====================================
        $lineNum = $_POST['ex_line'];
        $process = $_POST['ex_line_process'];

        echo "<h2>" . "You are about to enter new data for: EX Line # " . $lineNum . " &rarr; " . $process . "</h2>";

        //This uses the 'process' variable in a switch statement. If the process matches its case then the code inside it will execute. But if the process does not match any of the cases, it will return the default case. Every case has its respective 'include' that will link the php file to its case.
        switch ($process) {
            case 'Armature Assembly':
                echo "<div id='date_and_year'>";
                echo "<form action='ex_armature_search.php' method='POST'>";
                echo "<label for='ImageButton'>Please select Month & Year</label>";
                echo "<p>";
                echo "<input id='ImageButton' name='selected_date' type='text' />";
                echo "<button type='submit' class='formBtn btn btn-primary' name='select_lot'> Search </button>";
                echo "</p>";
                echo "</form>";
                echo "</div>";

                echo "<form id='formSubmit'>";

                include 'ex_form_armature.php';


                echo "<button id='submitBtn' type='submit' class='formBtn btn btn-success btn-lg' name='submit'> Submit </button>";
                echo "</form>";

                echo "<div id='showDebug'>";
                echo "</div>";
                break;

            case 'M&A Assembly':
                echo "<form id='formSubmit'>";
                include 'ex_form_ma.php';


                echo "<button id='submitBtn' type='submit' class='formBtn btn btn-success btn-lg' name='submit'> Submit </button>";
                echo "</form>";

                echo "<div id='showDebug'>";
                echo "</div>";
                break;
            
            case 'ST Break Terminal Assembly':
                echo "<form id='formSubmit'>";
                include 'ex_form_stBreak.php';


                echo "<button id='submitBtn' type='submit' class='formBtn btn btn-success btn-lg' name='submit'> Submit </button>";
                echo "</form>";

                echo "<div id='showDebug'>";
                echo "</div>";
                break;

            case 'ST Make Terminal Assembly':
                echo "<form id='formSubmit'>";
                include 'ex_form_stMake.php';


                echo "<button id='submitBtn' type='submit' class='formBtn btn btn-success btn-lg' name='submit'> Submit </button>";
                echo "</form>";

                echo "<div id='showDebug'>";
                echo "</div>";
                break;

            case 'ST Base Assembly':
                echo "<form id='formSubmit'>";
                include 'ex_form_stBase.php';


                echo "<button id='submitBtn' type='submit' class='formBtn btn btn-success btn-lg' name='submit'> Submit </button>";
                echo "</form>";

                echo "<div id='showDebug'>";
                echo "</div>";
                break;

            default:
                echo "No form yet :(";
                break;
        }
     ?>

    <!-- This prompts the user to confirm after clicking the submit button. if yes, the data will be collected, the ex_form_toDB.php file will be accessed, and then output will show in the page.-->
    <script>
        $('.submittedRecord').load('submittedRecord.php').fadeIn('slow');

        $(document).ready (function () {
            $('#formSubmit').on('submit', function (e) {
                event.preventDefault();
                swal ({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, submit!'
                }).then((result) => {
                    if (result.value) {
                        
                        var dataString = $('#formSubmit');

                        var x = document.getElementsByTagName('input');
                        for (var i = 1; i < x.length; i++) {
                            if (x[i].value == null || x[i].value == "") {
                                x[i].disabled = true;
                                x[i].parentElement.style.visibility = 'hidden';
                            }
                        }

                        $.ajax({
                            url: 'ex_form_toDB.php',
                            type: 'POST',
                            data: dataString.serialize(),
                            success: function(data) {
                                swal ({
                                    title: 'Great!',
                                    text: 'Record has been submitted.',
                                    type: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                
                                // $('.submittedRecord').load('submittedRecord.php').fadeIn('slow');
                                setTimeout(location.reload.bind(location),1500);

                                $('#showDebug').html(data);

                            }
                        });
                    }
                });
            });
        });
    </script>

</body>
</html>
