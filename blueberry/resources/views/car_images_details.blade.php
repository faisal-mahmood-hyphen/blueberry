<x-app-layout :active="$active" :breadCrumbs="$breadCrumbs">
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Car Images Details</h3>
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <img src="{{ asset('storage/images/car-images/' . $carImage->image) }}" alt="Car Image"
                                         width="500">
                                </div>
                                <div class="col-md-5">
                                    <h3>{{ $carImage['alt_text'] }}</h3>
                                    <p><strong>Make primary:</strong> {{ $carImage['make_primary'] }}</p>
                                    <p><strong>Created At:</strong> {{ $carImage->created_at->format('d F, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Alt Text:</strong><br> {{ $carImage['alt_text'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
