<?php

$message = '';

class userCalculationData
{
    public $a,$b,$operation,$result;
}

if (empty(isset($_POST))) {
    echo "Field empty";
    die();
}
if (!empty($_POST)) {

    $result = 0;
    $operation = $_POST['operation'];
    $a = $_POST['a'];
    $b = $_POST['b'];
    if ($operation === 'addition') {
        $result = $a + $b;
    } else if ($operation === 'subtraction') {
        $result = $a - $b;
    } else if ($operation === 'division') {
        $result = $a / $b;

    } else {
        $result = $a * $b;
    }
    echo $result;


    $inputData = new UserCalculationData();
    $inputData->a = $_POST['a'];
    $inputData->b = $_POST['b'];
    $inputData->operation = $_POST['operation'];
    $inputData->result = $result;

    $serializeInputData = serialize($inputData);
    $createFile = file_put_contents(time().'.txt', $serializeInputData);

    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial=1.0, shrinktofit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        body {
            width: 70%;
            margin: 0 auto;
        }

        .result {
            background-color: #88CC88;
        }

        tr {
            cursor: pointer;
        }

    </style>
</head>
<body>

<div id="alert">

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Previous submissions</h5>

            </div>
            <div class="modal-body">
                <p>Click on the rows below to populate table with that data.</p>
                <p id="helpMessage"  style="display: none;" >Table Populated!</p>
                <table id="previousSubmissions" class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">a</th>
                        <th scope="col">b</th>
                        <th scope="col">operation</th>
                        <th scope="col">result</th>
                    </tr>
                    </thead>
                    <tbody onclick="showMessage()">
                    <?php
                    foreach (glob("*.txt") as $filename) {

                        $fileData = file_get_contents($filename);
                        $unserializedInputData = unserialize($fileData);
                        ?>

                        <tr>
                            <th scope="row"><?= $filename ?></th>
                            <td><?= $unserializedInputData->a ?></td>
                            <td><?= $unserializedInputData->b ?></td>
                            <td><?= $unserializedInputData->operation ?></td>
                            <td><?= $unserializedInputData->result ?></td>
                        </tr>

                    <?php  } ?>



                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<form id="formCalculate" name="formCalculate" action="" method="post" class="form-group bg-light p-3 my-2">
    <div class="form-group">
        <label for="a">First number</label>
        <input type="number" class="form-control" name="a" id="a" aria-describedby="firstNumber"
               placeholder="Enter a number">
        <small class="form-text text-muted">Please enter a number to carry out an operation.</small>
    </div>
    <div class="form-group">
        <label for="b">Second number</label>
        <input type="number" class="form-control" name="b" id="b" aria-describedby="secondNumber"
               placeholder="Enter another number">
        <small class="form-text text-muted">Please enter a second number to carry out an operation.</small>
    </div>

    <div>
        <select name="operation" id="operation" class="form-control">
            <option selected>Select an operation</option>
            <option value="multiplication">Multiplication</option>
            <option value="division">Division</option>
            <option value="addition">Addition</option>
            <option value="subtraction">Subtraction</option>
        </select>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
        Previous submission
    </button>

</form>

<div class="form-group rounded p-3 result">
    <label class="p-2" for="result">Result</label>
    <input type="text" class="form-control" name="result" id="result" aria-describedby="result" value="" readonly>
    <small id="result" class="form-text text-muted">Your result will appear here.</small>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<!--Axios-->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>

    function showMessage(){
        document.getElementById('helpMessage').style.display = 'block';
        setTimeout(function(){document.getElementById('helpMessage').style.display = 'none'; }, 1000);
    }

    $('#previousSubmissions tr').click(function (e) {
        console.log(e.target)

        $(this).children("td").each(function (index) {
            if (index === 0) $('#a').val(this.innerText);
            if (index === 1) $('#b').val(this.innerText);
            if (index === 2) $('#operation').val(this.innerText);
        })

    })


    document.querySelector('#formCalculate').addEventListener('submit', calculate)

    function calculate(e) {
        e.preventDefault();

        let a = document.getElementById('a');
        let b = document.getElementById('b');
        let operation = document.getElementById("operation");
        console.log(a.value);
        console.log(b.value);
        console.log(operation.value);

        let formData = new FormData();
        formData.append('a', a.value);
        formData.append('b', b.value);
        formData.append('operation', operation.value);

        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.post('http://localhost/exercises/week-03/workbook/math.php', formData)
            .then(function (response) {
                console.log(response.data);
                document.getElementById('result').value = response.data;

                $('<div>').addClass('alert alert-light').text('File created successfully').appendTo('#alert');
                setTimeout(function(){document.getElementById('alert').style.display = 'none'; }, 2000);


                if (response.data.length === 0) {
                    $('<div>').addClass('alert alert-danger').text('An error occured. Check axios response.').appendTo('#alert');
                }
            })
            .catch(function (error) {
                console.log('AXIOS ERROR' + error);
            })
        return false;
    }


</script>

</body>
</html>
