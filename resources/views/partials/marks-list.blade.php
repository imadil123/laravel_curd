<div class="subjects-container">
    <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="text-center" style="width:50px;">S.no</th>
                    <th scope="col" style="width:300px;">Student Name</th>
                    <th scope="col" style="width:300px;">Subject</th>
                    <th scope="col" style="width:300px;">marks</th>
                    <th scope="col" style="width:100px;">Update</th>
                    <th scope="col" style="width:100px;">Delete</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($subject as $id => $sub)
                    <tr>
                        <td class="text-center">{{ $id + 1}}</td>
                        <td>{{ $sub->subject }}</td>
                        <td>{{ $sub->status }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm updateSubjectBtn"
                                data-id="{{ $sub->id }}"
                                data-name="{{ $sub->subject }}"
                                data-status="{{ $sub->status}}"
                                data-route="{{ route('subjects.update', $sub->id) }}"
                                data-bs-toggle="modal"
                                data-bs-target="#updateSubjectModal">
                                Update
                            </button>
                        </td>
                        <td><button class="btn btn-danger btn-sm deleteStudentBtn" data-id="{{ $sub->id }}">
                            Delete
                        </button>
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
            
        </table>
        <div class="d-flex">
            <div id="pagination-wrapper">
                {{-- {{ $subject->links('pagination::bootstrap-4') }} --}}
            </div>
        </div>
</div>
