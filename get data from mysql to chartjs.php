//Laravel ORM
$start = '2021-04-12';
$end   = '2021-05-12';

// Get data from period
// $get_date = User::where('created_at', '>=', $start)->where('created_at', '<=', $end)->groupBy(DB::raw('DATE(users.created_at)'))->get([DB::raw('COUNT(*) as count'), DB::raw('DATE(users.created_at) as date')]);
  
// Get data from 7 day ago
// $get_date = User::where('created_at', '>=', DB::raw('DATE(NOW()) - INTERVAL 7 DAY'))->groupBy(DB::raw('DATE(users.created_at)'))->get([DB::raw('COUNT(*) as count'), DB::raw('DATE(users.created_at) as date')]);

// RAW QUERY

// select COUNT(*) as count, DATE(users.created_at) as date from `users` where `created_at` >= '2021-04-12' and `created_at` <= '2021-05-12' group by DATE(users.created_at)

// select COUNT(*) as count, DATE(users.created_at) as date from `users` where `created_at` >= DATE(NOW()) - INTERVAL 7 DAY group by DATE(users.created_at)

dd($get_date);
