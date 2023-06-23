<div class="modal fade" id="deleteAllPromotions" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{trans('Students_trans.delete_promotions')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="deletePromotions">
        <div class="modal-body">
          <p>{{trans('Students_trans.warning_message')}}</p>
          <input type="hidden" name="delete_all" value="1">
        </div>
        <div class="modal-footer">
          <button type="submit"  class="btn btn-danger">{{trans('main_trans.Delete')}}</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
        </div>
    </form>
      </div>
    </div>
  </div>