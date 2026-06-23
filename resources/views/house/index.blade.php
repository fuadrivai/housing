@extends('main.index')


@section('content')
    <!-- Recent Activities + Points Distribution -->
    <div class="row g-3">
        <div class="col-md-12">
            <div class="dashboard-card h-100">
                <div class="card-header">
                    <span>📋 Houses</span>
                    <a href="/houses/create" class="btn btn-sm btn-primary"> <i data-lucide="plus"></i> Add House</a>
                </div>
                <div class="card-body no-padding" style="overflow-x:auto;">
                    <table class="table-activities" aria-label="Recent activities table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Motto</th>
                                <th>Attribute</th>
                                <th>description</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($houses as $house)
                                <tr>
                                    <td><strong>{{ $house->name }}</strong> <br> <i><small>{{ $house->fullname }}</small>
                                        </i></td>
                                    <td>{{ $house->motto }}</td>
                                    <td><span class="activity-badge points">{{ $house->attribute }}</span></td>
                                    <td>{{ $house->description }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="/houses/{{ $house->id }}/edit">
                                            <i data-lucide="edit"></i> view detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content-script')
@endsection
