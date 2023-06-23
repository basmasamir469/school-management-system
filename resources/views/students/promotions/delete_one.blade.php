<div class="modal fade" id="deleteOnePromotion{{$promotion->id}}"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{trans('Students_trans.rollback_student')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  id="deletePromotion" promotion_id="{{$promotion->id}}">
        <div class="modal-body">
          <p>{{trans('Students_trans.warning_message')}}</p>
          <input type="hidden" name="id" value="{{$promotion->id}}">
        </div>
        <div class="modal-footer">
          <button type="submit"  class="btn btn-danger">{{trans('main_trans.Delete')}}</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
        </div>
    </form>
      </div>
    </div>
  </div>