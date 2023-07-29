@extends('layouts.frontend')

@section('title', 'Historien')

@section('css')
    @vite(['resources/sass/frontend.scss'])
@endsection

@section('content')
    <div class="flex flex-wrap">
        <section class="w-full">
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <h1 class="text-2xl mb-4">La Storia</h1>
                        <h3 class="text-xl">L'idea principale dell'azienda è sempre stata quella di utilizzare la tecnologia per rendere le cose un po' più facili. È ora di creare una nuova sensazione.</h3>
                    </div>
                    <div>
                        <!-- Div vuoto -->
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full">
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <h6>Dopo aver avuto piccole attività di nicchia</h6>
                        <h2 class="text-2xl mb-4">Il nostro viaggio è iniziato nel 2018</h2>
                        <p>Tutto è iniziato con un piccolo negozio online che offriva prodotti da un piccolo magazzino in cantina. L'automazione era al centro dell'attenzione per creare un processo che richiedesse il minimo tempo per elaborare gli ordini, in modo che l'attenzione potesse essere focalizzata sull'attività stessa e i costi potessero essere mantenuti bassi.</p>
                    </div>
                    <div>
                        <img class="w-full h-auto" src="{{ asset('media/images/about_03.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full">
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <img class="w-full h-auto" src="{{ asset('media/images/about_02.jpg') }}" alt="">
                    </div>
                    <div>
                        <h6>Dall'inizio, l'azienda è cresciuta</h6>
                        <h2 class="text-2xl mb-4">Da un piccolo magazzino a oltre 18.000 prodotti</h2>
                        <p>L'idea di base è stata preservata, ma le visioni sono diventate più grandi. E ora vogliamo utilizzare le nostre risorse per offrire una vasta gamma di prodotti a prezzi convenienti.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full">
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <h6>E pianifichiamo altro</h6>
                        <h2 class="text-2xl mb-4">Siamo solo all'inizio</h2>
                        <p>In sostanza, ci sono solo due stati: in fase di sviluppo o in declino. E poiché abbiamo perso interesse nel gestire il negozio online, ora sono l'unico a scrivere questo capitolo. Ma non sarà l'ultimo, e sono sicuro che un giorno l'ufficio sarà di nuovo pieno di persone.</p>
                    </div>
                    <div>
                        <img class="w-full h-auto" src="{{ asset('media/images/about_01.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
    </div>




@endsection


