@extends('layouts.frontend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/frontend.scss'])
@endsection

@section('content')
    <div class="flex bg-white">
        <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">
            <article id="post-178" class="post-178 page type-page status-publish hentry">
                <!-- Indholdet på siden  -->
                <div class="page-content">

                    <h2 class="text-2xl font-bold">Introduktion</h2>

                    <p>Når du besøger vores hjemmeside og bruger vores service, indsamles visse oplysninger om dig og din brug af sitet for at spore antallet af besøgende på vores side, de mest besøgte sider og de geografiske placeringer, hvorfra vi har flest besøgende. Hvis du ikke ønsker, at oplysninger skal indsamles, kan du fravælge brugen af Analytics-cookies nederst på denne side. Nedenfor har vi beskrevet de indsamlede oplysninger og deres formål.</p>

                    <h3 class="text-xl font-bold">Udgiver</h3>

                    <p>Torben IT ApS<br>Dybendal Alle 12, 1. K20, 2630 Taastrup<br>CVR: 3963 0605<br>+45 7777 4663<br>contact@torbenit.dk<br>Dataansvarlig: Torben Hansen</p>

                    <h3 class="text-xl font-bold">Cookies</h3>

                    <p>Hjemmesiden bruger "cookies", som er tekstfiler, der gemmes på din computer, tablet eller mobil for at genkende din enhed og huske dine indstillinger, udføre statistik og målrette indholdet derefter. Cookies kan ikke indeholde skadelige filer som vira eller lignende. Det er muligt at slette eller blokere cookies. Se instruktionerne på <a href="https://minecookies.org/cookiehandtering/" class="text-blue-500 underline">https://minecookies.org/cookiehandtering/</a></p>

                    <p>Du kan til enhver tid ændre dine cookie-indstillinger og se en beskrivelse af den datalagring, vi bruger i vores cookies: <a href="javascript: Cookiebot.renew()" class="text-blue-500 underline">Cookiebot-indstillinger</a></p>

                    <h2 class="text-2xl font-bold">Dataindsamling</h2>

                    <h3 class="text-xl font-bold">Persondata</h3>

                    <p>Persondata omfatter alle slags oplysninger, der kan tilskrives en person. Når du bruger vores hjemmeside, indsamler og behandler vi nogle af disse oplysninger, ligesom når du tilmelder dig vores service.</p>

                    <p>Vi indsamler typisk og behandler følgende typer oplysninger: et unikt ID, tekniske oplysninger om din computer, tablet eller telefon, din IP-adresse, geografisk placering (land og byområde) og de sider, du klikker på. Dette sker kun, mens du er på vores hjemmeside.</p>

                    <h3 class="text-xl font-bold">Kontaktformularer</h3>

                    <p>Når du bruger vores kontaktformularer på hjemmesiden, gemmes oplysningerne og sendes til vores mailsystem, så vi kan besvare dine spørgsmål. Kontaktformularerne bruges ikke til markedsføring, tilmelding til nyhedsbreve eller lignende, medmindre du anmoder om det, og dine data videregives ikke til udenforstående uden relevans for emnet og uden dit fulde samtykke.</p>

                    <h3 class="text-xl font-bold">Analyseværktøjer</h3>

                    <p>For at give den bedste indsigt og sammenligning af data for vores hjemmeside bruger vi følgende analyseværktøjer baseret på ovennævnte anonyme data: Google Analytics, Google Tag Manager,</p>

                    <p>Du har til enhver tid ret til ikke at blive inkluderet i vores analyser. Dog sætter vi pris på din hjælp til at forbedre vores hjemmeside, så vi bedre kan forstå, hvad og hvor vi skal fokusere vores indsats.</p>

                    <h2 class="text-2xl font-bold">Databehandlere</h2>

                    <p>(Med hvem vi deler dine data)</p>

                    <div class="table">
                        <table>
                            <thead>
                            <tr>
                                <th class="font-bold">Databehandler</th>
                                <th class="font-bold">Funktion</th>
                                <th class="font-bold">Land</th>
                                <th class="font-bold">Databehandling</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Dinero</td>
                                <td>Bogføring</td>
                                <td>Danmark</td>
                                <td>Økonomi, købsfakturaer, fakturaadresser og CVR-data</td>
                            </tr>
                            <tr>
                                <td>Digital Ocean</td>
                                <td>Hjemmeside hosting</td>
                                <td>Holland</td>
                                <td>Hjemmesidefiler, SQL-data og sikkerhedskopier</td>
                            </tr>
                            <tr>
                                <td>Stripe</td>
                                <td>Modtage online betalinger</td>
                                <td>Storbritannien</td>
                                <td>Transaktions- og ordredata</td>
                            </tr>
                            <tr>
                                <td>Zoho</td>
                                <td>E-mails</td>
                                <td>Indien</td>
                                <td>E-mails</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <h2 class="text-2xl font-bold">Datalagring</h2>

                    <h3 class="text-xl font-bold">Sikkerhed</h3>

                    <p>Vi har truffet tekniske og organisatoriske foranstaltninger for at forhindre, at dine oplysninger ved en fejl eller ulovligt slettes, offentliggøres, mistes, ændres eller tilgås af uautoriserede personer, misbruges eller på anden måde behandles i strid med loven. I tilfælde af databrud vil alle vores registrerede brugere blive kontaktet inden for 72 timer med en meddelelse om, hvilke data der er gået tabt, samt vejledning om, hvad de skal gøre ved det. Vores første prioritet i en sådan situation er at lukke sikkerhedsbruddet for at minimere datatab for brugerne.</p>

                    <h3 class="text-xl font-bold">Databeskyttelse</h3>

                    <p>Vi værdsætter dine data, ligesom vi gør med vores egne, så vi beskytter vores (og dine) data med følgende initiativer, som vi løbende opdaterer: SSL-kryptering,</p>

                    <h3 class="text-xl font-bold">Datalagringsperiode</h3>

                    <p>Hvis du skriver og sender data til hjemmesiden i form af kontaktformularer, vil disse data blive gemt på hjemmesiden i op til 1 år for at henvise til tidligere aftaler og kommentarer fra disse formularer.</p>

                    <p>Hjemmesidens administratorer kan til enhver tid se og redigere de oplysninger, der er tilgængelige for brugerne i deres profiler.</p>

                    <p>Analytics-data arkiveres ubegrænset for at se og følge vores online vækst og forbedre vores aktiviteter.</p>

                    <p>Vores kundeindkøbsarkiver arkiveres i overensstemmelse med gældende danske love.</p>

                    <h3 class="text-xl font-bold">Databrudsprocedurer</h3>

                    <p>Vores procedure i tilfælde af indbrud og angreb på vores hjemmeside omfatter følgende punkter:<br>
                        1. Hjemmesiden og backend tages offline, indtil skaden er rettet.<br>
                        2. Rapportér brugen til den relevante myndighed. Kriminelle aktiviteter vil blive rapporteret til politiet.<br>
                        3. De involverede personer, hvis data er blevet kompromitteret, vil blive underrettet via e-mail.<br>
                        4. Implementering af foranstaltninger for at forhindre, at det samme incident gentager sig.</p>

                    <h2 class="text-2xl font-bold">Datarettigheder</h2>

                    <h3 class="text-xl font-bold">Eksport og sletning af data</h3>

                    <p>Du har ret til at få adgang til de data, vi opbevarer om dig. Du kan anmode om at få en fil med de persondata, vi har om dig, herunder alle data, du har givet os, eksporteret. Du kan også anmode om, at vi sletter alle persondata. Dette omfatter ikke nogen data, som vi er forpligtet til at opbevare af administrative, juridiske eller sikkerhedsmæssige årsager.</p>

                    <p>Kontakt databehandleren via e-mail eller telefon, som angivet øverst på denne side.</p>
                </div><!-- .entry-content -->

                <!-- Rediger link til at redigere siden  -->
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
