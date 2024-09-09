<x-app-layout :active="$active" :breadCrumbs="$breadCrumbs">
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{ ucwords(end($breadCrumbs)['name']) }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="{{ route('coupons.assign.users',['couponId'=>$coupon->id]) }}"
                          method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                @foreach($users as $user)
                                    <div class="col-md-3">
                                        <label>
                                            <input type="checkbox" name="user_ids[]" value="{{ $user->id }}"
                                                {{ in_array($user->id, $assignedUserIds) ? 'checked' : '' }}>
                                            {{ $user->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Update</button>
                            <a href="{{ route('coupons.index') }}" class="btn btn-default float-right">Cancel</a>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script>
            $(function () {
                @if(session('success'))
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Success',
                    subtitle: "Updated",
                    body: "{{ session('success') }}",
                    autohide: true, // Enable autohide
                    delay: 5000, // Set the delay to 5000 milliseconds (5 seconds)
                })
                @endif
            });
        </script>
    @endsection
</x-app-layout>
