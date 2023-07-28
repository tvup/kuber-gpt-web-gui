@extends('layouts.frontend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/frontend.scss'])
@endsection

@section('content')
    <div class="flex bg-white" >
        <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">

            <article id="post-180" class="post-180 page type-page status-publish hentry">
                <!-- Indholdsområde på siden -->
                <div class="page-content">
                    <h2 class="text-2xl font-bold">Abonnementsvilkår</h2>
                    <ol class="list-decimal list-inside ml-6">
                        <li>Disse vilkår gælder for kuber-gpt.com, herefter benævnt "platformen".</li>
                        <li>Tilmelding til en plan:
                            <ol class="list-decimal list-inside ml-6">
                                <li>Abonnementet oprettes ved at gennemføre en ordre på hjemmesiden https://kuber-gpt.com, herefter benævnt "hjemmesiden".</li>
                                <li>Kun betalinger med følgende udbydere accepteres:
                                    <ol class="list-decimal list-inside ml-6">
                                        <li>Visa</li>
                                        <li>Mastercard</li>
                                        <li>American Express</li>
                                    </ol>
                                </li>
                                <li>Abonnementet fortsætter, indtil det opsiges af en af parterne.</li>
                                <li>Hver abonnementsperiode er en måned, og automatisk fornyelse vil ske, medmindre betaling ikke kan behandles.</li>
                                <li>Priser for hvert produkt er angivet på hjemmesiden og inkluderer moms.</li>
                                <li>Moms opkræves altid på abonnementer og andre produkter.</li>
                            </ol>
                        </li>
                        <li>Opsigelse af abonnement:
                            <ol class="list-decimal list-inside ml-6">
                                <li>Udbyderen kan opsige abonnementer med en måneds varsel før udgangen af en abonnementsperiode.</li>
                                <li>Abonnenten kan opsige abonnementer enten med øjeblikkelig virkning eller ved udgangen af næste abonnementsperiode. Der ydes ingen refusion uanset opsigelsesdato.
                                    <ol class="list-decimal list-inside ml-6">
                                        <li>Hvis abonnenten ikke eksplicit angiver, om opsigelsen skal være med øjeblikkelig virkning eller ved udgangen af en abonnementsperiode, vil sidstnævnte være gældende.</li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                        <li>Udbyderens forpligtelser:
                            <ol class="list-decimal list-inside ml-6">
                                <li>Udbyderen vil bestræbe sig på at holde systemet tilgængeligt for brugeren 99% af tiden.</li>
                                <li>Planlagt nedetid tæller ikke med i den ovenstående tilgængelighed.</li>
                                <li>Udbyderen kan ikke holdes ansvarlig for tab, som abonnenterne lider som følge af serviceafbrydelser eller systemfejl.</li>
                            </ol>
                        </li>
                        <li>Abonnentens forpligtelser:
                            <ol class="list-decimal list-inside ml-6">
                                <li>Abonnenten skal sørge for, at personlige oplysninger som navn, adresse, e-mail og betalingsoplysninger er opdaterede.</li>
                                <li>Abonnenten skal være villig til at modtage information om systemændringer via e-mail.</li>
                            </ol>
                        </li>
                        <li>Ændringer af vilkår:
                            <ol class="list-decimal list-inside ml-6">
                                <li>Ændringer vil blive meddelt en måned i forvejen.</li>
                            </ol>
                        </li>
                    </ol>
                    <h2 class="text-2xl font-bold">Handelsvilkår</h2>
                    <p class="font-semibold">Betaling</p>
                    <p class="mb-4">Torben IT ApS accepterer betaling med VISA, Mastercard og American Express.</p>
                    <p class="mb-4">Alle beløb er i DKK (danske kroner) og inkluderer moms.</p>
                    <p class="mb-4">Torben IT ApS (CVR-nr. 39630605) bruger en godkendt betalingsserver, der krypterer alle dine kortoplysninger med SSL (Secure Socket Layer) protokol. Dette betyder, at dine oplysninger ikke kan opfanges.</p>
                    <p class="font-semibold">Klagemuligheder - oversigt og links:</p>
                    <p class="mb-4">Hvis du har en klage over et abonnement, som du har købt via hjemmesiden, kan du sende en klage til:</p>
                    <p class="mb-4">Konkurrence- og Forbrugerstyrelsens Center for Klageløsning<br>Carl Jacobsens Vej 35<br>2500 Valby<br>Link: <a href="http://www.forbrug.dk/" class="text-blue-500 underline">www.forbrug.dk</a></p>
                    <p class="mb-4">Hvis du er forbruger bosiddende i et andet EU-land, kan du indgive din klage på EU-Kommissionens online klageportal.</p>
                    <p class="mb-4">Portalen kan findes her: <a href="http://ec.europa.eu/consumers/odr/" class="text-blue-500 underline">http://ec.europa.eu/consumers/odr/</a><br>Hvis du indgiver en klage her, skal du oplyse vores e-mail-adresse: contact@torbenit.dk</p>
                </div><!-- .entry-content -->
                <!-- Rediger link til at redigere siden -->
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
