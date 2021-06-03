<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Create deal</title>
</head>
<body>

<div class="container">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row" style="justify-content: center;">
        <div class="col-12">
            <form action="{{ route('add_deal') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <h3>Create deal</h3>

                        <div class="form-group">
                            <label for="deal_name">Deal Name</label>
                            <input type="text" class="form-control" id="deal_name" placeholder="" name="Deal_Name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="account_name">Account Name</label>
                            <input type="text" class="form-control" id="account_name" placeholder="" name="Account_Name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="closing_Date">Closing Date</label>
                            <input type="date" class="form-control" id="closing_Date" placeholder="" name="Closing_Date"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="stage">Stage</label>
                            <select class="form-control" id="stage" name="Stage" required>
                                <option>Needs Analysis</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description of deal</label>
                            <textarea class="form-control" id="description" rows="3" name="Description"></textarea>
                        </div>

                    </div>
                    <div class="col-6">
                        <h3>Create task</h3>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" placeholder="" name="Subject"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="Due_Date">Due Date</label>
                            <input type="date" class="form-control" id="Due_Date" placeholder="" name="Due_Date"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="Priority">Priority</label>
                            <select class="form-control" id="Priority" name="Priority" required>
                                <option>Normal</option>
                                <option>High</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description of task</label>
                            <textarea class="form-control" id="description" rows="3" name="Description"></textarea>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>
