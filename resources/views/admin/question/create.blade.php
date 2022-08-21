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
                <form id="add_category" class="form-horizontal"  method="POST" action="{{url('/admin/question/store')}}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                                {{ csrf_field() }}
                                <div class="card-body">
                                    <h4 class="card-title">Create Question</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Question</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="question"class="form-control" id="title" placeholder="Question">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4 text-right ml-4">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#answerModal">
                                            Add Answer
                                          </button>
                                        </div>
                                    </div>
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
                                                <th>No</th>
                                                <th>Title</th>
                                                <th>IsCorrect</th>
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
                                    <input  type="submit" class="btn btn-primary" value="Add Question"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
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


                  </div>
                  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="answerModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Add Answer</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <h1 class="text-center text-lg"><i class="ficon feather icon-x-circle text-danger"></i>
                            </h1>
                            <p>Are you sure you want to delete it?
                            </p>
                          </div>
                        <div class="modal-footer">
                            <button type="button" id="" value="" onclick="deleteQuestionOption(this)" class="btn btn-danger delete-btn">Yes</button>
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
    var answerTable=$('#zero_config');
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
              action= '<button type="button" id="delete_item_button" class="btn btn-sm btn-clean btn-icon btn-icon-md" id="' + count + '" value="' + input + '" data-toggle="modal" ' +
                  'data-target="#" ><i class="fa fa-trash" aria-hidden="true"></i></button>';
                  answerTable.append(
                    '<tr><td>'+count+'</td>'+
                    '<td>'+inputQuestionOption+input+'</td>'+
                    '<td>'+inputCheckbox + is_correct+'</td>'+
                    '<td>'+action+'</td>' +
                    '</tr>'
                  )
              count++;
          }
          $('#zero_config').on('click', 'button[id="delete_item_button"]', function () {
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
      }
</script>
@endsection
