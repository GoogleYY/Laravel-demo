<style type="text/css">
    body, html {
        height: 100%
    }
    body {
        display: flex;
        padding-top: 80px;
        flex-direction: column;
        background:#f3f3f3;
    }
    header {
        flex: 0 0 auto
    }
    .navbar-inverse {
        background-color: #2C3E50
    }
    .navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form {
        border-color: transparent;
    }
    .navbar-inverse .navbar-nav > li > a {
        color: #bbb;
    }
    main {
        flex: 1 0 auto
    }
    .container {
        padding-left: 10px;
        padding-right: 10px;
    }
    @media (max-width: 768px) {
        body {
            padding-top: 70px;
        }
        .container {
            margin: 0;
        }
    }
    #comment_container .media-object {
        border-radius: 50%;
        width: 54px;
        height: 54px;
    }
    #comment_container p.lead {
        word-break: break-all;
        padding-right: 60px;
        position: relative;
    }
    #comment_container .lead small {
        position: absolute;
        right: 8px;
        bottom: 5px;
    }
    @media (max-width: 480px) {
        #comment_container .lead small {
            font-size: 16px;
            bottom: 0
        }
        .article-title {
            float: none !important;
            margin-bottom: 15px;
            text-align: center;
        }
        .article-info {
            float: none !important;
            text-align: center;
        }
        #comment_container .media-object {
            width: 48px;
            height: 48px;
        }
        .footer .container {
            text-align: center
        }
    }
    .markdown-body img {
        display: block;
        min-width: 96%
    }

    .panel, .page-header {
        border-radius: 2px;
    }
    .btn-link {
        color: #43A6A7;
        cursor: pointer;
    }

    .list-group-item a {
        font-size: 16x
    }

    footer {
        flex: 0 0 auto
    }
    .navbar-form {
        margin: 5px;
        padding: 10px 0
    }
    .img-responsive {
        width: 100%
    }

    .page-list {
        display: flex;
        justify-content: center;
    }
    .pagination {
        margin: 0
    }
    #file_upload {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
        color: #333;
        background-color: #fff;
        border-color: #ccc;
        position:relative;
    }
    .user-avatar #file_upload {
        margin-bottom: 20px
    }
    #file_upload-button {
        position: absolute;
        top: 0;
        left: 0;
        line-height: 2 !important;
    }
    @if(!empty($isQuestionView))
        .article_cover_upload #file_upload,
        .article_cover_upload #file_upload object,
        .article_cover_upload #file_upload-button {
            height: 34px !important;
            width: 100% !important;
            line-height: 2.4 !important;
        }
        .article_cover_upload #image_view {
            max-width: 100%;
            margin-top: 10px;
        }
    @endif
</style>
