<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Events</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<body>
<br>
<br>
<br>

<div class="container">

    <div class="row">

        <div class="col-sm-4">
           <form action="/search" method="get">
               <div class="input-group">
                   <input type="search" name="search" class="form-control">
                   <span class="input-group-prepend"></span>
                        <button type="submit" class="btn btn-primary">Search</button>
               </div>
           </form>
        </div>
    </div>
    <div role="group" aria-label="Basic example"  class="btn btn-dark">
        <a href="{{ route('events.index')}}"><button class="btn btn-dark">Events</button></a>
        <a href="{{ route('menus.index')}}"><button class="btn btn-dark">Menus</button></a>
        <a href="/eitems"><button class="btn btn-dark">Event Items</button></a>
        <a href="/estaff"><button class="btn btn-dark">Manage Staff</button></a>
        <a href="/ereport"><button  class="btn btn-dark">Report</button></a>

    </div>



    <!--MAIN SECTION-->


    <div class="row">
        <div class="col-sm-12">
            <center><h2 >Event Report</h2></center>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Event Manager</th>
                    <th>No of guests attended</th>
                    <th>Cost</th>

                    <th>e_Total</th>
                    <th>b_Total</th>
                    <th>Actions</th>


                </tr>


                </thead>
                <tbody>
                @foreach($eventreport as $report)
                    <tr>
                        <td>{{$report->id}}</td>
                        <td>{{$report->customer_name}}</td>
                        <td>{{$report->event_date}}</td>
                        <td>{{$report->event_time}}</td>
                        <td>{{$report->event_manager}}</td>
                        <td>{{$report->attendence}}</td>
                        <td>{{$report->cost}}</td>
                        <td>{{$report->etotal}}</td>
                        <td>{{$report->btotal}}</td>

                        <td>
                            <a href="{{ route('ereport.edit', $report->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>

                                <form action="{{ route('ereport.destroy', $report->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
            </div>
            <!--MAIN SECTION-->

            <div>
                <a style="margin: 19px;" href="{{ route('ereport.create')}}" class="btn btn-primary">New Event Report</a>
            </div>

        </div>

    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
