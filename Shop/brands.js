document.querySelector('.close').addEventListener('click', function() {
    window.location.href="indexshop.php";  
});

document.querySelector('.search-btn').addEventListener('click', filterName); 

// ściaganie treści z pola tekstowego
let filter = document.getElementById('filter');

function filterName() {
    // pobieramy wartość z klawiatury
    let filterValue = document.getElementById('filter').value.toUpperCase();

    // pobieramy nazwy ul
    let ul = document.getElementById('names');

    // pobieranie list z ul
    let li = ul.querySelectorAll('li.collection');

    for (let i = 0; i < li.length; i++)
    {
        let a = li[i].getElementsByTagName('span')[1];
        let b = li[i].getElementsByTagName('span')[2];
        let c = li[i].getElementsByTagName('span')[3];

        if (a.innerHTML.toUpperCase().indexOf(filterValue) > -1){
            li[i].style.display = '';
        }
        else if (b.innerHTML.toUpperCase().indexOf(filterValue) > -1){
            li[i].style.display = '';
        }
        else if (c.innerHTML.toUpperCase().indexOf(filterValue) > -1){
            li[i].style.display = '';
        }
        else{
            li[i].style.display = 'none';
        }
    }
}
