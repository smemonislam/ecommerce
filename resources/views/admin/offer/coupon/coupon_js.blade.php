<script type="text/javascript">
  $(function(){
    var table = $('#ydatatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('coupon.index') }}",
      columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'coupon_code', name: 'coupon_code' },
        { data: 'coupon_amount', name: 'coupon_amount' },
        { data: 'coupon_date', name: 'coupon_date' },
        { data: 'coupon_status', name: 'coupon_status' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
      ],
    });

    // Add Coupon
    $('#add-coupon').on('submit', function(e){
      e.preventDefault();   
      $('.error-messages').html('');   
      $.ajax({
        url: '{{ route("coupon.store") }}',
        type: "POST",
        data: $('#add-coupon').serialize(),
        success: function(response){                    
          table.draw();
          $('#addCouponModal').hide();
          $('.modal-backdrop').remove();
          if(response){            
            toastr.success(response.message);
            $('#add-coupon')[0].reset(); 
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
        url: "coupon/"+ id + "/edit",
        method: "GET",
        data: {
          id:id,
          _token: '{{ csrf_token() }}'
        },
        success: function(response){   
          $('#coupon_id').val(response.id); 
          $('#coupon_code').val(response.coupon_code);    
          $('#coupon_type option[value="'+response.coupon_type+'"]').attr("selected", "selected");  
          $('#coupon_amount').val(response.coupon_amount);       
          $('#coupon_date').val(response.coupon_date);   
          $('#coupon_status option[value="'+response.coupon_status+'"]').attr("selected", "selected");    
        }
      });
    });

   
    $('#update_coupon').on('submit', function(e){
      e.preventDefault();
      const id = $('#coupon_id').val();
      $.ajax({
        url: "{{ route('coupon.update', '') }}" + '/' + id,
        method: 'PUT',
        data: $(this).serialize(),
        success: function(response){
          table.draw();
          $('#EditCouponModal').hide();
          $('.modal-backdrop').remove();
          $('#update_coupon')[0].reset();
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
              url: "{{ route('coupon.destroy', '') }}" + '/' + id,
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