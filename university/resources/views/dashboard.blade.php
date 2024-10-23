@extends('includes.layout')
@section('title', 'Dashboard')

@section('navbarBrand')          
  <a class="navbar-brand" href="{{ url('dashboard') }}">Dashboard</a>
@endsection

@section('content')

    @if (session('message'))
        <h5>{{ session('message') }}</h5>
    @endif
    <div class="content">
        <div class="content">
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">school</i>
                            </div>
                            <p class="card-category">Etudiants</p>
                            <h3 class="card-title">1247</h3>
                            </div>
                            <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons text-danger">warning</i>
                                <a href="#">Get More Space...</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">work</i>
                        </div>
                        <p class="card-category">Enseignants</p>
                        <h3 class="card-title">78</h3>
                        </div>
                        <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">local_offer</i> Tracked from Google Analytics
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">engineering</i>
                        </div>
                        <p class="card-category">Employés</p>
                        <h3 class="card-title">60</h3>
                        </div>
                        <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">date_range</i> Last 24 Hours
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">summarize</i>
                        </div>
                        <p class="card-category">Cours</p>
                        <h3 class="card-title">371</h3>
                        </div>
                        <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> Just Updated
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">map</i>
                            </div>
                            <p class="card-category">Locations</p>
                            <h3 class="card-title">50</h3>
                            </div>
                            <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons text-danger">warning</i>
                                <a href="#">Get More Space...</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-pills card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">event_available</i>
                        </div>
                        <p class="card-category">Evénements</p>
                        <h3 class="card-title">98</h3>
                        </div>
                        <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">local_offer</i> Tracked from Google Analytics
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">newspaper</i>
                        </div>
                        <p class="card-category">Actualités</p>
                        <h3 class="card-title">49</h3>
                        </div>
                        <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">date_range</i> Last 24 Hours
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">email</i>
                        </div>
                        <p class="card-category">Messages</p>
                        <h3 class="card-title">590</h3>
                        </div>
                        <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">date_range</i> Last 24 Hours
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    <div class="card card-chart">
                        <div class="card-header card-header-rose" data-header-animation="true">
                        <div class="ct-chart" id="websiteViewsChart"></div>
                        </div>
                        <div class="card-body">
                        <div class="card-actions">
                            <button type="button" class="btn btn-danger btn-link fix-broken-card">
                            <i class="material-icons">build</i> Actualiser!
                            </button>
                            <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                            <i class="material-icons">refresh</i>
                            </button>
                            <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                            <i class="material-icons">edit</i>
                            </button>
                        </div>
                        <h4 class="card-title">Website Views</h4>
                        <p class="card-category">Last Campaign Performance</p>
                        </div>
                        <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> campaign sent 2 days ago
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="card card-chart">
                        <div class="card-header card-header-success" data-header-animation="true">
                        <div class="ct-chart" id="dailySalesChart"></div>
                        </div>
                        <div class="card-body">
                        <div class="card-actions">
                            <button type="button" class="btn btn-danger btn-link fix-broken-card">
                            <i class="material-icons">build</i> Actualiser!
                            </button>
                            <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                            <i class="material-icons">refresh</i>
                            </button>
                            <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                            <i class="material-icons">edit</i>
                            </button>
                        </div>
                        <h4 class="card-title">Daily Sales</h4>
                        <p class="card-category">
                            <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
                        </div>
                        <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated 4 minutes ago
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="card card-chart">
                        <div class="card-header card-header-info" data-header-animation="true">
                        <div class="ct-chart" id="completedTasksChart"></div>
                        </div>
                        <div class="card-body">
                        <div class="card-actions">
                            <button type="button" class="btn btn-danger btn-link fix-broken-card">
                            <i class="material-icons">build</i> Actualiser!
                            </button>
                            <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                            <i class="material-icons">refresh</i>
                            </button>
                            <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                            <i class="material-icons">edit</i>
                            </button>
                        </div>
                        <h4 class="card-title">Completed Tasks</h4>
                        <p class="card-category">Last Campaign Performance</p>
                        </div>
                        <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> campaign sent 2 days ago
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                            <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title">Listes des événements</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th>Job Position</th>
                                    <th>Since</th>
                                    <th class="text-right">Salary</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Andrew Mike</td>
                                    <td>Develop</td>
                                    <td>2013</td>
                                    <td class="text-right">&euro; 99,225</td>
                                    <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-info">
                                        <i class="material-icons">person</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-success">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger">
                                        <i class="material-icons">close</i>
                                    </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>John Doe</td>
                                    <td>Design</td>
                                    <td>2012</td>
                                    <td class="text-right">&euro; 89,241</td>
                                    <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-info btn-round">
                                        <i class="material-icons">person</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-success btn-round">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-round">
                                        <i class="material-icons">close</i>
                                    </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Alex Mike</td>
                                    <td>Design</td>
                                    <td>2010</td>
                                    <td class="text-right">&euro; 92,144</td>
                                    <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-info btn-link">
                                        <i class="material-icons">person</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-success btn-link">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-link">
                                        <i class="material-icons">close</i>
                                    </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>Mike Monday</td>
                                    <td>Marketing</td>
                                    <td>2013</td>
                                    <td class="text-right">&euro; 49,990</td>
                                    <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-info btn-round">
                                        <i class="material-icons">person</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-success btn-round">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-round">
                                        <i class="material-icons">close</i>
                                    </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td>Paul Dickens</td>
                                    <td>Communication</td>
                                    <td>2015</td>
                                    <td class="text-right">&euro; 69,201</td>
                                    <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-info">
                                        <i class="material-icons">person</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-success">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger">
                                        <i class="material-icons">close</i>
                                    </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons"></i>
                        </div>
                        <h4 class="card-title"> Vie estidiantine</h4>
                        </div>
                        <div class="card-body ">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="table-responsive table-sales">
                                <table class="table">
                                <tbody>
                                    <tr>
                                    <td>
                                        <div class="flag">
                                        <img src="img/flags/US.png" </div>
                                    </td>
                                    <td>USA</td>
                                    <td class="text-right">
                                        2.920
                                    </td>
                                    <td class="text-right">
                                        53.23%
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>
                                        <div class="flag">
                                        <img src="img/flags/DE.png" </div>
                                    </td>
                                    <td>Germany</td>
                                    <td class="text-right">
                                        1.300
                                    </td>
                                    <td class="text-right">
                                        20.43%
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>
                                        <div class="flag">
                                        <img src="img/flags/AU.png" </div>
                                    </td>
                                    <td>Australia</td>
                                    <td class="text-right">
                                        760
                                    </td>
                                    <td class="text-right">
                                        10.35%
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>
                                        <div class="flag">
                                        <img src="img/flags/GB.png" </div>
                                    </td>
                                    <td>United Kingdom</td>
                                    <td class="text-right">
                                        690
                                    </td>
                                    <td class="text-right">
                                        7.87%
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>
                                        <div class="flag">
                                        <img src="img/flags/RO.png" </div>
                                    </td>
                                    <td>Romania</td>
                                    <td class="text-right">
                                        600
                                    </td>
                                    <td class="text-right">
                                        5.94%
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>
                                        <div class="flag">
                                        <img src="img/flags/BR.png" </div>
                                    </td>
                                    <td>Brasil</td>
                                    <td class="text-right">
                                        550
                                    </td>
                                    <td class="text-right">
                                        4.34%
                                    </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                            </div>
                            <div class="col-md-6 ml-auto mr-auto">
                            <div id="worldMap" style="height: 300px;"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- End Navbar -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="header text-center">
                            <h3 class="title">FullCalendar.io</h3>
                            <p class="category">Handcrafted by our friends from
                                <a target="_blank" href="https://fullcalendar.io/" rel="nofollow">FullCalendar.io</a>. Please checkout their
                                <a href="https://fullcalendar.io/docs/" target="_blank" rel="nofollow">full documentation.</a>
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-10 ml-auto mr-auto">
                                <div class="card card-calendar">
                                <div class="card-body ">
                                    <div id="fullCalendar"></div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection