<script type="text/javascript">
  $(function(){
    var table = $('#ydatatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('pickuppoint.index') }}",
      columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'pickup_point_name', name: 'pickup_point_name' },
        { data: 'pickup_point_address', name: 'pickup_point_address' },
        { data: 'pickup_point_phone', name: 'pickup_point_phone' },
        { data: 'pickup_point_phone_two', name: 'pickup_point_phone_two' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
      ],
    });

    // Add Coupon
    $('#add-pickup-point').on('submit', function(e){
      e.preventDefault();   
      $('.error-messages').html('');   
      $.ajax({
        url: '{{ route("pickuppoint.store") }}',
        type: "POST",
        data: $(this).serialize(),
        success: function(response){                    
          table.draw();
          $('#addPickupPointModal').hide();
          $('.modal-backdrop').remove();
          if(response){            
            toastr.success(response.message);
            $(this)[0].reset(); 
          }
        },
        error: function(error){
          if(error){
            $.each(error.responseJSON.errors, function(key, value){
              $('.error_' + key ).html(value);
            });
          }
        }
      });
    });

    $('body').on('click', '.edit', function(){
      const id = $(this).data('id');
      $.ajax({
        url: "pickuppoint/"+ id + "/edit",
        method: "GET",
        data: {
          id:id,
          _token: '{{ csrf_token() }}'
        },
        success: function(response){   
          console.log(response.pickup_point_name);
          $('#pickup_id').val(response.id); 
          $('#name').val(response.pickup_point_name);    
          $('#address').val(response.pickup_point_address);       
          $('#phone').val(response.pickup_point_phone);       
          $('#phone_two').val(response.pickup_point_phone_two);      
        }
      });
    });

   
    $('#update_pickup_point').on('submit', function(e){
      e.preventDefault();
      const id = $('#pickup_id').val();
      $.ajax({
        url: "{{ route('pickuppoint.update', '') }}" + '/' + id,
        method: 'PUT',
        data: $(this).serialize(),
        success: function(response){
          table.draw();
          $('#EditPickupPointModal').hide();
          $('.modal-backdrop').remove();           
          if(response){
            toastr.success(response.message);
          }                   
        },
        error: function(error){
          if(error){
            $.each(error.responseJSON.errors, function(key, value){
              $('.error_' + key ).html(value);
            });
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
              url: "{{ route('pickuppoint.destroy', '') }}" + '/' + id,
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