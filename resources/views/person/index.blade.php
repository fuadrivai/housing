@extends('main.index')


@section('content')
    <!-- Recent Activities + Points Distribution -->
    <div class="row g-3">
        <div class="col-md-12">
            <div class="dashboard-card h-100">
                <div class="card-header">
                    <span>📋 People</span>
                    <a href="/person/create" class="btn btn-sm btn-primary"> <i data-lucide="plus"></i> Add Person</a>
                </div>
                <div class="card-body no-padding" style="overflow-x:auto;">
                    <table class="table-activities" aria-label="Recent activities table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Branch</th>
                                <th>Organization</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($people as $person)
                                <tr>
                                    <td>{{ $person->fullname }}</td>
                                    <td>{{ $person->role }}</td>
                                    <td>{{ $person->branch ? $person->branch->name : 'N/A' }}</td>
                                    <td>{{ $person->organization ? $person->organization->name : 'N/A' }}</td>
                                    <td>
                                        <a href="/person/{{ $person->id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="/person/{{ $person->id }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this person?')">Delete</button>
                                        </form>
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
