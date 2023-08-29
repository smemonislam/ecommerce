<script type="text/javascript">
    $(function(){
        // Show Child Category
        var table = $('#ydatatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('childcategory.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex'},
                { data: 'name', name: 'name'},
                { data: 'slug', name: 'slug'},
                { data: 'subcategory_id', name: 'subcategory_id'},
                { data: 'category_id', name: 'category_id'},
                { data: 'action', name: 'action', orderable:false, searchable:false},               
            ]
        });

        // Add Child Category
        $('body').on('click', '.childcategory', function(e){
            e.preventDefault();

            $.ajax({
                url: "{{ route('childcategory.store') }}",
                type: "POST",
                data: $('#childcategory').serialize(),
                success: function(resposne){
                    table.draw();
                    $('#addCategoryModal').hide();
                    $('.modal-backdrop').remove();
                    if(resposne){
                        toastr.success(resposne.message);
                    }
                    $('#childcategory')[0].reset();
                    
                }, 
                error: function(error){
                    if(error){
                        $('.error-messages').html(error.responseJSON.errors.name);
                    }
                }
            });            
        });

        // Edit Category
        $('body').on('click', '.edit', function(){
            const id = $(this).data('id');
            $.get('childcategory/' + id + '/edit', function(data){
                $('#editChildCategory').html(data);
            });
        });

        $('body').on('click', "#delete", function( e ){
            e.preventDefault();
            const id = $(this).data('id');    
            swal({
                title: "Are you sure?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    swal({
                        title: 'Delete Confirm',
                        text: '',
                        type: 'success'
                    }, function() {
                    $.ajax({
                            url: "{{ route('childcategory.destroy', '') }}" + '/' + id,
                            type: "DELETE",
                            data: {
                            "_token": "{{ csrf_token() }}"
                            },
                            success: function(response){
                                table.draw();
                                if(response){
                                toastr.success(response.success);                         
                                }
                            }
                        });
                    });
                } else {
                    swal("Cancel", "Data Safe!!", "error");
                }
            });      
        });

    });
</script>