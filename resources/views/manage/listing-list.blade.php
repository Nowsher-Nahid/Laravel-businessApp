@extends('layouts/manage-layout')
@section('title', 'Aim Direct | Listing List')
@section('content')

    <div class="dashboard-headline">
        <h3>Business Listing List</h3>
        <nav id="breadcrumbs" class="dark">
            <ul>
                <li><a href="{{ route('listing.create') }}">Add Listing</a></li>
                <li>Business Listings</li>
            </ul>
        </nav>
    </div>

    <table id="listing-list" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Location</th>
                <th>Category</th>
                <th>Sub-category</th>
                <th>Company</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

@endsection

@push('scripts')
    
    <script>
        $(function () {
            var table = $('#listing-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('listing.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    {data: 'country', name: 'country'},
                    {data: 'state', name: 'state'},
                    {data: 'city', name: 'city'},
                    {data: 'location', name: 'location'},
                    {data: 'category', name: 'category'},
                    {data: 'sub_category', name: 'sub_category'},
                    {data: 'company', name: 'company'},
                    {data: 'phone', name: 'phone'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });

        // delete
        $(document).ready(function() {
            $('body').on('click', '.delete', function() {
                var id = $(this).data('id');
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
                            url: '/manage/delete-listing/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Listing has been deleted.',
                                        'success'
                                    ).then(() => {
                                        window.location.reload();
                                    });
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>

@endpush