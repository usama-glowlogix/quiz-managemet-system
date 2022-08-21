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
        <div class="row">
            <div class="col-12">

                <div class="btn-group mb-2">
                    <div>
                        <a href="{{ url('/admin/question') }}" class="btn btn-success"><i class="fas fa-arrow-left"
                                aria-hidden="true"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>

        <form id="add_category" class="form-horizontal" method="POST" action="/admin/question/update"
        enctype="multipart/form-data">
        {{-- $user->user_type=='user' ? $user=User::where('id','$user->id')-where('user_type','user')->fisrt() : $washer=$user->user_type='washer';
        return $user; --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="card-body">
                            <h4 class="card-title">Update Question</h4>
                            <div class="form-group row">
                                <label for="title"
                                    class="col-sm-3 text-right control-label col-form-label">Question</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="{{ $question->id }}">
                                    <input type="text" name="question" class="form-control" id="title"
                                        placeholder="Question" value="{{ $question->question ?? '' }}">
                                </div>

                                    <div class="col-sm-5 mt-3 text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#answerModal">
                                        Add Answer
                                      </button>
                                    </div>

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
                                            <th>No.</th>
                                            <th>Title</th>
                                            <th>Is Correct</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($question->questionHasOption as $key => $questionOption)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td><input type="hidden" name="question_option[{{ $key }}]"
                                                        value="{{ $questionOption->answer }}"><input type="hidden"
                                                        name="db_id[]"
                                                        value="{{ $questionOption->id }},{{ $key }}">{{ $questionOption->answer }}
                                                </td>
                                                <td><input type="hidden" name="is_correct[{{ $key }}]"
                                                        @if ($questionOption->is_correct == 0) value="Incorrect Answer" @else value="Correct Answer" @endif>
                                                    @if ($questionOption->is_correct == 1)
                                                        Correct Answer
                                                    @else
                                                        Incorrect
                                                    @endif
                                                </td>
                                                <td class="text-nowrap">
                                                    <button type="button" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                        data-toggle="modal" id="{{ $key }}delete_item_button"
                                                        value="{{ $questionOption->answer }}"data-target="#deleteError"
                                                        data-target="#deleteAnswer"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
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
                <div class="row">
                    <div class="col-sm-12">
                        <input type="text" id="answer" name="answer"class="form-control" id="title" placeholder="Answer">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label for="cono1" class=" text-right control-label col-form-label"><input type="checkbox" id="is-correct" name="is_correct"/> Mark as Correct </label>
                        </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="addQuestionOption(document.getElementById('answer').value);"><i class="feather icon-plus-circle mr-25"></i>Add</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>


    <!-- ============================================================== -->
    <!-- End Container fluid  -->
@endsection
@section('js')
    <script>
        var count = 1;
        var answerTable = $('#zero_config');

        function addQuestionOption(input) {
            if (input != '') {
                if ($('#is-correct').is(":checked")) {
                    var is_correct = "Correct Answer"
                    $('#is-correct').attr('disabled', true);
                } else {
                    var is_correct = "Incorrect Answer"
                }
                // $('#is-correct').attr('checked', false);
                $('input[type=checkbox]').prop('checked', false);
                $('#answer').val('');
                $('.modal').modal('hide');
                inputQuestionOption = '<input type="hidden" name="question_option[]" value="' + input + '">';
                inputCheckbox = '<input type="hidden" name="is_correct[]" value="' + is_correct + '">';
                action =
                    '<button type="button" id="delete_item_button" class="btn btn-sm btn-clean btn-icon btn-icon-md" id="' +
                    count + '" value="' + input + '" data-toggle="modal" ' +
                    'data-target="#" ><i class="fa fa-trash" aria-hidden="true"></i></button>';
                answerTable.append(
                    '<tr><td>' + count + '</td>' +
                    '<td>' + inputQuestionOption + input + '</td>' +
                    '<td>' + inputCheckbox + is_correct + '</td>' +
                    '<td>' + action + '</td>' +
                    '</tr>'
                )
                count++;
            }
            $('#zero_config').on('click', 'button[id="delete_item_button"]', function() {
                $(this).closest('tr').remove();
            });
            $('#deleteQuestion').on('show.bs.modal', function (event) {
          var id = $(event.relatedTarget).attr('id');
          var value = $(event.relatedTarget).val();
          console.log(id, value);
          $(this).find("#title").text(value);
          $(this).find(".delete-btn").val(value);
          $(this).find(".delete-btn").attr('id', id);
          // $(this).find("#title").textContent =value;
      });
            function deleteQuestionOption(deletebtn) {
                var id = $(deletebtn).attr('id');
                var value = $(deletebtn).val();
                // console.log($('input[value="+ value +"]'))
                answerTable.row($('#zero_config :input[value="' + value + '"]').parent('td').parent('tr')).remove();
                // $("#question-option-table :input[value='+ id +']").parent('td').parent('tr').remove();
                // answerTable.row( $('#question-option-table :input[value='+ value +']').parent('td').parent('tr') ).remove().draw();
                $('.modal').modal('hide');
            }
        }
    </script>
@endsection
