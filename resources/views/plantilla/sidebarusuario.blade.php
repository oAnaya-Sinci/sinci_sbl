@inject('users','App\Http\Controllers\UserController')
@inject('variables','App\Http\Controllers\VariableController')
<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> OEE</a>
                    </li>
                    @foreach($users->listMachinesUser() as $machine)
                        <li class="nav-item nav-dropdown">
                            <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-microchip"></i>{{$machine['name_machine']}}</a>
                            <ul class="nav-dropdown-items"> 
                                @foreach($variables->listVaribles($machine['id']) as $var)                          
                                    <li @click="menu=1" class="nav-item">
                                        <a class="nav-link" href="#"><i class="fa fa-bar-chart"></i>{{$var['name']}}</a>
                                    </li> 
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                    <li @click="menu=2" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Pareto</a>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
