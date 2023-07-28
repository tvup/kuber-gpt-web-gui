@extends('layouts.frontend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/frontend.scss'])
@endsection

@section('content')
    <div class="flex bg-white">
        <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">

            <article id="post-180" class="post-180 page type-page status-publish hentry">
                <!-- Area contenuti della pagina -->
                <div class="page-content">
                    <h2 class="text-2xl font-bold">Termini dell'Abbonamento</h2>
                    <ol class="list-decimal list-inside ml-6">
                        <li>Questi termini si applicano a kuber-gpt.com, qui di seguito denominato "piattaforma".</li>
                        <li>Abbonarsi a un piano:
                            <ol class="list-decimal list-inside ml-6">
                                <li>L'abbonamento viene creato completando un ordine sul sito web https://kuber-gpt.com, qui di seguito denominato "sito web".</li>
                                <li>Sono accettati solo pagamenti con i seguenti fornitori:
                                    <ol class="list-decimal list-inside ml-6">
                                        <li>Visa</li>
                                        <li>Mastercard</li>
                                        <li>American Express</li>
                                    </ol>
                                </li>
                                <li>L'abbonamento continua fino a quando non viene cancellato da una delle parti.</li>
                                <li>Ogni periodo di abbonamento è di un mese, e il rinnovo automatico avverrà a meno che il pagamento non possa essere elaborato.</li>
                                <li>I prezzi di ciascun prodotto sono indicati sul sito web e includono l'IVA.</li>
                                <li>L'IVA viene sempre addebitata sugli abbonamenti e altri prodotti.</li>
                            </ol>
                        </li>
                        <li>Cancellazione dell'abbonamento:
                            <ol class="list-decimal list-inside ml-6">
                                <li>Il fornitore può cancellare gli abbonamenti con un preavviso di un mese prima della fine del periodo di abbonamento.</li>
                                <li>Il sottoscrittore può cancellare gli abbonamenti immediatamente o alla fine del periodo di abbonamento successivo. Non verranno forniti rimborsi indipendentemente dalla data di cancellazione.
                                    <ol class="list-decimal list-inside ml-6">
                                        <li>Se il sottoscrittore non specifica esplicitamente se la cancellazione deve essere immediata o alla fine del periodo di abbonamento, sarà applicabile la seconda opzione.</li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                        <li>Obligazioni del Fornitore:
                            <ol class="list-decimal list-inside ml-6">
                                <li>Il fornitore si impegna a mantenere il sistema disponibile per l'utente al 99% del tempo.</li>
                                <li>Le interruzioni pianificate non rientrano nella disponibilità sopra menzionata.</li>
                                <li>Il fornitore non può essere ritenuto responsabile per eventuali perdite subite dagli abbonati a causa di interruzioni del servizio o errori di sistema.</li>
                            </ol>
                        </li>
                        <li>Obligazioni dell'Abbonato:
                            <ol class="list-decimal list-inside ml-6">
                                <li>L'abbonato deve assicurarsi che le informazioni personali come nome, indirizzo, e-mail e dettagli di pagamento siano aggiornati.</li>
                                <li>L'abbonato deve essere disposto a ricevere informazioni sulle modifiche al sistema tramite e-mail.</li>
                            </ol>
                        </li>
                        <li>Modifiche ai termini:
                            <ol class="list-decimal list-inside ml-6">
                                <li>Le modifiche saranno notificate un mese prima.</li>
                            </ol>
                        </li>
                    </ol>
                    <h2 class="text-2xl font-bold">Condizioni di Commercio</h2>
                    <p class="font-semibold">Pagamento</p>
                    <p class="mb-4">Torben IT ApS accetta pagamenti con VISA, Mastercard e American Express.</p>
                    <p class="mb-4">Tutte le somme sono in DKK (Corone danesi) e includono l'IVA.</p>
                    <p class="mb-4">Torben IT ApS (CVR n. 39630605) utilizza un server di pagamento approvato che crittografa tutte le informazioni della tua carta con il protocollo SSL (Secure Socket Layer). Ciò significa che le tue informazioni non possono essere intercettate.</p>
                    <p class="font-semibold">Opzioni di Reclamo - panoramica e link:</p>
                    <p class="mb-4">Se hai un reclamo su un abbonamento acquistato tramite il sito web, puoi inviare un reclamo a:</p>
                    <p class="mb-4">Centro Risoluzione Controversie dell'Agenzia per la Concorrenza e i Consumatori<br>Carl Jacobsens Vej 35<br>2500 Valby<br>Link: <a href="http://www.forbrug.dk/" class="text-blue-500 underline">www.forbrug.dk</a></p>
                    <p class="mb-4">Se sei un consumatore residente in un altro paese dell'UE, puoi inviare il tuo reclamo sulla piattaforma di reclamo online della Commissione europea.</p>
                    <p class="mb-4">La piattaforma si trova qui: <a href="http://ec.europa.eu/consumers/odr/" class="text-blue-500 underline">http://ec.europa.eu/consumers/odr/</a><br>Se invii un reclamo qui, devi fornire il nostro indirizzo e-mail: contact@torbenit.dk</p>
                </div><!-- .entry-content -->
                <!-- Modifica link per modificare la pagina -->
            </article>

        </div>
        <div class="hidden lg:block lg:w-1/2" style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)">
            <div class="h-full object-cover"
                 style="background-image: url(https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80)">
                <div class="h-full bg-black opacity-25"></div>
            </div>
        </div>
    </div>
@endsection
