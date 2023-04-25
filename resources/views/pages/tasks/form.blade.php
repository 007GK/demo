<x-base-layout>
<!--begin::Basic info-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('New Task') }}</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_profile_details" class="collapse show">
        <!--begin::Form-->
        <form id="kt_account_profile_details_form" class="form" method="POST" action="{{ empty($task) ? route('task.store') : route('task.update',$task->id) }}" enctype="multipart/form-data">
        @csrf
        @if(!empty($task))
            @method('PUT')
        @endif
        <!--begin::Card body-->
            <div class="card-body border-top p-9">
              
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Things to do') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Row-->
                        <div class="row">
                                <textarea  name="content" id="editor"> {{ $task->content ?? '' }}</textarea>
                        </div>
                        <span class="error mt-4 col-12 row d-none" id="editor-error">This field is required</span>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Responsible Person') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                      <select class="form-control" name="responsible_person" id="responsible_person">
                        <option value="1" {{ !empty($task) && $task->responsible_person == '1' ? 'selected' : '' }}>User 1</option>
                        <option value="2" {{ !empty($task) && $task->responsible_person == '2' ? 'selected' : '' }}>User 2</option>
                        <option value="3" {{ !empty($task) && $task->responsible_person == '3' ? 'selected' : '' }}>User 3</option>
                        <option value="4" {{ !empty($task) && $task->responsible_person == '4' ? 'selected' : '' }}>User 4</option>
                      </select>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="required">{{ __('Deadline') }}</span>
                    </label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="date" name="deadline" class="form-control form-control-lg form-control-solid" value="{{ old('deadline', $task->deadline ?? '') }}"/>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6 required">{{ __('Project') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <select class="form-control" name="project[]" id="project" data-control="select2" data-placeholder="{{ __('Select a Project...') }}" class="form-select form-select-solid form-select-lg fw-bold" multiple>
                            <option value="1">Project 1</option>
                            <option value="2">Project 2</option>
                            <option value="3">Project 3</option>
                            <option value="4">Project 4</option>
                        </select>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span>{{ __('Time Tracking') }}</span>
                    </label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="checkbox" name="time_tracking" {{ !empty($task->time_tracking) && $task->time_tracking ==1 ? 'checked' : '' }} >
                        <span>Task Planned Time</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Remind about task') }}</label>
                    <!--end::Label-->

                    <div class="col-lg-8 row">
                        <!--begin::Col-->
                        <div class="col-lg-6 fv-row">
                            <input type="datetime-local" name="reminder_date" class="form-control"  value="{{ !empty($task->reminder_date) ? $task->reminder_date : '' }}">
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-lg-6 fv-row">
                            <input type="text" name="reminder_notes" class="form-control" placeholder="Enter a note" value="{{ !empty($task->reminder_notes) ? $task->reminder_notes : '' }}" >
                        </div>
                         <!--end::Col-->
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Repeat Task') }}</label>
                    <!--end::Label-->

                       <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="checkbox" name="reminder" {{ !empty($task->reminder) && $task->reminder == 1 ? 'checked' : '' }}>
                        <span>Activate</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
               <!--begin::Input group-->
               <div class="row mb-6">
                    <!--begin::Label-->
                    <input type="submit" value=" {{ !empty($task) ? 'Update' : 'Create' }}" class="btn btn-primary col-4 m-auto" id="submit">
                    <!--end::Label-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card body-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
       let theEditor;
        ClassicEditor
                .create( document.querySelector( '#editor' ) ).
                then( editor => {
                        theEditor = editor;
                        console.log( editor );
                 }
                )
                .catch( error => {
                    console.error( error );
                } );
    </script>
    <script>
        @if(!empty($task->project))
         $('#project').val({!! json_encode(explode(',',$task->project)) !!}).change();
        @endif        

        $('#kt_account_profile_details_form').validate({ // initialize the plugin
            rules: {
                deadline: {
                    required: true,
                },
                "project[]": {
                    required: true,
                }
            },
            submitHandler: function (form) {
              if(theEditor.getData() == ''){
                $('#editor-error').removeClass('d-none');
              }else{
                form.submit();
              }
          }
        });
   

    </script>
@endsection

</x-base-layout>
