    @extends('principal')
    @section('contenido')

    @if(Auth::check())
            @if (Auth::user()->idrol == 1)
            <template v-if="menu==0">
                <h1>Escritorio</h1>
            </template>

            <template v-if="menu==1">
                <machine></machine>
            </template>

            <template v-if="menu==2">
                <variable></variable>
            </template>

            <template v-if="menu==7">
                <user></user>
            </template>

            <template v-if="menu==8">
                <rol></rol>
            </template>

            @elseif (Auth::user()->idrol == 2)
    
            @else

            @endif

    @endif
       
        
    @endsection