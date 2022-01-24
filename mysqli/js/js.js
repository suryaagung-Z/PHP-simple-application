const search = document.querySelector('#search');
const table = document.querySelector('#table');
const page = document.querySelector('#page');

search.addEventListener('keyup', ()=>{

    const ajax = new XMLHttpRequest();
    ajax.onreadystatechange = ()=>{
        if( ajax.readyState == 4 && ajax.status == 200 ){
            table.innerHTML = ajax.responseText;
        }
    }
    ajax.open('GET', 'js/ajaxResult.php?search='+search.value, true);
    ajax.send();

    if( search.value === "" ){
        page.style.visibility = "visible";
    }else{
        page.style.visibility = "hidden";
    }
});
