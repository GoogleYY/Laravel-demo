<aside class="col-md-3 side-bar" style="padding-right:0">
    @if(Auth::check())
        <div class="panel panel-default corner-radius">

            <div class="panel-body text-center topic-author-box">
                <a href="{{ url('user/personal') }}">
                  <img src="{{ asset(Auth::user()->avatar) }}" style="width:80px; height:80px;margin:5px;" class="img-thumbnail avatar">
                </a>
                <div class="text-center" style="padding:3px">
                    <i class="fa fa-mars" style="font-weight:700;color:#47A4FF" aria-hidden="true"></i>
                </div>
                <span class="text-white">
                    <hr>
                    <a class="btn btn-default btn-block" id="hasUnreadMsg"
                       href="{{ url('user/forward') }}" style="cursor:pointer;display:none;color:#47A4FF">
                        有新的回复了
                    </a>
                    <a class="btn btn-warning btn-block" href="{{ url('user/personal') }}">
                        <i class="fa fa-plus"></i>
                        个人中心
                    </a>
                </span>
            </div>
        </div>
    @endif
    <div class="panel panel-default corner-radius">
        <div class="panel-heading text-center">
            <h3 class="panel-title">友情链接</h3>
        </div>
        <div class="panel-body text-center">
            <a href="https://www.google.com.hk" target="_blank" rel="nofollow"
            style="padding: 3px;">
                <img src="{{ asset('resources/assets/img/20170415032217.gif') }}"
                     style="width:150px; margin:6px 20px;">
            </a>
            <a href="https://www.google.com.hk" target="_blank" rel="nofollow"
            style="padding: 3px;">
                <img src="{{ asset('resources/assets/img/20170415032445.gif') }}"
                     style="width:150px; margin:6px 20px;">
            </a>
            <a href="https://www.google.com.hk" target="_blank" rel="nofollow"
               style="padding: 3px;">
                <img src="{{ asset('resources/assets/img/20170415031854.gif') }}"
                     style="width:150px; margin:6px 20px;">
            </a>
        </div>
    </div>

    <div id="sticker-sticky-wrapper" class="sticky-wrapper">
        <div id="sticker">
            <div class="panel panel-default corner-radius sidebar-resources">
                <div class="panel-heading text-center">
                    <h3 class="panel-title">推荐阅读</h3>
                </div>
                <div class="panel-body">
                    <ul class="list list-group ">
                        <li class="list-group-item ">
                            <a href="" class="no-pjax">
                                <img class="media-object inline-block" src="">
                                //////////////////////////////////////////////
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel panel-default corner-radius" style="color:#a5a5a5">
                <div class="panel-body text-center">
                    <a href="" style="color:#a5a5a5">
                        <span style="margin-top: 7px;display: inline-block;">
                            <i class="fa fa-heart" aria-hidden="true" style="color: rgba(232, 146, 136, 0.89);"></i>
                            建议反馈？请私信 管理员
                        </span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</aside>
