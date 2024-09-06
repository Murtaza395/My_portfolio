<h2 class="h5 no-margin-bottom text-center">Dashboard</h2>
</div>
</div>
<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
                    <div class="d-flex align-items-end justify-content-center">
                      <a href="{{route('admin.totalUsers')}}">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top"
                                src="https://getflywheel.com/wp-content/uploads/2018/04/2018-04-09_2018-Q2-Retreat_Customer-Success-5320.jpg"
                                alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-white">Total Clients ({{ $user }})</h5>
                            </div>
                        </div>
                      </a>
                      @foreach ($pro as $pro)
                      <a href="{{route('admin.allProjects',$pro->id)}}">
                                                  
                      @endforeach
                    <div class="card ms-3" style="width: 18rem;">
                      <img class="card-img-top"
                          src="https://www.techosquare.com/images/blog/website-development-project-plan-home.jpg"
                          alt="Card image cap">
                      <div class="card-body">
                          <h5 class="card-title text-white">Total Projects ({{ $project }})</h5>
                      </div>
                </div>
              </a>
                </div>
        </div>
    </div>
</section>

<footer class="footer sucess">
    <div class="footer__block block no-margin-bottom sucess ">
        <div class="container-fluid text-center">
            <p class="no-margin-bottom text-white">2024 &copy; By Murtaza Mughal</p>
        </div>
    </div>
</footer>
