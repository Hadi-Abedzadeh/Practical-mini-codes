Refrence: https://www.reddit.com/r/laravel/comments/2xeqz2/laravel_and_eloquent_count_with_chartjs/
and for ajax you can use this link: https://dyclassroom.com/chartjs/chartjs-how-to-create-line-graph-using-data-from-mysql-mariadb-table-and-php
Google url was searched: https://www.google.com/search?rlz=1C1GCEA_enIR936IR936&sxsrf=ALeKk03n3HyeFFzwOsmVzcOkoHZ0r4FItw:1621799880602&q=get+data+mysql+by+date+day+to+show+in+chart+js&spell=1&sa=X&ved=2ahUKEwjQ-p2uy-DwAhXPOcAKHeHsCJ4QBSgAegQIARAt&biw=1920&bih=969
keyword was searched: get data mysql by date day to show in chart js


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
