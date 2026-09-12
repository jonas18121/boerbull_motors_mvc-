'use strict';

document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.table-responsive').forEach(function(table){
        let labels = Array.from(table.querySelectorAll('th')).map(function(th){
            // labels.push(th.innerText)
            return th.innerText;
            
        })
        table.querySelectorAll('td').forEach(function(td, index){
            td.setAttribute('data-label', labels[index % labels.length])
        })
    })
});