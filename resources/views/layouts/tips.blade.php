@if(!Auth::check())
    <section class="alert alert-warning" style="padding:15px">
        <button type="button" class="close" onclick="$(this).parent().fadeOut(300)">×</button>
        您还未登入，<a href="{{ url('login') }}">登入 </a>后可进行更多操作
    </section>
@endif