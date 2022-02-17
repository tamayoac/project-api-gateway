@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="bg-white shadow p-5 max-w-7xl mx-auto mt-6 z-10">
    <div class="flex">
        <div class="pl-1 w-96 h-20 bg-green-600 rounded-lg shadow-md mx-4">
            <div class="flex w-full h-full py-2 px-4 bg-green-400 rounded-lg justify-between">
              <div class="my-auto">
                <a href="/users" class="font-bold uppercase">Users</a>
                
                <p class="text-lg">{{$users->count()}}</p>
              </div>
              <div class="my-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>                   
              </div>
            </div>
        </div>
        <div class="pl-1 w-96 h-20 bg-blue-600 rounded-lg shadow-md mx-2">
            <div class="flex w-full h-full py-2 px-4 bg-blue-400 rounded-lg justify-between">
              <div class="my-auto">
                <p class="font-bold uppercase">Applications</p>
                <p class="text-lg">{{$applications->count()}}</p>
              </div>
              <div class="my-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>               
                </div>
            </div>
        </div>
        <div class="pl-1 w-96 h-20  bg-purple-600 rounded-lg shadow-md mx-4">
            <div class="flex w-full h-full py-2 px-4 bg-purple-400 rounded-lg justify-between">
              <div class="my-auto">
                <p class="font-bold">TASKS</p>
                <p class="text-lg">50%</p>
              </div>
              <div class="my-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
      </svg>
              </div>
            </div>
          </div>
    </div>
    <div class="flex mt-10 border-t">
        <div class="w-1/2 mt-8">
            <canvas id="doughnut" height="150" width="300"></canvas>
        </div>
        <div class="w-1/2">
         
        </div>
    </div>
   
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script> 
    var users_count = @json($users_count);
    var application_list = @json($application_list);

    console.log(users_count);
    var data2 = {
        labels: application_list,
        datasets: [
            {
                label: "Application Users",
                data: users_count,
                backgroundColor: [
                    "#f77171",
                    "#fbbe24",
                ],
                borderColor: [
                    "#f77171",
                    "#fbbe24",
                ],
                borderWidth: [1, 1, 1, 1, 1]
            }
        ]
    };

    var options = {
        elements: {
            rectangle: {
                borderWidth: 2,
                borderColor: '#c1c1c1',
                borderSkipped: 'bottom'
            }
        },
        responsive: true,
        title: {
            display: true,
            text: 'Users per application'
        }
    }

    window.onload = function() {
        var ctx = document.getElementById("doughnut");
        window.myBar = new Chart(ctx, {
            type: 'doughnut',
            data: data2,
            options: options
        });
    };
</script>
@endsection