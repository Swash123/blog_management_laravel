<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @extends('../layout/master')
    @section('content')
    <section>
        <div class="container dashboard mx-sm-none">
            <div class="row">
                <div class="col-md-6 col-lg-4 col-sm-12">
                    <div class="card order-card">
                        <div class="card-block">
                            <h5 class="m-b-20">Daily Visits</h5>
                            <h2 class="text-right"><span>486</span></h2>
                        </div>
                    </div>
                </div>

    
                <div class="col-md-6 col-lg-4 col-sm-12">
                    <div class="card order-card">
                        <div class="card-block">
                            <h5 class="m-b-20">Blogs liked</h5>
                            <h2 class="text-right"><span>486</span></h2>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-6 col-lg-4 col-sm-12">
                    <div class="card order-card">
                        <div class="card-block">
                            <h5 class="m-b-20">Blogs this month</h5>
                            <h2 class="text-right"><span>486</span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
</body>
</html>