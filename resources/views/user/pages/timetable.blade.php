@extends('user.master')
@section('title'){{$title}}@stop
@section('style')

@stop

@section('header')
    @include('user.layout.common_header')
@stop

@section('content')
<div class="content">

<div class="path-section" style='background-image: url(public/img/slide-1.jpg);'>
    <div class="bg-cover">
        <div class="container">
            <h3>Time Table</h3>
        </div>
    </div>
</div>
				
<div class="blog-section page_spacing">
    <div class="container-fluid shortcode-view">
        <div class="row">
            <div class="col-md-12">

					
                <article id="post-360" class="page-post-entry post-360 page type-page status-publish hentry">
                    <h2 class="sr-only">Time Table</h2>
                    <header class="entry-header"></header>
                    <div class="entry-content">

                          <div id='fc-default'></div>
                    </div>
                </article>

            </div>			
        </div>
    </div>

</div>
</div>
@stop

@section('footer')
    @include('user.layout.footer')
@stop
@section('script')
@stop