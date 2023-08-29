<script type="text/javascript">
    $(function(){
        // Show Warehouse List
        var table = $('#ydatatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('warehouse.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'warehouse_name', name: 'warehouse_name'},
                { data: 'warehouse_address', name: 'warehouse_address'},
                { data: 'warehouse_phone', name: 'warehouse_phone'},
                { data: 'action', name: 'action', orderable:false, searchable:false},               
            ]
        });

        // Add Warehouse
        $('#add_warehouse').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('warehouse.store') }}",
                type: "POST",
                data: $('#add_warehouse').serialize(),
                success: function(resposne){
                    table.draw();
                    $('#addWarehouseModal').hide();
                    $('.modal-backdrop').remove();
                    $('#add_warehouse')[0].reset();
                    if(resposne){
                        toastr.success(resposne.message);
                    }                    
                }, 
                error: function(error){
                    if(error){
                        $('.error_name').html(error.responseJSON.errors.warehouse_name);
                        $('.error_address').html(error.responseJSON.errors.warehouse_address);
                        $('.error_phone').html(error.responseJSON.errors.warehouse_phone);
                    }
                }
            });            
        });

        // Edit Warehouse
        $('body').on('click', '.edit', function(e){
            const id = $(this).data('id');
            $.ajax({
                url: 'warehouse/' + id + '/edit',
                method: 'GET',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'   
                },
                success: function(response){
                    if(response){
                        $("#warehouse_id").val(response.id);
                        $("#w_name").val(response.warehouse_name);
                        $("#w_address").val(response.warehouse_address);
                        $("#w_phone").val(response.warehouse_phone);
                    }
                }
            });
        });

        // Udate Warehouse
        $('#editWarehouse').on('submit', function(e){
            e.preventDefault();
            const id = $('#warehouse_id').val();
            $.ajax({
                url: "{{ route('warehouse.update', '') }}" + '/' + id,
                method: 'PUT',
                data: $('#editWarehouse').serialize(),
                success: function(response){
                    table.draw();
                    $('#EditWarehouseModal').hide();
                    $('.modal-backdrop').remove();
                    $('#editWarehouse')[0].reset();
                    if(response){
                        toastr.success(response.message);
                    }                   
                },
                error: function(error){
                    if(error){
                        $('.error_name').html(error.responseJSON.errors.warehouse_name);
                        $('.error_address').html(error.responseJSON.errors.warehouse_address);
                        $('.error_phone').html(error.responseJSON.errors.warehouse_phone);
                    }
                }
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
                            url: "{{ route('warehouse.destroy', '') }}" + '/' + id,
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