<x-app-layout :active="$active" :breadCrumbs="$breadCrumbs">
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ ucwords(end($breadCrumbs)['name']) }}</h3>
                        @if(hasPermissions($permissions,'add-new-car'))
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-model">
                                Add New {{ Str::singular(ucwords(end($breadCrumbs)['name'])) }}
                            </button>
                        @endif
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Mileage in Km</th>
                                <th>Year</th>
                                <th>Created At</th>
                                <th class="no-sort">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Mileage in Km</th>
                                <th>Year</th>
                                <th>Created At</th>
                                <th class="no-sort">Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        @if(hasPermissions($permissions,'add-new-car'))
            <div class="modal fade" id="add-model">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New {{ Str::singular(ucwords(end($breadCrumbs)['name'])) }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="add-form">
                                <div class="card-body">
                                    {{--Add  Title and Regional Specs--}}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="purpose" class="col-sm-12 col-form-label">Property
                                                    Purpose</label>
                                                <div class="col-sm-12">
                                                    <select id="purpose" name="purpose" class="form-control">
                                                        @foreach($carPurposes as $carPurpose)
                                                            <option value="{{ $carPurpose }}">{{ $carPurpose }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors purpose"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="title" class="col-sm-12 col-form-label">Title</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="title" name="title"
                                                           placeholder="Title"/>
                                                    <span class="text-danger errors title"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="view_360_url" class="col-sm-12 col-form-label">View 360
                                                    URL</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="view_360_url"
                                                           name="view_360_url"
                                                           placeholder="View 360 URL(Optional)"/>
                                                    <span class="text-danger errors view_360_url"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="regional_specs" class="col-sm-12 col-form-label">Regional
                                                    Specs</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="regional_specs"
                                                            name="regional_specs">
                                                        <option value="">Select Regional Specs</option>
                                                        <option value="GCC Specs">GCC Specs</option>
                                                        <option value="American Specs">American Specs</option>
                                                        <option value="Canadian Specs">Canadian Specs</option>
                                                        <option value="European Specs">European Specs</option>
                                                        <option value="Japanese Specs">Japanese Specs</option>
                                                        <option value="Korean Specs">Korean Specs</option>
                                                        <option value="Chinese Specs">Chinese Specs</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                    <span class="text-danger errors regional_specs"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Add   Brand, Model and Trim--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="brand_id" class="col-sm-12 col-form-label">Brand</label>
                                                <div class="col-sm-12">
                                                    <select id="brand_id" name="brand_id" class="form-control">
                                                        <option value="">Select Brand</option>
                                                        @foreach($brands as $brand)
                                                            <option
                                                                value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors brand_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="model_id"
                                                       class="col-sm-12 col-form-label">Model</label>
                                                <div class="col-sm-12">
                                                    <select id="model_id" name="model_id" class="form-control">
                                                        <option value="">Select Model</option>
                                                    </select>
                                                    <span class="text-danger errors model_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="trim_id"
                                                       class="col-sm-12 col-form-label">Trim</label>
                                                <div class="col-sm-12">
                                                    <select id="trim_id" name="trim_id" class="form-control">
                                                        <option value="">Select Trim</option>
                                                    </select>
                                                    <span class="text-danger errors trim_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Add   Country, State and Cities--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="country_id" class="col-sm-12 col-form-label">Country</label>
                                                <div class="col-sm-12">
                                                    <select id="country_id" name="country_id" class="form-control">
                                                        <option value="">Select Country</option>
                                                        @foreach($countries as $country)
                                                            <option
                                                                value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors country_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="state_id"
                                                       class="col-sm-12 col-form-label">State</label>
                                                <div class="col-sm-12">
                                                    <select id="state_id" name="state_id" class="form-control">
                                                        <option value="">Select State</option>
                                                    </select>
                                                    <span class="text-danger errors state_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="city_id"
                                                       class="col-sm-12 col-form-label">City</label>
                                                <div class="col-sm-12">
                                                    <select id="city_id" name="city_id" class="form-control">
                                                        <option value="">Select City</option>
                                                    </select>
                                                    <span class="text-danger errors city_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Add   Phone Number, Year and Milage--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-12 col-form-label">Phone Number</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                           placeholder="Phone Number"/>
                                                    <span class="text-danger errors phone"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="year" class="col-sm-12 col-form-label">Year</label>
                                                <div class="col-sm-12">
                                                    <input type="number"
                                                           id="year"
                                                           name="year"
                                                           min="1900"
                                                           max="2099"
                                                           class="form-control"
                                                           placeholder="Year"/>
                                                    <span class="text-danger errors year"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="title" class="col-sm-12 col-form-label">Mileage in
                                                    Km</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" id="mileage"
                                                           name="mileage"
                                                           placeholder="Mileage"/>
                                                    <span class="text-danger errors mileage"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Add  Price, Warranty and Is Your Car Insured --}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="price" class="col-sm-12 col-form-label">Price</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" id="price" name="price"
                                                           placeholder="Price"/>
                                                    <span class="text-danger errors price"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="warranty" class="col-sm-12 col-form-label">Warranty</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="warranty" name="warranty">
                                                        <option value="" selected="selected">Select Warranty</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="Does not apply">Does not apply</option>
                                                    </select>
                                                    <span class="text-danger errors warranty"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="is_car_insured" class="col-sm-12 col-form-label">Is Your Car
                                                    Insured</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="is_car_insured"
                                                            name="is_car_insured">
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                    <span class="text-danger errors is_car_insured"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Add  Fuel Type Specs, Body condition Specs and Mechanical condition Specs --}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="fuel_type" class="col-sm-12 col-form-label">Fuel Type
                                                    Specs</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="fuel_type"
                                                            name="fuel_type">
                                                        <option value="">Select Fuel Type</option>
                                                        <option value="Petrol">Petrol</option>
                                                        <option value="Diesel">Diesel</option>
                                                        <option value="Hybrid">Hybrid</option>
                                                        <option value="Electric">Electric</option>
                                                    </select>
                                                    <span class="text-danger errors fuel_type"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="body_condition" class="col-sm-12 col-form-label">Body
                                                    condition
                                                    Specs</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="body_condition"
                                                            name="body_condition">
                                                        <option value="">Body condition</option>
                                                        <option value="Perfect inside and out">Perfect inside and out
                                                        </option>
                                                        <option value="No accidents, very few faults">No accidents, very
                                                            few faults
                                                        </option>
                                                        <option value="A bit of wear and tear, all repaired">A bit of
                                                            wear &amp; tear, all repaired
                                                        </option>
                                                        <option value="Normal wear and tear, a few issues">Normal wear
                                                            &amp; tear, a few issues
                                                        </option>
                                                        <option value="Lots of wear and tear to the body">Lots of wear
                                                            &amp; tear to the body
                                                        </option>
                                                    </select>
                                                    <span class="text-danger errors body_condition"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="mechanical_condition" class="col-sm-12 col-form-label">Mechanical
                                                    condition
                                                    Specs</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="mechanical_condition"
                                                            name="mechanical_condition">
                                                        <option value="" selected="selected">Mechanical condition
                                                        </option>
                                                        <option value="Perfect inside and out">Perfect inside and out
                                                        </option>
                                                        <option value="Minor faults, all fixed">Minor faults, all
                                                            fixed
                                                        </option>
                                                        <option value="Major faults, all fixed">Major faults, all
                                                            fixed
                                                        </option>
                                                        <option value="Major faults fixed, small remain">Major faults
                                                            fixed, small remain
                                                        </option>
                                                        <option value="Ongoing minor &amp; major faults">Ongoing minor
                                                            &amp; major faults
                                                        </option>
                                                    </select>
                                                    <span class="text-danger errors mechanical_condition"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Add Seating Capsity, Horse Power and Engine Capasity--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="seating_capacity" class="col-sm-12 col-form-label">Seating Capacity</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="seating_capacity" name="seating_capacity">
                                                        <option value="">Select Seating Capacity</option>
                                                        <option value="2">2</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="8">8</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                    <span class="text-danger errors seating_capacity"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="horse_power" class="col-sm-12 col-form-label">Horse Power</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="horse_power"
                                                            name="horse_power">
                                                        <option value="100 - 200 HP">100 - 200 HP</option>
                                                        <option value="200 - 300 HP">200 - 300 HP</option>
                                                        <option value="300 - 400 HP">300 - 400 HP</option>
                                                        <option value="400 - 500 HP">400 - 500 HP</option>
                                                        <option value="500 - 600 HP">500 - 600 HP</option>
                                                        <option value="600 - 700 HP">600 - 700 HP</option>
                                                        <option value="700 - 800 HP">700 - 800 HP</option>
                                                        <option value="800 - 900 HP">800 - 900 HP</option>
                                                        <option value="900+ HP">900+ HP</option>
                                                        <option value="Unknown">Unknown</option>
                                                    </select>
                                                    <span class="text-danger errors horse_power"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="engine_capacity" class="col-sm-12 col-form-label">Engine Capacity</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="engine_capacity"
                                                            name="engine_capacity">
                                                        <option value="" >Engine Capacity (cc)</option>
                                                        <option value="0 - 500 cc">0 - 500 cc</option>
                                                        <option value="500 - 1000 cc">500 - 1000 cc</option>
                                                        <option value="1000 - 1500 cc">1000 - 1500 cc</option>
                                                        <option value="1500 - 2000 cc">1500 - 2000 cc</option>
                                                        <option value="2000 - 2500 cc">2000 - 2500 cc</option>
                                                        <option value="2500 - 3000 cc">2500 - 3000 cc</option>
                                                        <option value="3000 - 3500 cc">3000 - 3500 cc</option>
                                                        <option value="3500 - 4000 cc">3500 - 4000 cc</option>
                                                        <option value="4000+ cc">4000+ cc</option>
                                                        <option value="Unknown">Unknown</option>
                                                    </select>
                                                    <span class="text-danger errors engine_capacity"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Add   Description--}}
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="description"
                                                       class="col-sm-12 col-form-label">Description</label>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" id="description" name="description"
                                                              rows="5"
                                                              placeholder="Description"></textarea>
                                                    <span class="text-danger errors description"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Add   Colours and Doors--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="exterior_color" class="col-sm-12 col-form-label">Exterior
                                                    Colour</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="exterior_color"
                                                            name="exterior_color">
                                                        <option value="" selected="selected">Exterior Color</option>
                                                        <option value="Black">Black</option>
                                                        <option value="Blue">Blue</option>
                                                        <option value="Brown">Brown</option>
                                                        <option value="Burgundy">Burgundy</option>
                                                        <option value="Gold">Gold</option>
                                                        <option value="Grey">Grey</option>
                                                        <option value="Orange">Orange</option>
                                                        <option value="Green">Green</option>
                                                        <option value="Purple">Purple</option>
                                                        <option value="Red">Red</option>
                                                        <option value="Silver">Silver</option>
                                                        <option value="Beige">Beige</option>
                                                        <option value="Tan">Tan</option>
                                                        <option value="Teal">Teal</option>
                                                        <option value="White">White</option>
                                                        <option value="Yellow">Yellow</option>
                                                        <option value="Other Color">Other Color</option>
                                                    </select>
                                                    <span class="text-danger errors exterior_color"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="interior_color" class="col-sm-12 col-form-label">Interior
                                                    Colour</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="interior_color"
                                                            name="interior_color">
                                                        <option value="" selected="selected">Interior Color</option>
                                                        <option value="Beige">Beige</option>
                                                        <option value="Black">Black</option>
                                                        <option value="Blue">Blue</option>
                                                        <option value="Brown">Brown</option>
                                                        <option value="Green">Green</option>
                                                        <option value="Grey">Grey</option>
                                                        <option value="Orange">Orange</option>
                                                        <option value="Red">Red</option>
                                                        <option value="Tan">Tan</option>
                                                        <option value="White">White</option>
                                                        <option value="Yellow">Yellow</option>
                                                        <option value="Other Color">Other Color</option>
                                                    </select>
                                                    <span class="text-danger errors interior_color"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="doors" class="col-sm-12 col-form-label">Doors</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="doors"
                                                            name="doors">
                                                        <option value="" selected="selected">Doors</option>
                                                        <option value="2">2 door</option>
                                                        <option value="3">3 door</option>
                                                        <option value="4">4 door</option>
                                                        <option value="5">5+ doors</option>
                                                    </select>
                                                    <span class="text-danger errors doors"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{---Add   No Of Cylinders, Transmission Type and Body Type--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="cylinders" class="col-sm-12 col-form-label">No Of
                                                    Cylinders</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id=cylinders"
                                                            name="cylinders">
                                                        <option value="" selected="selected">Select No Of Cylinders
                                                        </option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="8">8</option>
                                                        <option value="10">10</option>
                                                        <option value="12">12</option>
                                                        <option value="0">Unknown</option>
                                                    </select>
                                                    <span class="text-danger errors cylinders"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="transmission_type" class="col-sm-12 col-form-label">Transmission
                                                    Type</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id=transmission_type"
                                                            name="transmission_type">
                                                        <option value="" selected="selected">Select Transmission Type
                                                        </option>
                                                        <option value="Manual Transmission">Manual Transmission</option>
                                                        <option value="Automatic Transmission">Automatic Transmission
                                                        </option>
                                                    </select>
                                                    <span class="text-danger errors transmission_type"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="body_type_id" class="col-sm-12 col-form-label">Body Type</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id=body_type_id"
                                                            name="body_type_id">
                                                        <option value="" selected="selected">Select Body Type</option>
                                                        @foreach($bodyTypes as $bodyType)
                                                            <option
                                                                value="{{ $bodyType->id }}">{{ $bodyType->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors body_type_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Add  Images--}}
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-form-label">Image</label>
                                                <div class="col-sm-12">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="image"
                                                               name="image">
                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                    </div>
                                                    <span class="text-danger errors image"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Add Extra Vehicle Features--}}
                                    <div class="row">
                                        <span class="h3 text-center m-1 text-bold">Select Extra Features Of Vehicle</span>
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                @foreach($features as $feature)
                                                    <div class="col-sm-3">
                                                        <label>
                                                            <input type="checkbox" name="{{ strtolower(str_replace(' ', '_', str_replace('/', '_',$feature))) }}" value="1"> {{ $feature }}
                                                        </label>
                                                    </div>
                                                <span class="text-danger errors {{ $feature }}"></span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="add-button">Add</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <input type="hidden" id="state-id-hide" value=""/>
            <input type="hidden" id="city-id-hide" value=""/>
            <input type="hidden" id="model-id-hide" value=""/>
            <input type="hidden" id="trim-id-hide" value=""/>
        @endif
        @if(hasPermissions($permissions,'edit-car'))
            <div class="modal fade" id="edit-model">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit {{ Str::singular(ucwords(end($breadCrumbs)['name'])) }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="edit-form">
                                <input type="hidden" name="id" id="id" value="">
                                <div class="card-body">
                                    {{--Edit    Title, View Tour 360 URL and Regional Specs--}}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="purpose-edit" class="col-sm-12 col-form-label">Property
                                                    Purpose</label>
                                                <div class="col-sm-12">
                                                    <select id="purpose-edit" name="purpose" class="form-control">
                                                        @foreach($carPurposes as $carPurpose)
                                                            <option value="{{ $carPurpose }}">{{ $carPurpose }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors purpose"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="title-edit" class="col-sm-12 col-form-label">Title</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="title-edit" name="title"
                                                           placeholder="Title"/>
                                                    <span class="text-danger errors title"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="view_360_url-edit" class="col-sm-12 col-form-label">view 360
                                                    URL</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="view_360_url-edit"
                                                           name="view_360_url"
                                                           placeholder="View 360 URL(Optional"/>
                                                    <span class="text-danger errors title"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="regional_specs-edit" class="col-sm-12 col-form-label">Regional
                                                    Specs</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="regional_specs-edit"
                                                            name="regional_specs">
                                                        <option value="">Select Regional Specs</option>
                                                        <option value="GCC Specs">GCC Specs</option>
                                                        <option value="American Specs">American Specs</option>
                                                        <option value="Canadian Specs">Canadian Specs</option>
                                                        <option value="European Specs">European Specs</option>
                                                        <option value="Japanese Specs">Japanese Specs</option>
                                                        <option value="Korean Specs">Korean Specs</option>
                                                        <option value="Chinese Specs">Chinese Specs</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                    <span class="text-danger errors regional_specs"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Edit   Brand, Model and Trim--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="brand_id-edit" class="col-sm-12 col-form-label">Brand</label>
                                                <div class="col-sm-12">
                                                    <select id="brand_id-edit" name="brand_id" class="form-control">
                                                        <option value="">Select Brand</option>
                                                        @foreach($brands as $brand)
                                                            <option
                                                                value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors brand_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="model_id-edit"
                                                       class="col-sm-12 col-form-label">Model</label>
                                                <div class="col-sm-12">
                                                    <select id="model_id-edit" name="model_id" class="form-control">
                                                        <option value="">Select Model</option>
                                                    </select>
                                                    <span class="text-danger errors model_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="trim_id-edit"
                                                       class="col-sm-12 col-form-label">Trim</label>
                                                <div class="col-sm-12">
                                                    <select id="trim_id-edit" name="trim_id" class="form-control">
                                                        <option value="">Select Trim</option>
                                                    </select>
                                                    <span class="text-danger errors trim_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Edit  Country, State and Cities--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="country_id-edit"
                                                       class="col-sm-12 col-form-label">Country</label>
                                                <div class="col-sm-12">
                                                    <select id="country_id-edit" name="country_id" class="form-control">
                                                        <option value="">Select Country</option>
                                                        @foreach($countries as $country)
                                                            <option
                                                                value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors country_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="state_id-edit"
                                                       class="col-sm-12 col-form-label">State</label>
                                                <div class="col-sm-12">
                                                    <select id="state_id-edit" name="state_id" class="form-control">
                                                        <option value="">Select State</option>
                                                    </select>
                                                    <span class="text-danger errors state_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="city_id-edit"
                                                       class="col-sm-12 col-form-label">City</label>
                                                <div class="col-sm-12">
                                                    <select id="city_id-edit" name="city_id" class="form-control">
                                                        <option value="">Select City</option>
                                                    </select>
                                                    <span class="text-danger errors city_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Edit  Phone Number, Year and Milage--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="phone-edit" class="col-sm-12 col-form-label">Phone
                                                    Number</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="phone-edit" name="phone"
                                                           placeholder="Phone Number"/>
                                                    <span class="text-danger errors phone"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="year-edit" class="col-sm-12 col-form-label">Year</label>
                                                <div class="col-sm-12">
                                                    <input type="number"
                                                           id="year-edit"
                                                           name="year"
                                                           min="1800"
                                                           max="2099"
                                                           class="form-control"
                                                           placeholder="Year"/>
                                                    <span class="text-danger errors year"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="mileage-edit" class="col-sm-12 col-form-label">Mileage in
                                                    Km</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" id="mileage-edit"
                                                           name="mileage"
                                                           placeholder="Mileage"/>
                                                    <span class="text-danger errors mileage"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Edit  Price, Warranty and Is Your Car Insured--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="price-edit" class="col-sm-12 col-form-label">Price</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" id="price-edit"
                                                           name="price"
                                                           placeholder="Price"/>
                                                    <span class="text-danger errors price"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="warranty-edit"
                                                       class="col-sm-12 col-form-label">Warranty</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="warranty-edit" name="warranty">
                                                        <option value="">Select Warranty</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="Does not apply">Does not apply</option>
                                                    </select>
                                                    <span class="text-danger errors warranty"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="is_car_insured-edit" class="col-sm-12 col-form-label">Is
                                                    Your Car
                                                    Insured</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="is_car_insured-edit"
                                                            name="is_car_insured">
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                    <span class="text-danger errors is_car_insured"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Edit   Fuel Type Specs, Body condition Specs and Mechanical condition Specs--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="fuel_type-edit" class="col-sm-12 col-form-label">Fuel Type
                                                    Specs</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="fuel_type-edit"
                                                            name="fuel_type">
                                                        <option value="">Select Fuel Type</option>
                                                        <option value="Petrol">Petrol</option>
                                                        <option value="Diesel">Diesel</option>
                                                        <option value="Hybrid">Hybrid</option>
                                                        <option value="Electric">Electric</option>
                                                    </select>
                                                    <span class="text-danger errors fuel_type"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="body_condition-edit" class="col-sm-12 col-form-label">Body
                                                    condition
                                                    Specs</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="body_condition-edit"
                                                            name="body_condition">
                                                        <option value="">Body condition</option>
                                                        <option value="Perfect inside and out">Perfect inside and out
                                                        </option>
                                                        <option value="No accidents, very few faults">No accidents, very
                                                            few faults
                                                        </option>
                                                        <option value="A bit of wear and tear, all repaired">A bit of
                                                            wear &amp; tear, all repaired
                                                        </option>
                                                        <option value="Normal wear and tear, a few issues">Normal wear
                                                            &amp; tear, a few issues
                                                        </option>
                                                        <option value="Lots of wear and tear to the body">Lots of wear
                                                            &amp; tear to the body
                                                        </option>
                                                    </select>
                                                    <span class="text-danger errors body_condition"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="mechanical_condition-edit" class="col-sm-12 col-form-label">Mechanical
                                                    condition
                                                    Specs</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="mechanical_condition-edit"
                                                            name="mechanical_condition">
                                                        <option value="">Mechanical condition
                                                        </option>
                                                        <option value="Perfect inside and out">Perfect inside and out
                                                        </option>
                                                        <option value="Minor faults, all fixed">Minor faults, all
                                                            fixed
                                                        </option>
                                                        <option value="Major faults, all fixed">Major faults, all
                                                            fixed
                                                        </option>
                                                        <option value="Major faults fixed, small remain">Major faults
                                                            fixed, small remain
                                                        </option>
                                                        <option value="Ongoing minor &amp; major faults">Ongoing minor
                                                            &amp; major faults
                                                        </option>
                                                    </select>
                                                    <span class="text-danger errors mechanical_condition"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Edit Seating Capsity, Horse Power and Engine Capasity--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="seating_capacity-edit" class="col-sm-12 col-form-label">Seating Capacity</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="seating_capacity-edit" name="seating_capacity">
                                                        <option value="">Select Seating Capacity</option>
                                                        <option value="2">2</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="8">8</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                    <span class="text-danger errors seating_capacity"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="horse_power-edit" class="col-sm-12 col-form-label">Horse Power</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="horse_power-edit"
                                                            name="horse_power">
                                                        <option value="">Select Horse Power</option>
                                                        <option value="100 - 200 HP">100 - 200 HP</option>
                                                        <option value="200 - 300 HP">200 - 300 HP</option>
                                                        <option value="300 - 400 HP">300 - 400 HP</option>
                                                        <option value="400 - 500 HP">400 - 500 HP</option>
                                                        <option value="500 - 600 HP">500 - 600 HP</option>
                                                        <option value="600 - 700 HP">600 - 700 HP</option>
                                                        <option value="700 - 800 HP">700 - 800 HP</option>
                                                        <option value="800 - 900 HP">800 - 900 HP</option>
                                                        <option value="900+ HP">900+ HP</option>
                                                        <option value="Unknown">Unknown</option>
                                                    </select>
                                                    <span class="text-danger errors horse_power"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="engine_capacity-edit" class="col-sm-12 col-form-label">Engine Capacity</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="engine_capacity-edit"
                                                            name="engine_capacity">
                                                        <option value="" >Engine Capacity (cc)</option>
                                                        <option value="0 - 500 cc">0 - 500 cc</option>
                                                        <option value="500 - 1000 cc">500 - 1000 cc</option>
                                                        <option value="1000 - 1500 cc">1000 - 1500 cc</option>
                                                        <option value="1500 - 2000 cc">1500 - 2000 cc</option>
                                                        <option value="2000 - 2500 cc">2000 - 2500 cc</option>
                                                        <option value="2500 - 3000 cc">2500 - 3000 cc</option>
                                                        <option value="3000 - 3500 cc">3000 - 3500 cc</option>
                                                        <option value="3500 - 4000 cc">3500 - 4000 cc</option>
                                                        <option value="4000+ cc">4000+ cc</option>
                                                        <option value="Unknown">Unknown</option>
                                                    </select>
                                                    <span class="text-danger errors engine_capacity"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Edit   Description--}}
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="description-edit" class="col-sm-12 col-form-label">Description</label>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" id="description-edit"
                                                              name="description" rows="5"
                                                              placeholder="Description"></textarea>
                                                    <span class="text-danger errors description"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Edit   Colours and Doors--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="exterior_color-edit" class="col-sm-12 col-form-label">Exterior
                                                    Colour</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="exterior_color-edit"
                                                            name="exterior_color">
                                                        <option value="">Exterior Color</option>
                                                        <option value="Black">Black</option>
                                                        <option value="Blue">Blue</option>
                                                        <option value="Brown">Brown</option>
                                                        <option value="Burgundy">Burgundy</option>
                                                        <option value="Gold">Gold</option>
                                                        <option value="Grey">Grey</option>
                                                        <option value="Orange">Orange</option>
                                                        <option value="Green">Green</option>
                                                        <option value="Purple">Purple</option>
                                                        <option value="Red">Red</option>
                                                        <option value="Silver">Silver</option>
                                                        <option value="Beige">Beige</option>
                                                        <option value="Tan">Tan</option>
                                                        <option value="Teal">Teal</option>
                                                        <option value="White">White</option>
                                                        <option value="Yellow">Yellow</option>
                                                        <option value="Other Color">Other Color</option>
                                                    </select>
                                                    <span class="text-danger errors exterior_color"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="interior_color-edit" class="col-sm-12 col-form-label">Interior
                                                    Colour</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="interior_color-edit"
                                                            name="interior_color">
                                                        <option value="">Interior Color</option>
                                                        <option value="Beige">Beige</option>
                                                        <option value="Black">Black</option>
                                                        <option value="Blue">Blue</option>
                                                        <option value="Brown">Brown</option>
                                                        <option value="Green">Green</option>
                                                        <option value="Grey">Grey</option>
                                                        <option value="Orange">Orange</option>
                                                        <option value="Red">Red</option>
                                                        <option value="Tan">Tan</option>
                                                        <option value="White">White</option>
                                                        <option value="Yellow">Yellow</option>
                                                        <option value="Other Color">Other Color</option>
                                                    </select>
                                                    <span class="text-danger errors interior_color"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="doors-edit" class="col-sm-12 col-form-label">Doors</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="doors-edit"
                                                            name="doors">
                                                        <option value="">Doors</option>
                                                        <option value="2">2 door</option>
                                                        <option value="3">3 door</option>
                                                        <option value="4">4 door</option>
                                                        <option value="5+">5+ doors</option>
                                                    </select>
                                                    <span class="text-danger errors doors"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Edit  No Of Cylinders, Transmission Type and Body Type--}}
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="cylinders-edit" class="col-sm-12 col-form-label">No Of
                                                    Cylinders</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="cylinders-edit" name="cylinders">

                                                        <option value="">Select No Of Cylinders</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="8">8</option>
                                                        <option value="10">10</option>
                                                        <option value="12">12</option>
                                                        <option value="0">Unknown</option>
                                                    </select>
                                                    <span class="text-danger errors cylinders"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="transmission_type-edit" class="col-sm-12 col-form-label">Transmission
                                                    Type</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="transmission_type-edit"
                                                            name="transmission_type">
                                                        <option value="">Select Transmission Type</option>
                                                        <option value="Manual Transmission">Manual Transmission</option>
                                                        <option value="Automatic Transmission">Automatic Transmission
                                                        </option>
                                                    </select>
                                                    <span class="text-danger errors transmission_type"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="body_type_id-edit" class="col-sm-12 col-form-label">Body Type</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id=body_type_id-edit"
                                                            name="body_type_id">
                                                        <option value="" selected="selected">Select Body Type</option>
                                                        @foreach($bodyTypes as $bodyType)
                                                            <option
                                                                value="{{ $bodyType->id }}">{{ $bodyType->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors body_type_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Edit   Images--}}
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-form-label">Image</label>
                                                <div class="col-sm-12">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="image-edit"
                                                               name="image">
                                                        <label class="custom-file-label" for="image-edit">Choose
                                                            file</label>
                                                    </div>
                                                    <span class="text-danger errors image"></span>
                                                    <img class="mt-2" src="" alt="Car Image" id="image-update"
                                                         width="250">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Edit Extra Vehicle Features--}}
                                    <div class="row">
                                        <span class="h3 text-center m-1 text-bold">Select Extra Features Of Vehicle</span>
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                @foreach($features as $feature)
                                                    <div class="col-sm-3">
                                                        <label for="{{ strtolower(str_replace(' ', '_', str_replace('/', '_',$feature))) }}-edit" class="col-sm-12 col-form-label">
                                                            <input id="{{ strtolower(str_replace(' ', '_', str_replace('/', '_',$feature))) }}-edit" type="checkbox" name="{{ strtolower(str_replace(' ', '_', str_replace('/', '_',$feature))) }}" value="1"> {{ $feature }}
                                                        </label>
                                                    </div>
                                                    <span class="text-danger errors {{ $feature }}"></span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="edit-button">Update</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        @endif
    @endsection
    @section('scripts')
        <script>
            $(function () {
                // Define your custom length options
                var customLengthOptions = [10, 25, 50, 100];

                // Initialize the DataTable
                var table = $("#example1").DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    lengthChange: true,
                    lengthMenu: customLengthOptions, // Set custom length options
                    buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    ajax: {
                        url: '{!! route('cars.index') !!}',
                        error: function (xhr, textStatus, errorThrown) {
                            if (xhr.status === 403) {
                                $(document).Toasts('create', {
                                    class: 'bg-danger',
                                    title: 'Error',
                                    subtitle: xhr.status,
                                    body: 'Unauthorized Error: You do not have permission to access this resource.',
                                    autohide: true, // Enable autohide
                                    delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                                })
                            } else {
                                $(document).Toasts('create', {
                                    class: 'bg-danger',
                                    title: 'Error',
                                    subtitle: xhr.status,
                                    body: xhr.responseJSON.message,
                                    autohide: true, // Enable autohide
                                    delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                                })
                            }
                        },
                    },
                    columns: [
                        {data: 'title', name: 'title'},
                        {data: 'image', name: 'image'},
                        {data: 'price', name: 'price'},
                        {data: 'mileage', name: 'mileage'},
                        {data: 'year', name: 'year'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'actions', name: 'actions', sorting: false},
                        // Add more columns as needed
                    ],
                    columnDefs: [
                        {
                            targets: 'no-sort', // Apply to columns with the class 'no-sort'
                            orderable: false, // Disable sorting for these columns
                            searchable: false, // Disable searching for these columns
                        },
                    ],
                });

                // Add the DataTable buttons
                new $.fn.dataTable.Buttons(table, {
                    buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                });

                table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0) .dataTables_length');

                @if(hasPermissions($permissions,'add-new-car'))
                $('#add-button').on('click', function () {
                    $('.errors').html('');
                    let data = new FormData($('#add-form')[0]);
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('cars.add') }}",
                        data: data,
                        processData: false,  // Prevent processing data for files
                        contentType: false,  // Prevent setting the content type
                        success: function (res) {
                            if (res.status) {
                                $(document).Toasts('create', {
                                    class: 'bg-success',
                                    title: 'Success',
                                    subtitle: "Created",
                                    body: res.message,
                                    autohide: true, // Enable autohide
                                    delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                                })
                            } else {
                                $(document).Toasts('create', {
                                    class: 'bg-danger',
                                    title: 'Error',
                                    subtitle: 'Created',
                                    body: res.message,
                                    autohide: true, // Enable autohide
                                    delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                                })
                            }
                            $('#add-model').modal('hide');
                            table.ajax.reload();

                        },
                        error: function (xhr, textStatus, errorThrown) {
                            if (xhr.status === 403) {
                                $(document).Toasts('create', {
                                    class: 'bg-danger',
                                    title: 'Error',
                                    subtitle: xhr.status,
                                    body: 'Unauthorized Error: You do not have permission to access this resource.',
                                    autohide: true, // Enable autohide
                                    delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                                })
                            } else if (xhr.status === 422) {
                                $.each(xhr.responseJSON.errors, function (index, value) {
                                    $.each(value, function (ind, val) {
                                        $('.' + index).html(val + "</br>")
                                    });
                                });
                            } else {
                                $(document).Toasts('create', {
                                    class: 'bg-danger',
                                    title: 'Error',
                                    subtitle: xhr.status,
                                    body: xhr.responseJSON.message,
                                    autohide: true, // Enable autohide
                                    delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                                })
                            }
                        },
                    });
                })
                @endif
                @if(hasPermissions($permissions,'edit-car'))
                $(document).on('click', '.edit-record', function () {
                    let data = $(this).data('data');
                    $('#id').val(data.id);
                    $('#title-edit').val(data.title);
                    $('#description-edit').val(data.description);
                    $('#image-update').attr('src', data.src);
                    $('#image-edit').val('');
                    $('#country_id-edit').val(data.country_id).change();
                    $('#brand_id-edit').val(data.brand_id).change();
                    $('#state-id-hide').val(data.state_id);
                    $('#city-id-hide').val(data.city_id);
                    $('#model-id-hide').val(data.model_id);
                    $('#trim-id-hide').val(data.trim_id);
                    $('#regional_specs-edit').val(data.regional_specs).change();
                    $('#is_car_insured-edit').val(data.is_car_insured).change();
                    $('#phone-edit').val(data.phone).change();
                    $('#price-edit').val(data.price).change();
                    $('#mileage-edit').val(data.mileage).change();
                    $('#year-edit').val(data.year).change();
                    $('#fuel_type-edit').val(data.fuel_type).change();
                    $('#body_condition-edit').val(data.body_condition).change();
                    $('#mechanical_condition-edit').val(data.mechanical_condition).change();
                    $('#interior_color-edit').val(data.interior_color).change();
                    $('#exterior_color-edit').val(data.exterior_color).change();
                    $('#doors-edit').val(data.doors).change();
                    $('#body_type_id-edit').val(data.body_type_id).change();
                    $('#transmission_type-edit').val(data.transmission_type).change();
                    $('#cylinders-edit').val(data.cylinders).change();
                    $('#warranty-edit').val(data.warranty).change();
                    $('#view_360_url-edit').val(data.view_360_url).change();
                    $('#seating_capacity-edit').val(data.seating_capacity).change();
                    $('#engine_capacity-edit').val(data.engine_capacity).change();
                    $('#horse_power-edit').val(data.horse_power).change();
                    if (data.selectedFeatures) {
                        $.each(data.selectedFeatures, function (ind, val) {
                            console.log('features Value', '[name="' + ind + '"]');
                            $('#' + ind.replace('/', '\\/') + '-edit').prop('checked', true);
                        });
                    }

                    $('.errors').html('');
                    $('#edit-model').modal('show');

                });
                $('#edit-button').on('click', function () {
                    $('.errors').html('');
                    let data = new FormData($('#edit-form')[0]);
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('cars.edit') }}",
                        data: data,
                        processData: false,  // Prevent processing data for files
                        contentType: false,  // Prevent setting the content type
                        success: function (res) {
                            if (res.status) {
                                $(document).Toasts('create', {
                                    class: 'bg-success',
                                    title: 'Success',
                                    subtitle: "Updated",
                                    body: res.message,
                                    autohide: true, // Enable autohide
                                    delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                                })
                            } else {
                                $(document).Toasts('create', {
                                    class: 'bg-danger',
                                    title: 'Error',
                                    subtitle: 'Updated',
                                    body: res.message,
                                    autohide: true, // Enable autohide
                                    delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                                })
                            }
                            $('#edit-model').modal('hide');
                            table.ajax.reload();

                        },
                        error: function (xhr, textStatus, errorThrown) {
                            console.log(xhr);
                            console.log(errorThrown);
                            if (xhr.status === 403) {
                                $(document).Toasts('create', {
                                    class: 'bg-danger',
                                    title: 'Error',
                                    subtitle: xhr.status,
                                    body: 'Unauthorized Error: You do not have permission to access this resource.',
                                    autohide: true, // Enable autohide
                                    delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                                })
                            } else if (xhr.status === 422) {
                                $.each(xhr.responseJSON.errors, function (index, value) {
                                    $.each(value, function (ind, val) {
                                        $('.' + index).html(val + "</br>")
                                    });
                                });
                            } else {
                                $(document).Toasts('create', {
                                    class: 'bg-danger',
                                    title: 'Error',
                                    subtitle: xhr.status,
                                    body: xhr.responseJSON.message,
                                    autohide: true, // Enable autohide
                                    delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                                })
                            }
                        },
                    });
                })
                @endif
                @if(hasPermissions($permissions,'delete-car'))
                $(document).on('click', '.delete-record', function () {
                    let id = $(this).data('id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'POST',
                                url: "{{ route('cars.delete') }}",
                                data: {id: id},
                                success: function (res) {
                                    if (res.status) {
                                        $(document).Toasts('create', {
                                            class: 'bg-success',
                                            title: 'Success',
                                            subtitle: "Deleted",
                                            body: res.message,
                                            autohide: true, // Enable autohide
                                            delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                                        })
                                    } else {
                                        $(document).Toasts('create', {
                                            class: 'bg-danger',
                                            title: 'Error',
                                            subtitle: 'Deleted',
                                            body: res.message,
                                            autohide: true, // Enable autohide
                                            delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                                        })
                                    }
                                    table.ajax.reload();

                                },
                                error: function (xhr, textStatus, errorThrown) {
                                    console.log(xhr);
                                    console.log(errorThrown);
                                    if (xhr.status === 403) {
                                        $(document).Toasts('create', {
                                            class: 'bg-danger',
                                            title: 'Error',
                                            subtitle: xhr.status,
                                            body: 'Unauthorized Error: You do not have permission to access this resource.',
                                            autohide: true, // Enable autohide
                                            delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                                        })
                                    } else if (xhr.status === 422) {
                                        $.each(xhr.responseJSON.errors, function (index, value) {
                                            $.each(value, function (ind, val) {
                                                $('.' + index).html(val + "</br>")
                                            });
                                        });
                                    } else {
                                        $(document).Toasts('create', {
                                            class: 'bg-danger',
                                            title: 'Error',
                                            subtitle: xhr.status,
                                            body: xhr.responseJSON.message,
                                            autohide: true, // Enable autohide
                                            delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                                        })
                                    }
                                },
                            });
                        }
                    })

                });
                @endif
            });
            $(document).on('change', '[name="country_id"]', function () {
                let countryId = $(this).val(); // Get the selected country ID
                let $this = $(this) // Get the selected country ID
                if (countryId) {
                    var stateUrl = "{{ route('get.states') }}?country_id=" + countryId;
                    $.ajax({
                        url: stateUrl,
                        type: 'GET',
                        success: function (data) {
                            let html = '<option value="">Select State</option>';
                            $.each(data, function (key, value) {
                                html += '<option value="' + value.id + '">' + value.name + '</option>';
                            });
                            $this.parent().parent().parent().parent().find('[name="state_id"]').html(html);
                            $this.parent().parent().parent().parent().find('[name="state_id"]').val($('#state-id-hide').val()).change();
                        }
                    });
                }
            });
            $(document).on('change', '[name="state_id"]', function () {
                let stateId = $(this).val(); // Get the selected country ID
                let $this = $(this) // Get the selected country ID
                if (stateId) {
                    var stateUrl = "{{ route('get.cities') }}?state_id=" + stateId;
                    $.ajax({
                        url: stateUrl,
                        type: 'GET',
                        success: function (data) {
                            let html = '<option value="">Select City</option>';
                            $.each(data, function (key, value) {
                                html += '<option value="' + value.id + '">' + value.name + '</option>';
                            });
                            $this.parent().parent().parent().parent().find('[name="city_id"]').html(html);
                            $this.parent().parent().parent().parent().find('[name="city_id"]').val($('#city-id-hide').val()).change();
                        }
                    });
                }
            });
            $(document).on('change', '[name="brand_id"]', function () {
                let brandId = $(this).val(); // Get the selected country ID
                let $this = $(this) // Get the selected country ID
                if (brandId) {
                    var brandUrl = "{{ route('get.models') }}?brand_id=" + brandId;
                    $.ajax({
                        url: brandUrl,
                        type: 'GET',
                        success: function (data) {
                            let html = '<option value="">Select Model</option>';
                            $.each(data, function (key, value) {
                                html += '<option value="' + value.id + '">' + value.name + '</option>';
                            });
                            $this.parent().parent().parent().parent().find('[name="model_id"]').html(html);
                            $this.parent().parent().parent().parent().find('[name="model_id"]').val($('#model-id-hide').val()).change();
                        }
                    });
                }
            });
            $(document).on('change', '[name="model_id"]', function () {
                let modelId = $(this).val(); // Get the selected country ID
                let $this = $(this) // Get the selected country ID
                if (modelId) {
                    var trimUrl = "{{ route('get.trims') }}?model_id=" + modelId;
                    $.ajax({
                        url: trimUrl,
                        type: 'GET',
                        success: function (data) {
                            let html = '<option value="">Select Trim</option>';
                            $.each(data, function (key, value) {
                                html += '<option value="' + value.id + '">' + value.trims + '</option>';
                            });
                            $this.parent().parent().parent().parent().find('[name="trim_id"]').html(html);
                            $this.parent().parent().parent().parent().find('[name="trim_id"]').val($('#trim-id-hide').val()).change();
                        }
                    });
                }
            });
        </script>
    @endsection
</x-app-layout>
