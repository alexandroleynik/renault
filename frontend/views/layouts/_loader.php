<style>
    /*.mask {
        position: fixed;
        width: 100vw;
        height: 100vh;
        background: #1b1b1b;
        z-index: 1000;
        top: 0;
        left: 0;
    }*/
	
	

/* loader style */

.preload-mask,
.preload-logo,
.preload-mask *,
.preload-logo *{
    margin: 0;
    padding: 0;
}

.preload-mask {
    display: block;
    position: fixed;
    width: 100%;
    width: 100vw;
    height: 100%;
    height: 100vh;
    top: 0;
    left: 0;
    background: #333333;
	z-index:110;
    content: "";
}

.preload-logo {
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    content: "";
}

.frame-43, .frame-44, .frame-45, .frame-46, .frame-47, 
.frame-48, .frame-49, .frame-50, .frame-51, .frame-52, 
.frame-53, .frame-54, .frame-55, .frame-56, .frame-57, 
.frame-58, .frame-59, .frame-60, .frame-61, .frame-62, 
.frame-63, .frame-64, .frame-65, .frame-66, .frame-67, 
.frame-68, .frame-69, .frame-70, .frame-71, .frame-72, 
.frame-73, .frame-74, .frame-75, .frame-76, .frame-77, 
.frame-78, .frame-79, .frame-80, .frame-81, .frame-82, 
.frame-83, .frame-84, .frame-85, .frame-86, .frame-87, 
.frame-88, .frame-89, .frame-90, .frame-91, .frame-92, 
.frame-93, .frame-94, .frame-95, .frame-96, .frame-97, 
.frame-98
{ display: inline-block; background: url('/img/preload.png') no-repeat; overflow: hidden; text-indent: -9999px; text-align: left; }
 
.frame-43 { background-position: -0px -0px; width: 300px; height: 300px; }
.frame-44 { background-position: -300px -0px; width: 300px; height: 300px; }
.frame-45 { background-position: -600px -0px; width: 300px; height: 300px; }
.frame-46 { background-position: -900px -0px; width: 300px; height: 300px; }
.frame-47 { background-position: -1200px -0px; width: 300px; height: 300px; }
.frame-48 { background-position: -1500px -0px; width: 300px; height: 300px; }
.frame-49 { background-position: -1800px -0px; width: 300px; height: 300px; }
.frame-50 { background-position: -0px -300px; width: 300px; height: 300px; }
.frame-51 { background-position: -300px -300px; width: 300px; height: 300px; }
.frame-52 { background-position: -600px -300px; width: 300px; height: 300px; }
.frame-53 { background-position: -900px -300px; width: 300px; height: 300px; }
.frame-54 { background-position: -1200px -300px; width: 300px; height: 300px; }
.frame-55 { background-position: -1500px -300px; width: 300px; height: 300px; }
.frame-56 { background-position: -1800px -300px; width: 300px; height: 300px; }
.frame-57 { background-position: -0px -600px; width: 300px; height: 300px; }
.frame-58 { background-position: -300px -600px; width: 300px; height: 300px; }
.frame-59 { background-position: -600px -600px; width: 300px; height: 300px; }
.frame-60 { background-position: -900px -600px; width: 300px; height: 300px; }
.frame-61 { background-position: -1200px -600px; width: 300px; height: 300px; }
.frame-62 { background-position: -1500px -600px; width: 300px; height: 300px; }
.frame-63 { background-position: -1800px -600px; width: 300px; height: 300px; }
.frame-64 { background-position: -0px -900px; width: 300px; height: 300px; }
.frame-65 { background-position: -300px -900px; width: 300px; height: 300px; }
.frame-66 { background-position: -600px -900px; width: 300px; height: 300px; }
.frame-67 { background-position: -900px -900px; width: 300px; height: 300px; }
.frame-68 { background-position: -1200px -900px; width: 300px; height: 300px; }
.frame-69 { background-position: -1500px -900px; width: 300px; height: 300px; }
.frame-70 { background-position: -1800px -900px; width: 300px; height: 300px; }
.frame-71 { background-position: -0px -1200px; width: 300px; height: 300px; }
.frame-72 { background-position: -300px -1200px; width: 300px; height: 300px; }
.frame-73 { background-position: -600px -1200px; width: 300px; height: 300px; }
.frame-74 { background-position: -900px -1200px; width: 300px; height: 300px; }
.frame-75 { background-position: -1200px -1200px; width: 300px; height: 300px; }
.frame-76 { background-position: -1500px -1200px; width: 300px; height: 300px; }
.frame-77 { background-position: -1800px -1200px; width: 300px; height: 300px; }
.frame-78 { background-position: -0px -1500px; width: 300px; height: 300px; }
.frame-79 { background-position: -300px -1500px; width: 300px; height: 300px; }
.frame-80 { background-position: -600px -1500px; width: 300px; height: 300px; }
.frame-81 { background-position: -900px -1500px; width: 300px; height: 300px; }
.frame-82 { background-position: -1200px -1500px; width: 300px; height: 300px; }
.frame-83 { background-position: -1500px -1500px; width: 300px; height: 300px; }
.frame-84 { background-position: -1800px -1500px; width: 300px; height: 300px; }
.frame-85 { background-position: -0px -1800px; width: 300px; height: 300px; }
.frame-86 { background-position: -300px -1800px; width: 300px; height: 300px; }
.frame-87 { background-position: -600px -1800px; width: 300px; height: 300px; }
.frame-88 { background-position: -900px -1800px; width: 300px; height: 300px; }
.frame-89 { background-position: -1200px -1800px; width: 300px; height: 300px; }
.frame-90 { background-position: -1500px -1800px; width: 300px; height: 300px; }
.frame-91 { background-position: -1800px -1800px; width: 300px; height: 300px; }
.frame-92 { background-position: -0px -2100px; width: 300px; height: 300px; }
.frame-93 { background-position: -300px -2100px; width: 300px; height: 300px; }
.frame-94 { background-position: -600px -2100px; width: 300px; height: 300px; }
.frame-95 { background-position: -900px -2100px; width: 300px; height: 300px; }
.frame-96 { background-position: -1200px -2100px; width: 300px; height: 300px; }
.frame-97 { background-position: -1500px -2100px; width: 300px; height: 300px; }
.frame-98 { background-position: -1800px -2100px; width: 300px; height: 300px; }

/* /loader */
</style>

<!--<div class="mask">
    div class="logo">Renault</div
</div>-->

<div class="preload-mask">
	<div class="preload-logo"></div>
</div>