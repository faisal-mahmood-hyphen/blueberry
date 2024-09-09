<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ ucwords(end($breadCrumbs)['name']) }}</h1>
            </div><!-- /.col -->
            @if(isset($breadCrumbs) && is_array($breadCrumbs) && count($breadCrumbs))
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @foreach($breadCrumbs as $breadCrumb)
                        @if(isset($breadCrumb['active']))
                            <li class="breadcrumb-item {{ $breadCrumb['active'] }}">{{ ucwords($breadCrumb['name']) }}</li>
                        @else
                            <li class="breadcrumb-item"><a href="{{ $breadCrumb['url'] }}">{{ ucwords($breadCrumb['name']) }}</a></li>
                        @endif

                    @endforeach
                </ol>
            </div><!-- /.col -->
            @endif
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
