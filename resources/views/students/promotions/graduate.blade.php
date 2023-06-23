<!-- Deleted inFormation Student -->
<div class="modal fade" id="graduateStudent{{$promotion->student_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('Students_trans.graduate_student')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">

                    <h5 style="font-family: 'Cairo', sans-serif;">{{ trans('Students_trans.Are you sure of this graduation?') }}</h5>
                    <input type="text" readonly value="{{$promotion->student->student_name}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                        <button type="button" id="graduateStudent" student_id="{{$promotion->student_id}}" class="btn btn-danger">{{trans('Students_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>