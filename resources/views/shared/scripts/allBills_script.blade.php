
    <script type="text/javascript">
      $(document).ready(function(){

         $('.billInfo').on('click',function(){
                var bill_id = $(this).attr('data');
               
                 $.get("/ajax/bill/show/"+bill_id,function(data){

                     $('#billTime').val(data.bill.created_at);
                     $('#billID').val(data.bill.id);
                     $('#billDoctor').val(data.doctor.user_name);
                     $('#billPacient').val(data.pacient.user_name);
                     $('#billValue').val(data.bill.value);
                     $('#billPainValue').val(data.bill.paid_value);
                     $("#billDesc").val(data.bill.description);
                     $("#billSource").val(data.writter.name);
                     
                     $('#myModal').modal('show');

                 });


            });
           


      });
    </script>