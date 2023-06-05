    <div>
      @if (!empty($successMessage))
         <div class="alert alert-success" id="success-alert">
             <button type="button" class="close" data-dismiss="alert">x</button>
             {{ $successMessage }}
         </div>
     @endif
     @if($showTable)
     @include('livewire.parents_table')
     @else
<div class="stepwizard">
     <div class="stepwizard-row setup-panel">
         <div class="stepwizard-step">
             <a href="#step-1" type="button"
                class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
             <p>{{ trans('Parent_trans.Step1') }}</p>
         </div>
         <div class="stepwizard-step">
             <a href="#step-2" type="button"
                class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
             <p>{{ trans('Parent_trans.Step2') }}</p>
         </div>
         <div class="stepwizard-step">
             <a href="#step-3" type="button"
                class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                disabled="disabled">3</a>
             <p>{{ trans('Parent_trans.Step3') }}</p>
         </div>
     </div>
 </div>

 @include('livewire.father-form')
 @include('livewire.mather-form')

 <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
     @if ($currentStep != 3)
         <div style="display: none" class="row setup-content" id="step-3">
             @endif
             <div class="col-xs-12 mt-5">
                 <div class="col-md-12">
                    <label style="color:black">{{trans('Parent_trans.Attachments')}}</label>
                    <div class="form-group">
                        <input class="form-control" type="file" wire:model="photos" accept="image/*" multiple>
                    </div>
                    <br>
                    @if($updateMode)
                    @if($images)
                    @foreach ($images as $image)
                        <img width="100" height="100" src="{{asset('parent_attachments/'.$National_ID_Father.'/'.$image)}}" alt="error">

                    @endforeach
                    @endif
                    @endif

                    <br><br>

                    <input type="hidden" wire:model="parent_id">
                     <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                             wire:click="back(2)">{{ trans('Parent_trans.Back') }}</button>
                     <button class="btn btn-success btn-sm btn-lg pull-right ml-1" wire:click="{{$updateMode?'submitForm_edit':'submitForm'}}"
                             type="button">{{ trans('Parent_trans.Finish') }}</button>
                 </div>
             </div>
         </div>
 </div>
 @endif
    </div>


