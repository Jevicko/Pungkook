/*
  Highcharts JS v6.0.6 (2018-02-05)
 Solid angular gauge module

 (c) 2010-2017 Torstein Honsi

 License: www.highcharts.com/license
*/
(function(l){"object"===typeof module&&module.exports?module.exports=l:l(Highcharts)})(function(l){(function(e){var l=e.pInt,u=e.pick,m=e.each,r=e.isNumber,w=e.wrap,v;w(e.Renderer.prototype.symbols,"arc",function(a,f,d,c,e,b){a=a(f,d,c,e,b);b.rounded&&(c=((b.r||c)-b.innerR)/2,b=["A",c,c,0,1,1,a[12],a[13]],a.splice.apply(a,[a.length-1,0].concat(["A",c,c,0,1,1,a[1],a[2]])),a.splice.apply(a,[11,3].concat(b)));return a});v={initDataClasses:function(a){var f=this.chart,d,c=0,t=this.options;this.dataClasses=
d=[];m(a.dataClasses,function(b,h){b=e.merge(b);d.push(b);b.color||("category"===t.dataClassColor?(h=f.options.colors,b.color=h[c++],c===h.length&&(c=0)):b.color=e.color(t.minColor).tweenTo(e.color(t.maxColor),h/(a.dataClasses.length-1)))})},initStops:function(a){this.stops=a.stops||[[0,this.options.minColor],[1,this.options.maxColor]];m(this.stops,function(a){a.color=e.color(a[1])})},toColor:function(a,f){var d=this.stops,c,e,b=this.dataClasses,h,g;if(b)for(g=b.length;g--;){if(h=b[g],c=h.from,d=
h.to,(void 0===c||a>=c)&&(void 0===d||a<=d)){e=h.color;f&&(f.dataClass=g);break}}else{this.isLog&&(a=this.val2lin(a));a=1-(this.max-a)/(this.max-this.min);for(g=d.length;g--&&!(a>d[g][0]););c=d[g]||d[g+1];d=d[g+1]||c;a=1-(d[0]-a)/(d[0]-c[0]||1);e=c.color.tweenTo(d.color,a)}return e}};e.seriesType("solidgauge","gauge",{colorByPoint:!0},{translate:function(){var a=this.yAxis;e.extend(a,v);!a.dataClasses&&a.options.dataClasses&&a.initDataClasses(a.options);a.initStops(a.options);e.seriesTypes.gauge.prototype.translate.call(this)},
drawPoints:function(){var a=this,f=a.yAxis,d=f.center,c=a.options,t=a.chart.renderer,b=c.overshoot,h=r(b)?b/180*Math.PI:0,g;r(c.threshold)&&(g=f.startAngleRad+f.translate(c.threshold,null,null,null,!0));this.thresholdAngleRad=u(g,f.startAngleRad);m(a.points,function(b){var g=b.graphic,k=f.startAngleRad+f.translate(b.y,null,null,null,!0),m=l(u(b.options.radius,c.radius,100))*d[2]/200,n=l(u(b.options.innerRadius,c.innerRadius,60))*d[2]/200,p=f.toColor(b.y,b),q=Math.min(f.startAngleRad,f.endAngleRad),
r=Math.max(f.startAngleRad,f.endAngleRad);"none"===p&&(p=b.color||a.color||"none");"none"!==p&&(b.color=p);k=Math.max(q-h,Math.min(r+h,k));!1===c.wrap&&(k=Math.max(q,Math.min(r,k)));q=Math.min(k,a.thresholdAngleRad);k=Math.max(k,a.thresholdAngleRad);k-q>2*Math.PI&&(k=q+2*Math.PI);b.shapeArgs=n={x:d[0],y:d[1],r:m,innerR:n,start:q,end:k,rounded:c.rounded};b.startR=m;g?(b=n.d,g.animate(e.extend({fill:p},n)),b&&(n.d=b)):(b.graphic=t.arc(n).addClass(b.getClassName(),!0).attr({fill:p,"sweep-flag":0}).add(a.group),
"square"!==c.linecap&&b.graphic.attr({"stroke-linecap":"round","stroke-linejoin":"round"}),b.graphic.attr({stroke:c.borderColor||"none","stroke-width":c.borderWidth||0}))})},animate:function(a){a||(this.startAngleRad=this.thresholdAngleRad,e.seriesTypes.pie.prototype.animate.call(this,a))}})})(l)});
