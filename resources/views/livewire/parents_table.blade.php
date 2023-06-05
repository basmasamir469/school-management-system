<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showformadd" type="button">{{ trans('Parent_trans.add_parent') }}</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('Parent_trans.Email') }}</th>
            <th>{{ trans('Parent_trans.father_name') }}</th>
            <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
            <th>{{ trans('Parent_trans.Passport_ID_Father') }}</th>
            <th>{{ trans('Parent_trans.Phone_Father') }}</th>
            <th>{{ trans('Parent_trans.father_job') }}</th>
            <th>{{ trans('grades.Actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($my_parents as $my_parent)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $my_parent->email }}</td>
                <td>{{ $my_parent->father_name }}</td>
                <td>{{ $my_parent->father_national_id }}</td>
                <td>{{ $my_parent->father_passport_id }}</td>
                <td>{{ $my_parent->father_phone }}</td>
                <td>{{ $my_parent->father_job }}</td>
                <td>
                    <button wire:click="edit({{ $my_parent->id }})" title="{{ trans('main_trans.Edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})"  title="{{ trans('main_trans.Delete') }}"><i class="fa fa-trash"></i></button>

                    {{-- <div class="modal" id="delete{{$my_parent->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">{{trans('main_trans.Delete')}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p>{{trans('main_trans.Are you sure to delete this row?')}}</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" wire:click="delete({{ $my_parent->id }})" class="btn btn-danger">{{trans('main_trans.Delete')}}</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                            </div>
                          </div>
                        </div>
                      </div> --}}
                </td>
            </tr>
        @endforeach
    </table>
</div>