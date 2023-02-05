<div class="section-header-breadcrumb">
    <?php $link = url('/') ?>
    @for($i = 1; $i <= count(Request::segments()); $i++)
        @if($i < count(Request::segments()) & $i > 0)
            <?php $link .= "/" . Request::segment($i); ?>
            <div class="breadcrumb-item">
                <a href="{{$link}}">{{ ucwords(str_replace('-',' ',Request::segment($i)))}}</a>
            </div>
        @else
            <div class="breadcrumb-item">
                {{ucwords(str_replace('-',' ',Request::segment($i)))}}
            </div>
        @endif
    @endfor
</div>
