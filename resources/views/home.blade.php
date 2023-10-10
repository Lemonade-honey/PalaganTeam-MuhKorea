@extends('layout.app', ['page' => 'home'])

@section('desc')
<meta name="description" content="Musilmah Muhammadiyah Organization For The Public Affiliated In Kansai, Japan, find various information about activities, events and programs held by Muhammadiyah Kansai">
@endsection

@section('style')
<style>
    .min-width{
        min-width: 19rem;
        max-width: 19rem;
    }
</style>
@endsection

@section('body')
    @include('components.hero-carousel')

    <main class="mx-4 sm:mx-20">
        <section class="flex justify-center items-center flex-wrap my-4" id="profile">
            <div class="content max-w-xl">
                <img src="/image/home-judul.png" alt="">
            </div>
            <div class="content max-w-md">
                <h1 class="text-2xl sm:text-4xl sm:text-left text-center font-bold text-blue-600 mb-3">Muhammadiyah KorSel</h1>
                <p class="text-justify">This page is a forum for friendship, communication and media from Muhammadiyah residents/sympathizers throughout South Korea. PCIM South Korea is the 18th PCIM in the world which was officially founded on October 18 2016 with members including lecturers, students, Indonesian migrant workers and housewives.</p>
            </div>
        </section>
        <hr>

        <section class="mt-10 my-4" id="misi-visi">
            <div class="content w-full">
                <div class="row mb-11 justify-center items-center">
                    <h1 class="font-bold text-center text-blue-600 text-3xl mb-11">Vision and Mission</h1>
                </div>
                <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 justify-around items-center ">

                    <div class="max-w-sm rounded-xl w-full bg-base-100 shadow-xl">
                        <div class="p-4">
                            <h2 class="font-bold text-lg md:text-2xl text-center text-blue-600">Vision</h2>
                            <p class="text-center">-</p>
                        </div>
                    </div>

                    <div class="max-w-sm rounded-xl w-full bg-base-100 shadow-xl">
                        <div class="p-4">
                            <h2 class="font-bold text-lg md:text-2xl text-center text-blue-600">Mission</h2>
                            <p class="text-center">-</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <hr class="mt-16">

    </main>
    
    @include('components.activity-carousel')

    @include('components.news-carousel')

    {{-- @include('components.location') --}}
@endsection


{{-- @section('body')
    @include('pages.blog-news.blog-home')
    @include('pages.blog-news.blog-page')
@endsection --}}
