@extends('layouts.frontend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/frontend.scss'])
@endsection

@section('content')
    <div class="flex bg-white" style="height:600px;">
        <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">
            <div>
                <p>
                    Mød holdet<br/>
                    <br/>
                    ........<br/>
                    <br/>
                    Nå ja, "holdet" er måske så meget sagt, når der kun er én.<br/>
                    <br/>
                <div class="flex elementor-image">
                    <img width="255" height="255" src="{{ asset('media/photos/teh.png') }}" data-src="{{ asset('media/photos/teh.png') }}" class="attachment-large size-large lazyloaded" alt="" data-srcset="{{ asset('media/photos/teh.png') }} 255w, {{ asset('media/photos/teh-150x150.png.png') }} 150w" data-sizes="(max-width: 360px) 147px, (max-width: 255px) 100vw, 255px" sizes="(max-width: 360px) 147px, (max-width: 255px) 100vw, 255px" srcset="{{ asset('media/photos/teh.png') }} 255w, {{ asset('media/photos/teh-150x150.png.png') }} 150w">
                    <p class="m-4">Jeg involverer mig både i det vigtige og det sjove. Jeg værdsætter altid en god indsats, for den er guld værd.</p>
                </div>
                <a href="https://www.linkedin.com/in/taastruptorben/">https://www.linkedin.com/in/taastruptorben/</a><br/>
                <br/>
                Måske bliver du det næste medlem af holdet?<br/> Lønnen er helt vanvittig,
                men måske kan vi ændre det sammen.
                </p>
            </div>
        </div>
        <div class="hidden lg:block lg:w-1/2" style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)">
            <div class="h-full object-cover"
                 style="background-image: url(https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80)">
                <div class="h-full bg-black opacity-25"></div>
            </div>
        </div>
    </div>
@endsection