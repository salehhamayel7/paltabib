<script type="text/javascript">
      $(document).ready(function(){

         $('.expenseInfo').on('click',function(){
                var expense_id = $(this).attr('data');
               
                 $.get("/ajax/expense/show/"+expense_id,function(data){

                     $('#expenseTime').val(data.expense.created_at);
                     $('#expenseID').val(data.expense.id);
                     $('#expenseValue').val(data.expense.value);
                     $("#expenseDesc").val(data.expense.description);
                     $("#expenseSource").val(data.writter.name);
                     
                     $('#myModal').modal('show');

                 });
            });
      });
    </script>