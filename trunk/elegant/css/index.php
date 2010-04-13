<style>
#imageFx{border:none;width:916px;height:410px;overflow:hidden;position:relative;}
#imageFx img{display:none;width:916px;height:410px;}
#maskFx{position:absolute;width:916px;height:410px;overflow:hidden;}
#maskFx .range{float:left;display:inline;position:relative;}
#maskFx .range div{position:absolute; left:0;top:0;}
#imageFx .pageBar{position:absolute;z-index:99;right:10px;bottom:0;}
.pageBar a{display:block;background:#000;border:1px solid #666;color:#fff;float:left;width:16px;font-size:12px;margin:2px;text-align:center;line-height :16px;font-family:Arial;cursor:pointer;text-decoration:none;}
.pageBar a:hover,.pageBar a.current{background:red;color:#fff;border:1px solid #600;border-top:1px solid #F96;border-left:1px solid #F96;}
</style>
<div id="icontent">
<div id="content_left"><img src="images/left_10.jpg" /></div>
<div id="iflash" style="width: 918; height: 410px;">
<div id="imageFx" >
<?php
$doc = new DOMDocument ();
$doc->load ( "xml/index.xml" );
for($j = 1; $j <= 5; $j ++) {
	$place = ($j * 25) . "px";
	$index = $j - 1;
	//echo "<a href='#' onclick='galleryplayid(\"1,2,3,4,5\",$index);' onmouseover='galleryplayid(\"1,2,3,4,5\",$index);' class='indexpic' style='margin-left:$place;'>$j</a>";
}
$books = $doc->getElementsByTagName ( "lookbook" );
$i = 1;
foreach ( $books as $book ) {
	$urls = $book->getElementsByTagName ( "url_pic" );
	$url = trim ( $urls->item ( 0 )->nodeValue );
	//echo "<input type='hidden' value='$url' class='indexpic'/>";
	$links = $book->getElementsByTagName ( "big_pic" );
	$link = trim ( $links->item ( 0 )->nodeValue );
	$number = $i + 10;
	$root = base_url () . $link;
	//echo "<input type='hidden' value='$link' class='i_link'/>";
	echo "<img src='$url' class='i_link'/>";
	$i ++;
}
?>
<div id="maskFx"></div>
<script language="Javascript">
Tpl={
    w:918,h:410,
    __clip__:function (el,x,y,w,h){
        var _=[y,w,h,x];
        for(var i=_.length;i--;)_[i]=_[i]<0?'auto':_[i]+'px';
        el.style.clip="rect("+_.join(" ")+")";
    },
    __timeLine__:function (play,end,len) {
        var play=play||Date,end=end||Date,s=0,t=0,len=(len||480)/10,th,p=Math.pow,
        fx=function(x){return x},c=function(f,t){return +f+(t-f)*s};
        return th=setInterval(function(){play(c,s=fx(t++/len));if(s==1)end(clearInterval(th))},10);
    },
    __createMask__:function (){
        var ranges=[],masks=[],r,c;
        for(var i=0;i<32;i++){
            r=document.createElement('DIV');
            r.className="range";
            masks.push(r.appendChild(document.createElement('DIV')));            
            ranges.push(this.MaskDIV.appendChild(r))
        };
        this.masks=masks;
        this.ranges=ranges
    },
    __setMask__:function (bgImg,col,row){
        var a,b,w=Math.ceil(this.w/col),h=Math.ceil(this.h/row),l=this.ranges.length;
        this.uw=w;
        this.uh=h;
        this.actCount=Math.min(col*row,l);
        for(var i=0;i<l;i++){
            a=this.ranges[i].style;
            b=this.masks[i].style;
            b.width=a.width=w+'px';
            b.height=a.height=h+'px';
            b.background="url("+bgImg+")";
            b.backgroundPosition=(-i%col)*w+'px '+parseInt(-i/col)*h+'px';
            b.clip="rect(0 0 0 0)";
            if(i==col*row-1)break
        };
    },
    __fxs__:[
        function (el,x){this.__clip__(el,x(this.uw,0),x(this.uh,0),x(0,this.uw),x(0,this.uh))},
        function (el,x){this.__clip__(el,x(this.uw,0),-1,x(0,this.uw),-1)},
        function (el,x){this.__clip__(el,-1,x(this.uh,0),-1,x(0,this.uh))},
        function (el,x){this.__clip__(el,-1,-1,-1,x(0,this.uh))},
        function (el,x){this.__clip__(el,-1,-1,x(0,this.uw),-1)},
        function (el,x){this.__clip__(el,-1,-1,x(0,this.uw),x(0,this.uh))},
        function (el,x){this.__clip__(el,x(this.uw,0),x(this.uh,0),-1,-1)}
    ]
};
imgFx=function (shell,mask){
    var arrImgs=shell.getElementsByTagName('IMG');
    var pageBar=document.createElement('DIV');
    pageBar.className='pageBar';
    var num,timer,nextTimer,hover;
    this.nums=[];
    shell.appendChild(pageBar);
    var This=this,pos=0,len=arrImgs.length;
    This.shell=shell;
    This.MaskDIV=mask;
    This.uw=This.w;
    This.uh=This.h;
    This.__createMask__();
    var Case=[[32,1,1],[32,1,1],[1,1,5],[1,1,6],[1,1,1],[1,1,2],[1,8,2],[1,1,0],[1,1,5],[4,2,0],[8,3,0],[1,1,3],[1,1,4]];
    var start=function (){
        var cur=arrImgs[pos%len].src,index=Math.round((Case.length-1)*Math.random());
        var opt=Case[index];
        if(This.prevNum)This.prevNum.className='';
        This.prevNum=This.nums[pos%len];
        This.prevNum.className='current';
        This.__setMask__(cur,opt[0],opt[1]);
        timer=This.__timeLine__(function (x){
            for(var i=This.actCount;i--;){
                This.__fxs__[opt[2]].call(This,This.masks[i],x)
            };
       },function (){
           This.shell.style.background='url('+cur+')';
           pos++;
           if(!hover)nextTimer=setTimeout(start,5000);
       });        
    };
    for(var i=0,l=arrImgs.length;i<l;i++){
        num=document.createElement('A');
        num.href="javascript:void(0)";
        num.innerHTML=(i+1);
        this.nums.push(pageBar.appendChild(num));
        num.numIndex=i;
        num.onclick=function (){
            pos=this.numIndex;
            clearTimeout(timer);
            clearTimeout(nextTimer);
            start()
        }
    };
    start()
};
imgFx.prototype=Tpl;
try {document.execCommand("BackgroundImageCache", false, true);}catch(e){};

var _51Fx=new imgFx(
    document.getElementById('imageFx'),
    document.getElementById('maskFx')
);
</script></div>
</div>
<div id="content_right"><img src="images/left_11.jpg" /></div>
</div>
<div id="bottom">
<div id="friend">
<ul>
	<li><label class="title">友情链接:</label></li>
<?php
foreach ( $indexlink as $linkitem ) :
	?>
<li><a href="<?php
	echo $linkitem ["linkaddress"]?>" target="_blank"><?php
	echo $linkitem ["linkname"]?></a></li>
<?php
endforeach
;
?>
</ul>
</div>
</div>


