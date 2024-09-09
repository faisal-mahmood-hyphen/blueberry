<x-app-layout :active="$active" :breadCrumbs="$breadCrumbs">
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Car Details</h3>
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <img src="{{ asset('storage/images/cars/' . $car->image) }}" alt="Car Image"
                                         width="500">
                                </div>
                                <div class="col-md-5">
                                    <h3>{{ $car['title'] }}</h3>
                                    <p><strong>Year:</strong> {{ $car['year'] }}</p>
                                    <p><strong>Mileage:</strong> {{ $car['mileage'] }}</p>
                                    <p><strong>Price:</strong> ${{ $car['price'] }}</p>
                                    <p><strong>Phone:</strong> {{ $car['phone'] }}</p>
                                    <p><strong>Created At:</strong> {{ $car->created_at->format('d F, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Description:</strong><br> {{ $car['description'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
