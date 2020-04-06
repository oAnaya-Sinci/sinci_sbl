    @extends('principal')
    @section('contenido')

    @if(Auth::check())
            @if (Auth::user()->idrol == 1)
            <template v-if="menu==0">
                <h1>OEE</h1>
                <oee></oee>
            </template>

            <template v-if="menu==1">
                <machine></machine>
            </template>

            <template v-if="menu==2">
                <variable></variable>
            </template>
            <template v-if="menu==3">
                <type_event></type_event>
            </template>

            <template v-if="menu==7">
                <user></user>
            </template>

            <template v-if="menu==8">
                <rol></rol>
            </template>

            @elseif (Auth::user()->idrol == 2)
            <template v-if="menu==0">
                <h1>OEE</h1>
            </template>
            <template v-if="menu==1">
                <graficvar></graficvar>
            </template>
            @else

            @endif

    @endif
       
        
    @endsection