<x-app-layout>
    <div class="container-fluid bg-white shadow-lg p-4 rounded-lg">
        {{-- <h3>fsdsdf</h3> --}}
        <form id="reportForm" action="{{ route('income_statement_report') }}" method="POST">
          @csrf
          <div class="flex items-center">
            
            
       
            <div class="form-group col-md-2">
                <label for="start_date">Start Date</label>
                <div class="input-group date" style="width: 100%">
                    <input type="text" class="form-control datepicker" name="start_date" id="start_date" placeholder="Start Date" />
                </div>      
            </div>
            <div class="form-group col-md-2">
                <label for="end_date">End Date</label>
                <div class="input-group date" style="width: 100%">
                    <input type="text" class="form-control datepicker" name="end_date" id="end_date" placeholder="End Date" />
                </div>      
            </div>
            
            
            
            <div class="flex items-center">
                <button type="submit" class="bg-black border-blue-500 text-white py-2 px-5 rounded-lg ">Submit</button>
            </div>
          </div>
      </form>
    </div>

    
    <div class="buttons justify-end flex gap-3 shadow-lg p-5 ">
        <button class="text-white bg-pink-600 font-bold text-md py-2 px-4">Send</button>
        <button id="printButton" class="text-white bg-blue-700 font-bold text-md py-2 px-4">Print</button>
        <button class="text-white bg-green-600 font-bold text-md py-2 px-4 ">ADD NEW INVOICE</button>
        <button class="text-white bg-black font-bold text-md py-2 px-4">GO BACK</button>
    </div> 

    <div class="reportdiv mt-5" id="reportdiv">

    </div>


    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
    <script>
        $(document).ready(function() {
           
            $('.datepicker').datepicker({
                autoclose: true
            });
    
            $('.select2').select2();

            // $('#ordertable').DataTable();

            $('#reportForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function (response) {
                        // Update the reportdiv with the response
                        // console.log(response);
                        $('#reportdiv').html(response.html);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });

        
    </script>
    <script>
        // Function to print the content of the reportdiv
        function printReport() {
            var printContents = document.getElementById("reportdiv").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    
        // Add event listener to the "Print" button
        document.querySelector("#printButton").addEventListener("click", function() {
            printReport();
        });
    </script>
</x-app-layout>