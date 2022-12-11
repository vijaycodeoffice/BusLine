

        <aside class="left-sidebar bg-sidebar">

            <div id="sidebar" class="sidebar sidebar-with-footer">

              <!-- Aplication Brand -->

              <div class="app-brand">

                <a href="{{ route('dashboard')}}">

<img src="{{asset('assets/logo/appmainlogo.png')}}">

                  <span class="brand-name">BusLIne</span>

                </a>

              </div>

              <!-- begin sidebar scrollbar -->



<div class="sidebar-scrollbar">



    <!-- sidebar menu -->



    <ul class="nav sidebar-inner" id="sidebar-menu">

      <li class="has-sub">

        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard" aria-expanded="false" aria-controls="dashboard">

          <i class="mdi mdi-view-dashboard-outline"></i>

          <span class="nav-text">Master</span> <b class="caret"></b>

        </a>

        <ul class="collapse" id="dashboard" data-parent="#sidebar-menu">

          <div class="sub-menu">  

            <li  class="has-sub active expand" >

              <a class="sidenav-item-link" href="{{route('route')}}" data-toggle="" data-target=""

                aria-expanded="false" aria-controls="dashboard">

                <i class="mdi mdi-language-c"></i>&nbsp;&nbsp;&nbsp;&nbsp;

                <span class="nav-text">Routes</span> 

              </a>

    

            </li>   


			

			  <li  class="has-sub active expand" >

              <a class="sidenav-item-link" href="" data-toggle="" data-target=""

                aria-expanded="false" aria-controls="dashboard">

                <i class="mdi mdi-layers"></i>&nbsp;&nbsp;&nbsp;&nbsp;

                <span class="nav-text">Station</span> 

              </a>

    

            </li> 

          </div>

        </ul>

      </li>


    </ul>



  </div>





          </div>

        </aside>