<x-app-layout>
    <div class="container-fluid shadow-lg bg-white">
        <form id="reportForm" action="{{ route('payment_report_info') }}" method="POST">
            @csrf
            <div class="flex items-center gap-x-5 py-2">
                
                <div class="w-fit">
                    <label for="start_date">Start Date</label>
                    <div class="input-group date" style="width: 100%">
                        <input type="text" class="form-control datepicker" name="start_date" id="start_date" placeholder="Start Date" />
                    </div>      
                </div>
                <div class="">
                    <label for="end_date">End Date</label>
                    <div class="input-group date" style="width: 100%">
                        <input type="text" class="form-control datepicker" name="end_date" id="end_date" placeholder="End Date" />
                    </div>      
                </div>
                <div class="">
                    <label for="method">Transaction Method</label><br>
                    <select id="method" name="method" class="border rounded-md px-2 h-9 text-black bg-gray-200">
                        <option value="">Select Payment Method</option>
                        @foreach($methods as $method)
                            <option value="{{ $method->id }}">{{ $method->name }}</option>
                        @endforeach
                    </select>     
                </div>
                <div class="w-[300px]">
                    <label for="method">Customer Name</label><br>
                    <select id="customer" name="customer" class="w-[100%] border rounded-md px-2 h-9 text-black bg-gray-200">
                        <option value="">Select Customer</option>
                        @foreach($agents as $agent)
                            <option value="{{ $agent->getTable() }}_{{ $agent->id }}">{{ $agent->name }}</option>
                        @endforeach
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->getTable() }}_{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>     
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="bg-black px-5 py-2 text-white text-md rounded-md">Submit</button>
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
                        $('#reportdiv').html(response);
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