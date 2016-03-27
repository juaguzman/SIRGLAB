/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js">
 </script> <script type="text/javascript"> var search_input= $('.search input[type=text]');\n\
var search_input_size = 130;\n\
 var search_large_size = 180; \n\
var padding = 6; \n\
var shrinked = "";\n\
$(document).ready(function(){search_input.click(function(){shrink();\n\
}).focus(function(){shrink();});search_input.blur(function(){ if(shrinked=="YES")normal();\n\
});$('.button a').hover(function(){if(shrinked=="YES")normal();}); });\n\
function shrink(){if(search_input_size < search_large_size ){$('.button a').each(function(){$(this).animate(\n\
{'padding-left': padding+'px','padding-right': padding+'px'},'fast');});search_input.animate(\n\
{'width': search_large_size+'px'},'fast'); \n\
shrinked="YES";}return false;}function normal()\n\
{search_input.animate({'width':search_input_size+'px'},'fast'); $('.button a').animate({'padding-left':'10px','padding-right':'10px'}\n\
,'fast');shrinked="";search_input.blur();return false;}</script>
