<x-app-layout :active="$active" :breadCrumbs="$breadCrumbs">
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Property Images Details</h3>
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <img src="{{ asset('storage/images/property-images/' . $propertyImage->image) }}" alt="Property Image"
                                         width="500">
                                </div>
                                <div class="col-md-5">
                                    <h3>{{ $propertyImage['alt_text'] }}</h3>
                                    <p><strong>Make primary:</strong> {{ $propertyImage['make_primary'] }}</p>
                                    <p><strong>Created At:</strong> {{ $propertyImage->created_at->format('d F, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Alt Text:</strong><br> {{ $propertyImage['alt_text'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
