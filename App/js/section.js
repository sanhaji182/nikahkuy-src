// Initialize your app
var myApp = new Framework7();

// Export selectors engine
var $$ = Dom7;
var $scene ='';


$$('#home').on('click', function () {
    myApp.closeModal();
    scene(1);
                        
});


function dialog(){

    $.post('http://localhost/nikahyuk/req/scene.php',{user:'get',id:1},function(res){
    console.log(res);
    $image = 'http://localhost/nikahyuk/assets/backgrounds/school_corridor.jpg';

     $dialog = '<p>'+res[0].dialog+'</p>';

    document.getElementById("dialog").innerHTML = $dialog;
    })
}

function klik(lanjut){
    scene(lanjut);
}

function scene(num){
    $.post('http://localhost/nikahyuk/req/scene.php',{user:'get',id:num},function(res){
    console.log(res);
        $.post('http://localhost/nikahyuk/req/dialog.php',{user:'get',id:num},function(dialog){
        console.log(dialog);
            $.post('http://localhost/nikahyuk/req/bg.php',{user:'get',id:num},function(bg){
                console.log(bg);
                $image = 'http://localhost/nikahyuk/'+bg[0].bg;
                    $scene = 
                            '<div style="background-image:url('+$image+');background-repeat:no-repeat;background-size:100%" data-page="home-1" class="page">'+ 
                                '<div style="height:300px" class="row">'+
                                    '<div class="col-25">'+
                                        '<article>';
                            if(bg[1].bg != null){
                                $scene += '<img class="responsive" src="'+bg[1].bg+'" width=100%/>';
                            }                    
                            $scene += 
                                        '</article>'+
                                    '</div>'+
                                    '<div class="col-25">'+
                                        '<article>';
                            if(bg[2].bg != null){
                                $scene += '<img class="responsive" src="'+bg[2].bg+'" width=100%/>';
                            }                    
                            $scene += 
                                        '</article>'+
                                    '</div>'+
                                    '<div class="col-25">'+
                                        '<article>';
                            if(bg[3].bg != null){
                                $scene += '<img class="responsive" src="'+bg[3].bg+'" width=100%/>';
                            }                    
                            $scene += 
                                        '</article>'+
                                    '</div>'+
                                    '<div class="col-25">'+
                                        '<article>';
                            if(bg[4].bg != null){
                                $scene += '<img class="responsive" src="'+bg[4].bg+'" width=100%/>';
                            }                    
                            $scene += 
                                        '</article>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row" style="height:500px;width:100%">'+
                                    '<div style="border-radius: 10px;background:white;height:200px;width:100%;margin-top:150px;margin-left:50px;margin-right:50px;padding-left:30px;padding-right:30px">'+
                                    '<p><b>'+dialog[0].nama+':</b> '+dialog[0].dialog+'</p>';
                            if(bg[0].choice1_nama != null){
                                $scene +=
                                '<a  href="#" onclick="klik('+bg[0].choice1+')" class=" button button-sm button-round home">'+bg[0].choice1_nama+'</a>'+
                                    '<br>';
                            }
                            if(bg[0].choice2_nama != ''){
                                $scene +=
                                '<a  href="#" onclick="klik('+bg[0].choice2+')" class=" button button-sm button-round home">'+bg[0].choice2_nama+'</a>'+
                                    '<br>';
                            }                                                                      
                            $scene +=        
                                    '</div>'+
                                '</div>'+
                            '</div>';
                document.getElementById("scene").innerHTML = $scene;
            })
        })
    })
}

// Generate dynamic page
var dynamicPageIndex = 0;
function createContentPage() {
	mainView.router.loadContent(
        '<!-- Top Navbar-->' +
        '<div class="navbar">' +
        '  <div class="navbar-inner">' +
        '    <div class="left"><a href="#" class="back link"><i class="icon icon-back"></i><span>Back</span></a></div>' +
        '    <div class="center sliding">Dynamic Page ' + (++dynamicPageIndex) + '</div>' +
        '  </div>' +
        '</div>' +
        '<div class="pages">' +
        '  <!-- Page, data-page contains page name-->' +
        '  <div data-page="dynamic-pages" class="page">' +
        '    <!-- Scrollable page content-->' +
        '    <div class="page-content">' +
        '      <div class="content-block">' +
        '        <div class="content-block-inner">' +
        '          <p>Here is a dynamic page created on ' + new Date() + ' !</p>' +
        '          <p>Go <a href="#" class="back">back</a> or go to <a href="services.html">Services</a>.</p>' +
        '        </div>' +
        '      </div>' +
        '    </div>' +
        '  </div>' +
        '</div>'
    );
	return;
}