<div class="students-container">        
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">S.no</th>
                <th scope="col">Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Subjects</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Age</th>
                <th scope="col">City</th>
                <th scope="col">Images</th>
                <th scope="col">View</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $id => $stu)
                <tr>
                    <td>{{ $id + 1}}</td>
                    <td>{{ $stu->name }}</td>
                    <td>{{ $stu->gender }}</td>
                    <td>
                        @php
                            $subjects = json_decode($stu->subjects, true); // Convert JSON to an array
                        @endphp
                        @if(is_array($subjects))  {{-- Ensure subjects is an array --}}
                            {{ implode(', ', $subjects) }}  {{-- Display as a comma-separated list --}}
                        @else
                            No subjects selected
                        @endif
                    </td>
                    <td>{{ $stu->email }}</td>
                    <td>{{ str_repeat('*', 10) }}</td>
                    <td>{{ $stu->age }}</td>
                    <td>{{ $stu->city }}</td>
                    <td><img src="{{ asset('/storage/' . $stu->fileName) }}" alt="{{ $stu->name }}" width="100"></td>
                    <td><a href="{{ route('view.user', $stu->id) }}" class="btn btn-primary btn-sm">View</a></td>
                    <td>
                        <button class="btn btn-warning btn-sm updateStudentBtn"
                            data-id="{{ $stu->id }}"
                            data-name="{{ $stu->name }}"
                            data-email="{{ $stu->email }}"
                            data-age="{{ $stu->age }}"
                            data-city="{{ $stu->city }}"
                            data-gender="{{ $stu->gender }}"
                            data-subjects="{{ json_encode($stu->subjects) }}"
                            data-image="{{ $stu->fileName }}"
                            data-bs-toggle="modal"
                            data-bs-target="#updateStudentModal">
                            Update
                        </button>
                    </td>
                    <td><button class="btn btn-danger btn-sm deleteStudentBtn" data-id="{{ $stu->id }}">
                        Delete
                    </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        <div id="pagination-links">
            {{ $students->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
