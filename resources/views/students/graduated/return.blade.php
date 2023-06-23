<!-- Deleted inFormation Student -->
<div class="modal fade" id="returnStudent{{$student->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('Students_trans.rollback_student') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  method="post" autocomplete="off">
                    <h5 style="font-family: 'Cairo', sans-serif;">{{ trans('main_trans.Are you sure of this process?') }}</h5>
                    <input type="text" readonly value="{{$student->student_name}}" class="form-control">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                        <button type="button" id="returnStudent" student_id="{{$student->id}}" class="btn btn-danger">{{trans('main_trans.Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
