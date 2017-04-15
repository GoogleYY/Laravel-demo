@extends('layouts.common')

@section('content')

    <main class="mastwrap">

        <div class="container">

            <div class="row add-top">
                <article class="col-md-9 pic-block big-block">
                    <a class="shodow-box" href="https://news.laravel-china.org/posts/580">
                        <img class="img-responsive" alt="如何利用数据填充做好测试" src="./Laravel_files/WfqQjLukop.jpg">
                        <div class="pic-header">
                            <h2>如何利用数据填充做好测试</h2>
                            <p>不懂得优雅地测试自己代码的程序员不是会装逼的程序员</p>
                        </div>
                    </a>
                </article>

                <article class="col-md-3 pic-block side-banner">
                    <a class="shodow-box" href="https://news.laravel-china.org/posts/515">
                        <img class="img-responsive" src="./Laravel_files/sZiPzKF0YyimDSl6WMfP.jpg" alt="Laravel 文化衫">
                        <h4>Laravel 文化衫</h4>
                    </a>
                </article>
                <article class="col-md-3 pic-block side-banner">
                    <a class="shodow-box" href="https://news.laravel-china.org/posts/514">
                        <img class="img-responsive" src="./Laravel_files/Sk7sI3598LMYWDcbTrfz.jpg"
                             alt="中文新手入门书籍《Laravel 入门教程》">
                        <h4>中文新手入门书籍《Laravel 入门教程》</h4>
                    </a>
                </article>
                <article class="col-md-3 pic-block side-banner">
                    <a class="shodow-box" href="https://news.laravel-china.org/posts/511">
                        <img class="img-responsive" src="./Laravel_files/AqoFEfO9lENgiSlLOIJU.jpg"
                             alt="最优雅的微信 SDK - overtrue/wechat">
                        <h4>最优雅的微信 SDK - overtrue/wechat</h4>
                    </a>
                </article>
            </div>

            <div class="row add-top add-subscribe">
                <div class="col-md-6 pic-block">
                    <div class="shodow-box">
                        <div class="subscribe-box">
                            <div class="subscribe-header">
                                <h2>
                                    订阅周刊
                                    <i class="fa fa-envelope-o pull-right" aria-hidden="true"></i>
                                </h2>
                            </div>
                            <div class="subscribe-content">
                                <p>每周</p>
                                <form action="https://laravelnews.createsend.com/t/d/s/owwr/" method="post"
                                      class="subscribe-form">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Email 地址" id="subscribe-input">
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger btn-" id="subscrib-btn" type="button">
                                                <i class="fa fa-arrow-right" aria-hidden="true"></i> 开始订阅
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <article class="col-md-3 pic-block qrcode-pic-block">
                    <div class="shodow-box" style="padding: 8px;">
                        <div class="grid-wrap">
                            <a href="" class="btn btn-default btn-block" target="_blank">Laravel
                                速查表</a>
                            <a href="" class="btn btn-default btn-block" target="_blank"><i
                                    class="fa fa-wechat" aria-hidden="true"></i> Easy WeChat</a>
                            <a href="" class="btn btn-default btn-block"
                               target="_blank"><i class="fa fa-paper-plane" aria-hidden="true"></i> Laravel 入门教程</a>
                            <a href="" class="btn btn-default btn-block"
                               target="_blank">Laravel 远程工作</a>
                            <a href="" class="btn btn-default btn-block" target="_blank">技术服务 /
                                技术合作</a>
                            <a href="" class="btn btn-default btn-block"
                               target="_blank">推荐外包，拿分成</a>
                        </div>
                    </div>
                </article>

                <article class="col-md-3 pic-block">
                    <a class="shodow-box" href="http://estgroupe.com/">
                        <img class="img-responsive" alt="" title="" src="./Laravel_files/l7WfKh5n3T.jpg">
                    </a>
                </article>
            </div>

            <div class="row add-top-half  home-list">

                <div class="block-header">
                    <h2>最新资讯
                        <span class="pull-right read-more">
                        <a href=""><i class="fa fa-plus" aria-hidden="true"></i> 更多</a>
                    </span>
                    </h2>
                </div>

                <article class="col-md-4 pic-block">
                    <a class="shodow-box" href="https://news.laravel-china.org/posts/579">
                        <img class="img-responsive" alt="Laravel 迁移新命令：Fresh（Laravel 5.5 新功能早知道）"
                             src="./Laravel_files/CmpNi0DTgA.png">
                        <h4>Laravel 迁移新命令：Fresh（Laravel 5.5 新功能早知道）</h4>
                    </a>
                </article>
                <article class="col-md-4 pic-block">
                    <a class="shodow-box" href="https://news.laravel-china.org/posts/576">
                        <img class="img-responsive" alt="Laravel 5.5 邮件支持多主题啦！" src="./Laravel_files/t61PR27yJu.png">
                        <h4>Laravel 5.5 邮件支持多主题啦！</h4>
                    </a>
                </article>
                <article class="col-md-4 pic-block">
                    <a class="shodow-box" href="https://news.laravel-china.org/posts/575">
                        <img class="img-responsive" alt="Laravel 发布 5.4.17 版本" src="./Laravel_files/vQ0QfxkffI.png">
                        <h4>Laravel 发布 5.4.17 版本</h4>
                    </a>
                </article>

            </div>
        </div>
    </main>

@endsection