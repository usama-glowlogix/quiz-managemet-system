@extends('layouts.master_admin')
@section('css')
@endsection
@section('content')
<!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                @if(count($quizzes) != 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Questions</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Quiz Time</th>
                                                <th>Question</th>
                                                <th>Passing Score</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($quizzes as $index=>$quiz)
                                            <tr>

                                                <td>{{$quiz->title}}</td>
                                                <td>{{$quiz->quiz_time}}</td>
                                                @foreach ($quiz->questions as $key => $question)
                                                <td>
                                                    {{$question->question}}
                                                </td>
                                                @endforeach
                                                <td>{{$quiz->passing_score}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <div class="pull-left" style="margin-right: 10px;">
                                                            <a href="/admin/attempt-quiz/{{ $quiz->id }}" class="btn btn-success"><i class="fas fa-pencil-alt" aria-hidden="true"></i>Attempt Quiz</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                No Quiz Yet Created...
                @endif
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
@endsection
@section('js')

@endsection
