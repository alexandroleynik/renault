
<style>
.preload-mask {
display: block;
position: fixed;
width: 100%;
width: 100vw;
height: 100%;
height: 100vh;
top: 0;
left: 0;
background: white;
content: "";
    z-index: 99999;
}

.preload-logo {
position: absolute;
top: 0;
left: 0;
bottom: 0;
right: 0;
margin: auto;
width: 300px;
height: 130px;
    z-index: 99999;
}

.preload-logo div {
width: 160px;
margin: 10px auto 0;
}
</style>
<div class="preload-mask">
    <div class="preload-logo">
        <img src="/img/renault_main_logo.png" />
        <div id="loaderImage"></div>
    </div>
</div>