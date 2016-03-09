 <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Functions/RequestValidation.php"); ?>
 <script>
		//Check Internet Explorer version
		function getIE(){
			if (document.documentMode) 
				return document.documentMode;
			else {
				for (var i = 7; i > 0; i--) {
					var div = document.createElement("div");
					div.innerHTML = "<!--[if IE " + i + "]><span></span><![endif]-->";
					if (div.getElementsByTagName("span").length) 
						return i;
				}
			}
			return undefined;
		}
 
        $(document).ready(function(){
			var ie = getIE();
			if(ie !== undefined && ie < 9)
				alert("You're using an older version of Internet Explorer. Correct functionality is not guaranteed");
			
			pathArray = location.href.split( '/' );
			url = pathArray[0] + '//' + pathArray[2];
			path = window.location.toString().substring(url.length);
			
			//Home, no explicit controller
			if(path == "/")
				$('ul.menu-list a').first().addClass('active');
			else {
				$('ul.menu-list a').each(function(i){
					 //Home, explicit Home-controller
					if($(this).attr('href') == '/' && 
					  window.location == window.location.protocol + 
					  "//" + window.location.host + "/"){
						if(!$(this).hasClass('active'))
							$(this).addClass('active');
					}
					//deeplink
					else if(
					   $(this).attr('href') == path && 
					   $(this).attr('href') != '/' && 
					   !$(this).hasClass('active')
					)
					{
						$(this).addClass('active');
						$(this).parents().each(function(){
							if($(this).hasClass("has-sub"))
								$(this).addClass('active')
						});
					}
			   });
			}
        });
    </script>
     <div style='position:fixed;top:0;left:0;width:100%;z-index: 9999;'>   
            <div id='cssmenu'>
                <ul class='menu-list'>
                   <li><a href='/Home/'><span>Home</span></a></li>
                   <li class='has-sub'><a href='/SomeController/'><span>SomeController</span></a>
                      <ul class='sub-menu'>
                      <li><a href='/AnotherSomeController/'><span>AnotherSomeController</span></a></li>
					  <li><a href='/AnotherSomeController/View'><span>View</span></a></li>
                         <li><a href='/AnotherSomeController/AnotherView'><span>AnotherView</span></a></li>
                      </ul>
                   </li>
                   <?php if(Model_UserModel::isLoggedIn()): ?>
                        <li class='has-sub'><a href='/Management/Index/'><span>Beheer</span></a>
                            <ul class='sub-menu'>
                                <li><a href='/Management/Index/'><span>Index</span></a></li>
                                <li><a href='/Management/SomeView/'><span>SomeView</span></a></li>
                               <li><a href='/Management/AnotherView/'><span>AnotherView</span></a></li>
                               <li><a href='/Management/AnotherAnotherView/'><span>AnotherAnotherView</span></a></li>
                            </ul>
                         </li>
                       </li>
                   <?php endif; ?>
                </ul>
            </div>
        </div>