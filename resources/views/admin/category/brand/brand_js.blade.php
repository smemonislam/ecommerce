<script type="text/javascript">

    $(function(){
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });

        // Show Brand
        var table = $('#ydatatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('brands.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex'},
                { data: 'brand_name', name: 'brand_name'},
                { data: 'brand_slug', name: 'brand_slug'},
                { data: 'brand_image', name: 'brand_image', orderable:false, searchable:true },
                { data: 'front_page', name: 'front_page'},
                { data: 'action', name: 'action', orderable:false, searchable:false},               
            ]
        });

        // Add Child Category
        $('#upload_brands').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: "{{ route('brands.store') }}",
                method:"POST",
                data: new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(resposne){
                    table.draw();
                    $('#addBrandModal').hide();
                    $('.modal-backdrop').remove();
                    if(resposne){
                        toastr.success(resposne.message);
                    }                    
                }, 
                error: function(error){    
                                   
                    if(error){
                        $.each(error.responseJSON.errors, function(key, value){
                            $('.error-' + key).html(value);
                        });                        
                    }
                }
            });            
        });

        // Edit Category
        $('body').on('click', '.edit', function(){
            const id = $(this).data('id');
            $.get('brands/' + id + '/edit', function(data){
                $('#editBrand').html(data);
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
                            url: "{{ route('brands.destroy', '') }}" + '/' + id,
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