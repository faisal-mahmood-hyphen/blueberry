<x-app-layout :active="$active" :breadCrumbs="$breadCrumbs">
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ ucwords(end($breadCrumbs)['name']) }}</h3>
                        @if(hasPermissions($permissions,'add-new-category'))
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
                                <th>Feature</th>
                                <th>Parent Category</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th class="no-sort">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Feature</th>
                                <th>Parent Category</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Status</th>
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
        @if(hasPermissions($permissions,'add-new-category'))
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
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="feature_id" class="col-sm-12 col-form-label">Feature</label>
                                                <div class="col-sm-12">
                                                    <select id="feature_id" name="feature_id" class="form-control">
                                                        <option value="">Select Feature</option>
                                                        @foreach($features as $feature)
                                                            <option value="{{ $feature->id }}">{{ $feature->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors feature_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="parent_id" class="col-sm-12 col-form-label">Parent Category</label>
                                                <div class="col-sm-12">
                                                    <select id="parent_id" name="parent_id" class="form-control">
                                                        <option value="">Select Category</option>
                                                    </select>
                                                    <span class="text-danger errors parent_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-12 col-form-label">Name</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="name" name="name"
                                                           placeholder="Title"/>
                                                    <span class="text-danger errors name"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="status" class="col-sm-12 col-form-label">Status</label>
                                                <div class="col-sm-12">
                                                    <select id="status" name="status" class="form-control">
                                                        @foreach($statuses as $status)
                                                            <option value="{{ $status }}">{{ $status }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors status"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="description" class="col-sm-12 col-form-label">Description</label>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" id="description" name="description" rows="5"
                                                              placeholder="Description"></textarea>
                                                    <span class="text-danger errors description"></span>
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
                                                        <input type="file" class="custom-file-input" id="image" name="image">
                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                    </div>
                                                    <span class="text-danger errors image"></span>
                                                </div>
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
        @endif
        @if(hasPermissions($permissions,'edit-category'))
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
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="feature_id_edit" class="col-sm-12 col-form-label">Feature</label>
                                                <div class="col-sm-12">
                                                    <select id="feature_id_edit" name="feature_id" class="form-control">
                                                        <option value="">Select Feature</option>
                                                        @foreach($features as $feature)
                                                            <option value="{{ $feature->id }}">{{ $feature->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors feature_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="parent_id_edit" class="col-sm-12 col-form-label">Parent Category</label>
                                                <div class="col-sm-12">
                                                    <select id="parent_id_edit" name="parent_id" class="form-control">
                                                        <option value="">Select Category</option>
                                                    </select>
                                                    <span class="text-danger errors parent_id"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="name-edit" class="col-sm-12 col-form-label">Name</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="name-edit" name="name"
                                                           placeholder="Title"/>
                                                    <span class="text-danger errors name"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label for="status-edit" class="col-sm-12 col-form-label">Status</label>
                                                <div class="col-sm-12">
                                                    <select id="status-edit" name="status" class="form-control">
                                                        @foreach($statuses as $status)
                                                            <option value="{{ $status }}">{{ $status }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger errors status"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="description-edit" class="col-sm-12 col-form-label">Description</label>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" id="description-edit" name="description" rows="5"
                                                              placeholder="Description"></textarea>
                                                    <span class="text-danger errors description"></span>
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
                                                        <input type="file" class="custom-file-input" id="image-edit" name="image">
                                                        <label class="custom-file-label" for="image-edit">Choose file</label>
                                                    </div>
                                                    <span class="text-danger errors image"></span>
                                                    <img class="mt-2" src="" alt="Category Image" id="image-update" width="250">
                                                </div>
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
                        url: '{!! route('categories.index') !!}',
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
                        {data: 'feature_id', name: 'feature_id'},
                        {data: 'parent_id', name: 'parent_id'},
                        {data: 'image', name: 'image'},
                        {data: 'name', name: 'name'},
                        {data: 'status', name: 'status'},
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
                $(document).on('change','[name="feature_id"]',function (){
                    let $this = $(this);
                    let featureId = $(this).val();
                    if(featureId.length > 0){
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('feature.categories') }}",
                            data: {feature_id:featureId},
                            success: function (res) {
                                if (res.status) {
                                    $(document).Toasts('create', {
                                        class: 'bg-success',
                                        title: 'Success',
                                        subtitle: "Updated",
                                        body: res.message,
                                        autohide: true, // Enable autohide
                                        delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                                    });
                                    $this.parentsUntil('.card-body').find('[name=parent_id]').html(res.html);
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
                });
                @if(hasPermissions($permissions,'add-new-category'))
                $('#add-button').on('click', function () {
                    $('.errors').html('');
                    let data = new FormData($('#add-form')[0]);
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('categories.add') }}",
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
                @if(hasPermissions($permissions,'edit-category'))
                $(document).on('click','.edit-record', function () {
                    let data = $(this).data('data');
                    $('#id').val(data.id);
                    $('#name-edit').val(data.name);
                    $('#description-edit').val(data.description);
                    $('#image-update').attr('src',data.src);
                    $('#feature_id_edit').val(data.feature_id).change();
                    $('#status-edit').val(data.status).change();
                    $('#image-edit').val('');
                    $('.errors').html('');
                    setTimeout(function () {
                        $('#preloader').show();
                    },500);
                    setTimeout(function (){
                        $('#parent_id_edit').val(data.parent_id).change();
                        $('#preloader').hide();
                        $('#edit-model').modal('show');
                    },2000);


                });
                $('#edit-button').on('click', function () {
                    $('.errors').html('');
                    let data = new FormData($('#edit-form')[0]);
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('categories.edit') }}",
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
                @if(hasPermissions($permissions,'delete-category'))
                $(document).on('click','.delete-record', function () {
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
                                url: "{{ route('categories.delete') }}",
                                data: {id:id},
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
        </script>
    @endsection
</x-app-layout>
