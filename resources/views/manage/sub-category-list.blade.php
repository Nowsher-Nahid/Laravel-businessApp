@extends('layouts/manage-layout')
@section('title', 'Aim Direct | Sub-category List')
@section('content')

    <div class="dashboard-headline">
        <h3>Sub-category List</h3>
        <nav id="breadcrumbs" class="dark">
            <ul>
                <li><a href="{{ route('sub_category.create') }}">Add Sub-category</a></li>
                <li>Sub-category List</li>
            </ul>
        </nav>
    </div>

    <table id="sub_category-list" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Sub-category</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

@endsection

@push('scripts')
    
    <script>
        $(function () {
            var table = $('#sub_category-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('sub_category.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    {data: 'title', name: 'title'},
                    {data: 'category', name: 'category'},
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
                            url: '/manage/delete-sub-category/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Sub-category has been deleted.',
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