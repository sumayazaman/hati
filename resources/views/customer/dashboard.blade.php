<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hello Customer</div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <th>{{ $order->name}}</th>
                                        <td>{{ $order->phone}}</td>
                                        <td>
                                            <a href="{{ route('home.invoice', $order->id) }}">Download Invoice</a>
                                        </td>
                                    </tr>                                    
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>