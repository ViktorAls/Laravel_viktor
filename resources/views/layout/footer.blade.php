<style>
    body{
        position: relative;
        padding-top: 60px;
        min-height: 100vh;
    }
    footer{
        width: 100%;
        background-color: #d9d9d9;
        position: absolute;
        left: 0;
        bottom: 0;
        margin-top: 3vh;
    }
    .footer span{
        line-height: 2em;
    }

    .block{
        background-color: #fff;
        border-top: 3px solid #2a9055;
        border-radius: 3px;
        box-shadow: 0px 0px 6px 0px rgba(0,0,0,0.15);
        padding: 8px;
        margin-bottom: 130px;
    }
    .add_block{
        margin-top: 2em;
        padding: 8px;
    }
    .org_block{
        margin-bottom: 0px;
    }
    .block  p{
        font-size: 0.9em;
        padding-left: 0.3em;
        padding-bottom: 0;
        margin-bottom: 0;
    }
    .block ul{
        margin: 0;
        padding: 0;
    }
    .block ul li{
        font-size: 0.9em;
        list-style: none;
        border-top: 1px solid rgba(9,96,20,0.33);
        padding: 0.2em 0.3em;
        opacity: 0.8;
    }
</style>

<footer class="footer">
    <div class="container">
        <span class="text-muted float-left">Александрович Виктор</span>
        <span class="text-muted float-right">Тестовое задание. {{date('Y')}}</span>
    </div>
</footer>