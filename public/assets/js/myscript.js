$(document).ready(function(){
    
    /** Side Bar **/
    var currentPage = window.location.href;
    var findPage = /(dashboard|contacts|surveys|create)/i,
        findHome = /(dashboard)/i,
        findContact = /contacts/i,
        findSurveys = /surveys/i,
        findCreate = /create/i;
    var found = currentPage.search(findPage);

    if(found > 0){
        if(currentPage.search(findHome)>0){
            $('ul.nav li:nth-child(1)').addClass('active');
        }else if(currentPage.search(findContact)>0){
            $('ul.nav li:nth-child(2)').addClass('active');
        }else if(currentPage.search(findSurveys)>0){
            $('ul.nav li:nth-child(3)').addClass('active');
        }else if(currentPage.search(findCreate)>0){
            $('ul.nav li:nth-child(1)').addClass('active');
        }else{
            alert('Bigger Yawa dey');
        }
    }else{
        $('ul.nav li:nth-child(1)').addClass('active');
    }
    
    
});
