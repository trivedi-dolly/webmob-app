@include('welcome')

<div class="card user-register">
    <div class="card-body">
        <h3 class="card-title">Send Jokes Form</h3>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('send-jokes') }}">
            @csrf
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Enter Your Name" name="name">
                </div>
                <div class="col">
                    <input type="email" class="form-control" placeholder="Enter Your Email" name="email">
                </div>
            </div><br>
            <div class="form-row">
                <div class="col">
                    <label>Start Time</label>
                    <input type="time" class="form-control" name="start_time">
                </div>
                <div class="col">
                    <label>End Time</label>
                    <input type="time" class="form-control" name="end_time">
                </div>
                <div class="col">
                    <label>Enter Number of Jokes</label>
                    <input type="number" class="form-control" name="jokes_no" min="1" value="1">
                </div>
            </div><br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>