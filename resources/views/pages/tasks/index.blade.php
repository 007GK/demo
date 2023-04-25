<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        <div class='row'>
            <div class="col-12 text-end">
                <a href="{{ route('task.create') }}" class="btn btn-sm btn-primary m-2">Create Task</a>
            </div>
        </div>
        <!--begin::Card body-->
        <div class="card-body pt-6">
            @include('pages.tasks._table')
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    
@stack('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        @if(session()->has('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ session()->get('success') }}"
            })
        @endif

        @if(session()->has('error'))
            Toast.fire({
                icon: 'error',
                title: "{{ session()->get('error') }}"
            })
        @endif

        $(document).on('click','.delete',function(){
            var t = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'Delete',
                            url: t.data('destroy'),  
                            success: function(response){
                                if(response.status == 200){
                                    location.reload();
                                }
                            } 
                        });

                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    }    
                })
        });
  </script>

</x-base-layout>
