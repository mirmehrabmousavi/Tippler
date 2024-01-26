@extends('admin.layouts.app')

@section('title', 'Home')

@section('content')
   <div class="row">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   <h4 class="card-title"><i class="fa fa-users"></i> کاربران {{verta()->year}}</h4>
               </div>
               <div class="card-body">
                   <canvas id="UsersChart" height="100px"></canvas>
               </div>
           </div>
       </div>
   </div>
@endsection

@section('script')
    <script type="text/javascript">
        var farvardinUser = {!! json_encode($farvardinUser, JSON_HEX_TAG) !!};
        var ordibeheshtUser = {!! json_encode($ordibeheshtUser, JSON_HEX_TAG) !!};
        var khordadUser = {!! json_encode($khordadUser, JSON_HEX_TAG) !!};
        var tirUser = {!! json_encode($tirUser, JSON_HEX_TAG) !!};
        var mordadUser = {!! json_encode($mordadUser, JSON_HEX_TAG) !!};
        var shahrivarUser = {!! json_encode($shahrivarUser, JSON_HEX_TAG) !!};
        var mehrUser = {!! json_encode($mehrUser, JSON_HEX_TAG) !!};
        var abanUser = {!! json_encode($abanUser, JSON_HEX_TAG) !!};
        var azarUser = {!! json_encode($azarUser, JSON_HEX_TAG) !!};
        var deyUser = {!! json_encode($deyUser, JSON_HEX_TAG) !!};
        var bahmanUser = {!! json_encode($bahmanUser, JSON_HEX_TAG) !!};
        var esfandUser = {!! json_encode($esfandUser, JSON_HEX_TAG) !!};
        //Manager
        var farvardinManager = {!! json_encode($farvardinManager, JSON_HEX_TAG) !!};
        var ordibeheshtManager = {!! json_encode($ordibeheshtManager, JSON_HEX_TAG) !!};
        var khordadManager = {!! json_encode($khordadManager, JSON_HEX_TAG) !!};
        var tirManager = {!! json_encode($tirManager, JSON_HEX_TAG) !!};
        var mordadManager = {!! json_encode($mordadManager, JSON_HEX_TAG) !!};
        var shahrivarManager = {!! json_encode($shahrivarManager, JSON_HEX_TAG) !!};
        var mehrManager = {!! json_encode($mehrManager, JSON_HEX_TAG) !!};
        var abanManager = {!! json_encode($abanManager, JSON_HEX_TAG) !!};
        var azarManager = {!! json_encode($azarManager, JSON_HEX_TAG) !!};
        var deyManager = {!! json_encode($deyManager, JSON_HEX_TAG) !!};
        var bahmanManager = {!! json_encode($bahmanManager, JSON_HEX_TAG) !!};
        var esfandManager = {!! json_encode($esfandManager, JSON_HEX_TAG) !!};
        //Admin
        var farvardinAdmin = {!! json_encode($farvardinAdmin, JSON_HEX_TAG) !!};
        var ordibeheshtAdmin = {!! json_encode($ordibeheshtAdmin, JSON_HEX_TAG) !!};
        var khordadAdmin = {!! json_encode($khordadAdmin, JSON_HEX_TAG) !!};
        var tirAdmin = {!! json_encode($tirAdmin, JSON_HEX_TAG) !!};
        var mordadAdmin = {!! json_encode($mordadAdmin, JSON_HEX_TAG) !!};
        var shahrivarAdmin = {!! json_encode($shahrivarAdmin, JSON_HEX_TAG) !!};
        var mehrAdmin = {!! json_encode($mehrAdmin, JSON_HEX_TAG) !!};
        var abanAdmin = {!! json_encode($abanAdmin, JSON_HEX_TAG) !!};
        var azarAdmin = {!! json_encode($azarAdmin, JSON_HEX_TAG) !!};
        var deyAdmin = {!! json_encode($deyAdmin, JSON_HEX_TAG) !!};
        var bahmanAdmin = {!! json_encode($bahmanAdmin, JSON_HEX_TAG) !!};
        var esfandAdmin = {!! json_encode($esfandAdmin, JSON_HEX_TAG) !!};

        const labels = [
            'فروردین',
            'اردیبهشت',
            'خرداد',
            'تیر',
            'مرداد',
            'شهریور',
            'مهر',
            'آبان',
            'آذر',
            'دی',
            'بهمن',
            'اسفند',
        ];

        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'کاربر',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [
                        farvardinUser,
                        ordibeheshtUser,
                        khordadUser,
                        tirUser,
                        mordadUser,
                        shahrivarUser,
                        mehrUser,
                        abanUser,
                        azarUser,
                        deyUser,
                        bahmanUser,
                        esfandUser,
                    ],
                },
                {
                    label: 'فروشنده',
                    backgroundColor: '#1976D2',
                    borderColor: '#1976D2',
                    data: [
                        farvardinManager,
                        ordibeheshtManager,
                        khordadManager,
                        tirManager,
                        mordadManager,
                        shahrivarManager,
                        mehrManager,
                        abanManager,
                        azarManager,
                        deyManager,
                        bahmanManager,
                        esfandManager,
                    ],
                },
                {
                    label: 'ادمین',
                    backgroundColor: '#388E3C',
                    borderColor: '#388E3C',
                    data: [
                        farvardinAdmin,
                        ordibeheshtAdmin,
                        khordadAdmin,
                        tirAdmin,
                        mordadAdmin,
                        shahrivarAdmin,
                        mehrAdmin,
                        abanAdmin,
                        azarAdmin,
                        deyAdmin,
                        bahmanAdmin,
                        esfandAdmin,
                    ],
                }
            ]
        }

        const config = {
            type: 'line',
            data: data,
            options: {}
        };

        const UsersChart = new Chart(
            document.getElementById('UsersChart'),
            config
        );
    </script>
@endsection
