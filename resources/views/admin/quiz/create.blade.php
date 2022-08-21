@extends('layouts.master_admin')
@section('css')
@endsection
@section('content')
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <form id="add_category" class="form-horizontal" method="POST" action="{{ url('/admin/quiz/store') }}"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        {{ csrf_field() }}
                        <div class="card-body">
                            <h4 class="card-title">Create Quiz</h4>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Quiz
                                    Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="title"class="form-control" id="title"
                                        placeholder="Quiz Title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Passing
                                    Score</label>
                                <div class="col-sm-9">
                                    <input type="text" name="passing_score"class="form-control" id="title"
                                        placeholder="Passing Score">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Quiz
                                    Time</label>
                                <div class="col-sm-9">
                                    <input type="text" name="quiz_time"class="form-control" id="title"
                                        placeholder="Quiz Time">
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#answerModal">
                                    Add Answer
                                </button>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Questions</h5>
                                    <div class="table-responsive">
                                        <table id="zero_config" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Title</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body text-right">
                                        <input type="submit" class="btn btn-primary" value="Add Question"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </form>
    </div>
    </div>

    <div class="modal fade" id="answerModal" tabindex="-1" role="dialog" aria-labelledby="answerModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Answer</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="col-md-8">
                    <select id="question-select" class="form-control">
                      <option selected hidden value="">Select Question</option>
                      @if($questions->isNotempty())
                        @foreach($questions as $question)
                          <option value="{{$question->id}}">{{$question->question}}</option>
                        @endforeach
                      @endif

                    </select>
                  </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="addQuestion(document.getElementById('question-select').options[document.getElementById('question-select').selectedIndex])"><i class="feather icon-plus-circle mr-25"></i>Add</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>



      </div>

    <!-- editor -->
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
@endsection
@section('js')
<script>
    var count = 1;
    var questionTable=$('#zero_config');
    function addQuestion(selected) {
          console.log(selected.value)
          if(selected.value != "") {
              var id = selected.value;
              //$("#question-select").find("option:eq(0)").remove();
              val = '<input type="hidden" name="question[]" value="' + selected.value + '">';
              action = '<button type="button" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="modal" ' +
                  'data-target="#deleteQuestion" id="' + selected.value + '" value="' + selected.text + '"><i class="fa fa-trash"></i></button>';
                  questionTable.append(
                    '<tr><td>'+count+'</td>'+
                    '<td>'+val + selected.text+'</td>'+
                    '<td>'+action+'</td>' +
                    '</tr>'



            )
              count++;
              $("#question-select").find('option[value=' + id + ']').remove();
              $("#question-select").val("");
              $('#addQuestion').modal('toggle');
          }
      }
      function deleteQuestion(deleteBtn) {
          var id=$(deleteBtn).attr('id');
          var value=$(deleteBtn).val();
          questionTable.row( $('#zero_config :input[value='+ id +']').parent('td').parent('tr') ).remove().draw();
          $('#zero_config :input[value='+ id +']').parent('td').parent('tr').remove();
          $('#question-select').append($('<option>', {
              value: id,
              text: value
          }));
          count--;
          $('#deleteQuestion').modal('toggle');
      }
          $('#zero_config').on('click', 'input[value='+ id +']', function () {
            $(this).closest('tr').remove();
        });
          function deleteQuestionOption(deletebtn) {
          var id=$(deletebtn).attr('id');
          var value=$(deletebtn).val();
          // console.log($('input[value="+ value +"]'))
          answerTable.row( $('#zero_config :input[value="'+ value +'"]').parent('td').parent('tr') ).remove();
          // $("#question-option-table :input[value='+ id +']").parent('td').parent('tr').remove();
          // answerTable.row( $('#question-option-table :input[value='+ value +']').parent('td').parent('tr') ).remove().draw();
          $('.modal').modal('hide');
        }
</script>
@endsection
