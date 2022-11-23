i = 0;
while (i < 200) {
    
    i++;
    
    setTimeout(function(){  postMessage("Web Worker Counter: " + i);}, 3000);
    console.log(i);
}
