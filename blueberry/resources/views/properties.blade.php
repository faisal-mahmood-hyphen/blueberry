<x-app-layout :active="$active" :breadCrumbs="$breadCrumbs">
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ ucwords(end($breadCrumbs)['name']) }}</h3>
                        @if(hasPermissions($permissions,'add-new-property'))
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
        @if(hasPermissions($permissions,'add-new-property'))
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
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="property_purpose" class="col-sm-12 col-form-label">Property
                                                    Purpose</label>
                                                <div class="col-sm-12">
                                                    <select id="property_purpose" name="purpose"
                                                            class="form-control">
                                                        @foreach($propertyPurposes as $property)
                                                            <option value="{{ $property }}">{{ $property }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors property_purpose"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="title" class="col-sm-12 col-form-label">Title</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="title" name="title"
                                                           placeholder="Title"/>
                                                    <span class="text-danger errors title"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="tour_360_url" class="col-sm-12 col-form-label">Tour 360
                                                    URL</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="tour_360_url"
                                                           name="tour_360_url"
                                                           placeholder="Tour 360 URL(Optional)"/>
                                                    <span class="text-danger errors tour_360_url"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="category_id"
                                                       class="col-sm-12 col-form-label">Category</label>
                                                <div class="col-sm-12">
                                                    <select id="category_id" name="category_id" class="form-control">
                                                        <option value="">Select Category</option>
                                                        @foreach($categories as $category)
                                                            <option
                                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors category_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="sub_category_id"
                                                       class="col-sm-12 col-form-label">Sub Category</label>
                                                <div class="col-sm-12">
                                                    <select id="sub_category_id" name="sub_category_id"
                                                            class="form-control">
                                                        <option value="">Select Sub Category</option>
                                                    </select>
                                                    <span class="text-danger errors sub_category_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="price" class="col-sm-12 col-form-label">Price</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" id="price"
                                                           name="price"
                                                           placeholder="Price"/>
                                                    <span class="text-danger errors price"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="size" class="col-sm-12 col-form-label">Size</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" id="size" name="size"
                                                           placeholder="Size in Sq ft"/>
                                                    <span class="text-danger errors size"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="phone_number" class="col-sm-12 col-form-label">Phone
                                                    Number</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="phone_number"
                                                           name="phone_number"
                                                           placeholder="Phone Number"/>
                                                    <span class="text-danger errors phone_number"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="developer_name" class="col-sm-12 col-form-label">Developer
                                                    Name</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="developer_name"
                                                           name="developer_name"
                                                           placeholder="Developer Name"/>
                                                    <span class="text-danger errors developer_name"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="an_agent" class="col-sm-12 col-form-label">Are you an
                                                    Agent</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="an_agent"
                                                            name="an_agent">
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                    <span class="text-danger errors an_agent"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="total_closing_fee" class="col-sm-12 col-form-label">Total
                                                    Clossing Fee</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" id="total_closing_fee"
                                                           name="total_closing_fee"
                                                           placeholder="Total Clossing Fee"/>
                                                    <span class="text-danger errors total_closing_fee"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="annual_community_fee" class="col-sm-12 col-form-label">Annual
                                                    Community Fee</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" id="annual_community_fee"
                                                           name="annual_community_fee"
                                                           placeholder="Annual Community Fee"/>
                                                    <span class="text-danger errors annual_community_fee"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="landlord_name" class="col-sm-12 col-form-label">Landlord
                                                    Name </label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="landlord_name"
                                                           name="landlord_name"
                                                           placeholder="Landlord Name"/>
                                                    <span class="text-danger errors landlord_name"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="neighbourhood" class="col-sm-12 col-form-label">Neighbourhood
                                                </label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="neighbourhood"
                                                           name="neighbourhood"
                                                           placeholder="Neighbourhood"/>
                                                    <span class="text-danger errors neighbourhood"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="location" class="col-sm-12 col-form-label">Location
                                                </label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="location"
                                                           name="location"
                                                           placeholder="Location"/>
                                                    <span class="text-danger errors location"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="maintenance_fee" class="col-sm-12 col-form-label">Maintenance
                                                    Fee</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" id="maintenance_fee"
                                                           name="maintenance_fee"
                                                           placeholder="Maintenance Fee"/>
                                                    <span class="text-danger errors maintenance_fee"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="is_it_furnished" class="col-sm-12 col-form-label">Is It
                                                    Furnished</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="is_it_furnished"
                                                            name="is_it_furnished">
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                    <span class="text-danger errors is_it_furnished"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="property_reference_id" class="col-sm-12 col-form-label">Property
                                                    Reference Name</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="property_reference_id"
                                                           name="property_reference_id"
                                                           placeholder="Property Reference Name"/>
                                                    <span class="text-danger errors is_it_furnished"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="seller_transfer_fee" class="col-sm-12 col-form-label">Seller
                                                    Transfer Fee</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" id="seller_transfer_fee"
                                                           name="seller_transfer_fee"
                                                           placeholder="Seller Transfer Fee"/>
                                                    <span class="text-danger errors seller_transfer_fee"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="buyer_transfer_fee" class="col-sm-12 col-form-label">Buyer
                                                    Transfer Fee</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" id="buyer_transfer_fee"
                                                           name="buyer_transfer_fee"
                                                           placeholder="Buyer Transfer Fee"/>
                                                    <span class="text-danger errors buyer_transfer_fee"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="ready_by_date" class="col-sm-12 col-form-label">Ready By
                                                    Date</label>
                                                <div class="col-sm-12">
                                                    <input type="date" id="ready_by_date" name="ready_by_date"
                                                           class="form-control">
                                                    <span class="text-danger errors ready_by_date"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="youtube_url" class="col-sm-12 col-form-label">Youtube
                                                    URL</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="youtube_url"
                                                           name="youtube_url"
                                                           placeholder="Youtube URL(Optional)"/>
                                                    <span class="text-danger errors youtube_url"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                    <div class="row">
                                        <span
                                            class="h3 text-center m-1 text-bold">Select Extra Features Of Vehicle</span>
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                @foreach($features as $feature)
                                                    <div class="col-sm-3">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="{{ strtolower(str_replace(' ', '_', str_replace('/', '_',$feature))) }}"
                                                                   value="1"> {{ $feature }}
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
            <input type="hidden" id="subcategory-id-hide" value=""/>
        @endif
        @if(hasPermissions($permissions,'edit-property'))
            <div class="modal fade" id="edit-model">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                Edit {{ Str::singular(ucwords(end($breadCrumbs)['name'])) }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="edit-form">
                                <input type="hidden" name="id" id="id" value="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="property_purpose-edit" class="col-sm-12 col-form-label">Property
                                                    Purpose</label>
                                                <div class="col-sm-12">
                                                    <select id="property_purpose-edit" name="purpose"
                                                            class="form-control">
                                                        @foreach($propertyPurposes as $propertyPurpose)
                                                            <option
                                                                value="{{ $propertyPurpose }}">{{ $propertyPurpose }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors property_purpose"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="title-edit"
                                                       class="col-sm-12 col-form-label">Title</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="title-edit"
                                                           name="title"
                                                           placeholder="Title"/>
                                                    <span class="text-danger errors title"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="tour_360_url-edit" class="col-sm-12 col-form-label">Tour
                                                    360
                                                    URL</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="tour_360_url-edit"
                                                           name="tour_360_url"
                                                           placeholder="Tour 360 URL(Optional)"/>
                                                    <span class="text-danger errors tour_360_url"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="country_id-edit"
                                                       class="col-sm-12 col-form-label">Country</label>
                                                <div class="col-sm-12">
                                                    <select id="country_id-edit" name="country_id"
                                                            class="form-control">
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
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="category_id-edit"
                                                       class="col-sm-12 col-form-label">Category</label>
                                                <div class="col-sm-12">
                                                    <select id="category_id-edit" name="category_id"
                                                            class="form-control">
                                                        <option value="">Select Category</option>
                                                        @foreach($categories as $category)
                                                            <option
                                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors category_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="sub_category_id-edit"
                                                       class="col-sm-12 col-form-label">Sub Category</label>
                                                <div class="col-sm-12">
                                                    <select id="sub_category_id-edit" name="sub_category_id"
                                                            class="form-control">
                                                        <option value="">Select Sub Category</option>
                                                    </select>
                                                    <span class="text-danger errors sub_category_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="price-edit"
                                                       class="col-sm-12 col-form-label">Price</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" id="price-edit"
                                                           name="price"
                                                           placeholder="Price"/>
                                                    <span class="text-danger errors price"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="size-edit"
                                                       class="col-sm-12 col-form-label">Size</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" id="size-edit"
                                                           name="size"
                                                           placeholder="Size"/>
                                                    <span class="text-danger errors size"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="phone_number-edit" class="col-sm-12 col-form-label">Phone
                                                    Number</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="phone_number-edit"
                                                           name="phone_number"
                                                           placeholder="Phone Number"/>
                                                    <span class="text-danger errors phone_number"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="developer_name-edit"
                                                       class="col-sm-12 col-form-label">Developer
                                                    Name</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="developer_name-edit"
                                                           name="developer_name"
                                                           placeholder="Developer Name"/>
                                                    <span class="text-danger errors developer_name"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="an_agent-edit" class="col-sm-12 col-form-label">Are you an
                                                    Agent</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="an_agent-edit"
                                                            name="an_agent">
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                    <span class="text-danger errors an_agent"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="total_closing_fee-edit"
                                                       class="col-sm-12 col-form-label">Total
                                                    Clossing Fee</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control"
                                                           id="total_closing_fee-edit"
                                                           name="total_closing_fee"
                                                           placeholder="Total Clossing Fee"/>
                                                    <span class="text-danger errors total_closing_fee"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="annual_community_fee-edit"
                                                       class="col-sm-12 col-form-label">Annual
                                                    Community Fee</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control"
                                                           id="annual_community_fee-edit"
                                                           name="annual_community_fee"
                                                           placeholder="Annual Community Fee"/>
                                                    <span
                                                        class="text-danger errors annual_community_fee"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="landlord_name-edit"
                                                       class="col-sm-12 col-form-label">Landlord
                                                    Name </label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="landlord_name-edit"
                                                           name="landlord_name"
                                                           placeholder="Landlord Name"/>
                                                    <span class="text-danger errors landlord_name"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="neighbourhood-edit"
                                                       class="col-sm-12 col-form-label">Neighbourhood
                                                </label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="neighbourhood-edit"
                                                           name="neighbourhood"
                                                           placeholder="Neighbourhood"/>
                                                    <span class="text-danger errors neighbourhood"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="location-edit" class="col-sm-12 col-form-label">Location
                                                </label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="location-edit"
                                                           name="location"
                                                           placeholder="Location"/>
                                                    <span class="text-danger errors location"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="maintenance_fee-edit"
                                                       class="col-sm-12 col-form-label">Maintenance
                                                    Fee</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control"
                                                           id="maintenance_fee-edit"
                                                           name="maintenance_fee"
                                                           placeholder="Maintenance Fee"/>
                                                    <span class="text-danger errors maintenance_fee"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="is_it_furnished-edit"
                                                       class="col-sm-12 col-form-label">Is It Furnished</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" id="is_it_furnished-edit"
                                                            name="is_it_furnished">
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                    <span class="text-danger errors is_it_furnished"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="property_reference_id-edit"
                                                       class="col-sm-12 col-form-label">Property
                                                    Reference Name</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                           id="property_reference_id-edit"
                                                           name="property_reference_id"
                                                           placeholder="Property Reference Name"/>
                                                    <span class="text-danger errors is_it_furnished"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="seller_transfer_fee-edit"
                                                       class="col-sm-12 col-form-label">Seller
                                                    Transfer Fee</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control"
                                                           id="seller_transfer_fee-edit"
                                                           name="seller_transfer_fee"
                                                           placeholder="Seller Transfer Fee"/>
                                                    <span class="text-danger errors seller_transfer_fee"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="buyer_transfer_fee-edit"
                                                       class="col-sm-12 col-form-label">Buyer
                                                    Transfer Fee</label>
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control"
                                                           id="buyer_transfer_fee-edit"
                                                           name="buyer_transfer_fee"
                                                           placeholder="Buyer Transfer Fee"/>
                                                    <span class="text-danger errors buyer_transfer_fee"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group row">
                                                <label for="ready_by_date-edit" class="col-sm-12 col-form-label">Ready
                                                    By Date</label>
                                                <div class="col-sm-12">
                                                    <input type="date" id="ready_by_date-edit" name="ready_by_date"
                                                           class="form-control">
                                                    <span class="text-danger errors ready_by_date"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="youtube_url-edit" class="col-sm-12 col-form-label">Youtube
                                                    URL</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="youtube_url-edit"
                                                           name="youtube_url"
                                                           placeholder="Youtube URL(Optional)"/>
                                                    <span class="text-danger errors youtube_url"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <img class="mt-2" src="" alt="Property Image" id="image-update"
                                                         width="250">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="description-edit"
                                                       class="col-sm-12 col-form-label">Description</label>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" id="description-edit"
                                                              name="description"
                                                              rows="5"
                                                              placeholder="Description"></textarea>
                                                    <span class="text-danger errors description"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <span
                                            class="h3 text-center m-1 text-bold">Select Extra Features Of Vehicle</span>
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                @foreach($features as $feature)
                                                    <div class="col-sm-3">
                                                        <label
                                                            for="{{ strtolower(str_replace(' ', '_', str_replace('/', '_',$feature))) }}-edit"
                                                            class="col-sm-12 col-form-label">
                                                            <input
                                                                id="{{ strtolower(str_replace(' ', '_', str_replace('/', '_',$feature))) }}-edit"
                                                                type="checkbox"
                                                                name="{{ strtolower(str_replace(' ', '_', str_replace('/', '_',$feature))) }}"
                                                                value="1"> {{ $feature }}
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
                        url: '{!! route('properties.index') !!}',
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

                @if(hasPermissions($permissions,'add-new-property'))
                $('#add-button').on('click', function () {
                    $('.errors').html('');
                    let data = new FormData($('#add-form')[0]);
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('properties.add') }}",
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
                @if(hasPermissions($permissions,'edit-property'))
                $(document).on('click', '.edit-record', function () {
                    let data = $(this).data('data');
                    console.log(data.purpose);
                    $('#id').val(data.id);
                    $('#title-edit').val(data.title);
                    $('#youtube_url-edit').val(data.youtube_url).change();
                    $('#image-edit').val('');
                    $('#phone_number-edit').val(data.phone_number).change();
                    $('#price-edit').val(data.price).change();
                    $('#country_id-edit').val(data.country_id).change();
                    $('#state-id-hide').val(data.state_id);
                    $('#city-id-hide').val(data.city_id);
                    $('#category_id-edit').val(data.category_id).change();
                    $('#subcategory-id-hide').val(data.sub_category_id);
                    $('#description-edit').val(data.description);
                    $('#size-edit').val(data.size).change();
                    $('#ready_by_date-edit').val(data.ready_by_date).change();
                    $('#total_closing_fee-edit').val(data.total_closing_fee).change();
                    $('#developer_name-edit').val(data.developer_name).change();
                    $('#annual_community_fee-edit').val(data.annual_community_fee).change();
                    $('#is_it_furnished-edit').val(data.is_it_furnished).change();
                    $('#property_reference_id-edit').val(data.property_reference_id).change();
                    $('#seller_transfer_fee-edit').val(data.seller_transfer_fee).change();
                    $('#buyer_transfer_fee-edit').val(data.buyer_transfer_fee).change();
                    $('#maintenance_fee-edit').val(data.maintenance_fee).change();
                    $('#shared_spa-edit').val(data.shared_spa).change();
                    $('#tour_360_url-edit').val(data.tour_360_url).change();
                    $('#an_agent-edit').val(data.an_agent).change();
                    $('#landlord_name-edit').val(data.landlord_name).change();
                    $('#neighbourhood-edit').val(data.neighbourhood).change();
                    $('#location-edit').val(data.location).change();
                    $('#property_purpose-edit').val(data.purpose).change();
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
                        url: "{{ route('properties.edit') }}",
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
                @if(hasPermissions($permissions,'delete-property'))
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
                                url: "{{ route('properties.delete') }}",
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
            $(document).on('change', '[name="category_id"]', function () {
                let categoryId = $(this).val(); // Get the selected country ID
                console.log(categoryId);
                let $this = $(this) // Get the selected country ID
                if (categoryId) {
                    var stateUrl = "{{ route('get.subcategories') }}?category_id=" + categoryId;
                    $.ajax({
                        url: stateUrl,
                        type: 'GET',
                        success: function (data) {
                            let html = '<option value="">Select Sub Category</option>';
                            $.each(data, function (key, value) {
                                html += '<option value="' + value.id + '">' + value.name + '</option>';
                            });
                            $this.parent().parent().parent().parent().find('[name="sub_category_id"]').html(html);
                            $this.parent().parent().parent().parent().find('[name="sub_category_id"]').val($('#subcategory-id-hide').val()).change();
                        }
                    });
                }
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

        </script>
    @endsection
</x-app-layout>
